# Sistema de Tratamento de Exceções

## Visão Geral

O projeto implementa um sistema centralizado de tratamento de exceções que converte erros técnicos em mensagens amigáveis para o usuário final.

## Como Funciona

### 1. Handler Global (`bootstrap/app.php`)

Todas as exceções não tratadas são capturadas pelo handler global configurado em `bootstrap/app.php`. Este handler:

- Detecta se a requisição espera JSON (API)
- Loga erros em produção para debug
- Mapeia a exceção para uma mensagem amigável
- Retorna uma resposta JSON padronizada
- Adiciona informações de debug em ambiente de desenvolvimento

### 2. Mapeador de Exceções (`app/Common/ExceptionMessageMapper.php`)

A classe `ExceptionMessageMapper` é responsável por converter exceções técnicas em mensagens amigáveis. Ela trata:

#### Exceções de Validação
- Retorna a primeira mensagem de erro de validação
- Inclui todos os erros de validação no campo `errors`

#### Exceções de Autenticação
- Mensagem: "Você precisa estar autenticado para acessar este recurso."
- Status: 401

#### Exceções HTTP
- **404 Not Found**: "O recurso solicitado não foi encontrado."
- **405 Method Not Allowed**: "Método não permitido para esta requisição."
- **403 Forbidden**: "Você não tem permissão para acessar este recurso."

#### Exceções de Banco de Dados (MySQL)

| Código de Erro | Descrição | Mensagem Amigável |
|----------------|-----------|-------------------|
| 1062 | Duplicate entry | "Este registro já existe no sistema. Por favor, verifique os dados informados." |
| 1451 | Foreign key constraint (delete) | "Não é possível excluir este registro pois existem outros dados vinculados a ele." |
| 1452 | Foreign key constraint (insert/update) | "Os dados informados são inválidos. Verifique se todos os campos estão corretos." |
| 1048 | Column cannot be null | "O campo é obrigatório e não pode estar vazio." |
| 1406 | Data too long | "Um dos campos contém um valor muito longo. Por favor, reduza o tamanho." |
| 1146 | Table doesn't exist | Mensagem padrão (erro interno) |
| 1054 | Unknown column | Mensagem padrão (erro interno) |
| 2002, 2003, 2006, 2013 | Connection errors | "Não foi possível conectar ao banco de dados. Por favor, tente novamente." |

#### Exceções Genéricas

Para exceções genéricas do tipo `\Exception`, o sistema verifica se a mensagem é "amigável" (não contém termos técnicos). Se for amigável, usa a mensagem original. Caso contrário, retorna a mensagem padrão:

**Mensagem Padrão**: "Ocorreu um erro inesperado. Por favor, tente novamente mais tarde."

## Formato de Resposta

Todas as respostas de erro seguem o formato:

```json
{
  "type": "error",
  "status": 500,
  "message": "Mensagem amigável para o usuário",
  "show": true,
  "errors": {
    // Opcional: erros de validação
  },
  "debug": {
    // Apenas em desenvolvimento
    "exception": "Nome da classe da exceção",
    "message": "Mensagem técnica original",
    "file": "Arquivo onde ocorreu o erro",
    "line": 123
  }
}
```

### Campos da Resposta

- **type**: Sempre "error" para erros
- **status**: Código HTTP do erro (400-599)
- **message**: Mensagem amigável para exibir ao usuário
- **show**: Boolean indicando se deve exibir a mensagem (sempre `true` para erros)
- **errors**: Objeto com erros de validação (apenas para ValidationException)
- **debug**: Informações técnicas para debug (apenas em ambiente local/development)

## Como Usar no Código

### Lançando Exceções com Mensagens Amigáveis

Para lançar uma exceção que será exibida ao usuário, basta usar uma mensagem clara:

```php
// Mensagem amigável - será exibida ao usuário
throw new \Exception('Este animal já está cadastrado no sistema.', 422);

// Mensagem técnica - será substituída pela mensagem padrão
throw new \Exception('Duplicate entry for key animals.registration_number', 500);
```

### Exemplos de Uso

#### No Service Layer

```php
public function save(array $data): mixed
{
    if ($this->isDuplicate($data)) {
        throw new \Exception('Já existe um registro com estes dados.', 422);
    }
    
    return $this->repository->create($data);
}
```

#### No Controller

```php
public function store(Request $request)
{
    try {
        $result = $this->service->save($request->all());
        return $this->success('Registro criado com sucesso', ['data' => $result]);
    } catch (\Exception $e) {
        // O handler global vai tratar automaticamente
        throw $e;
    }
}
```

**Nota**: Na maioria dos casos, você não precisa fazer `try/catch` nos controllers, pois o handler global já captura todas as exceções.

## Detecção de Mensagens Amigáveis

O sistema detecta automaticamente se uma mensagem é amigável verificando se ela **não contém** termos técnicos como:

- SQL, SQLSTATE, PDOException
- QueryException, Integrity constraint
- foreign key, Duplicate entry
- Column, Table, Database
- Exception, Error, Stack trace
- Caminhos de arquivos (vendor/, app/, .php)
- Namespaces (Illuminate\\, App\\)
- Operadores PHP (::)

## Logs

Em ambiente de **produção**, todas as exceções são logadas com informações completas:

```php
Log::error('Exception caught', [
    'exception' => 'App\Exceptions\CustomException',
    'message' => 'Mensagem técnica do erro',
    'file' => '/path/to/file.php',
    'line' => 123,
    'trace' => 'Stack trace completo...',
]);
```

Em **desenvolvimento**, as informações de debug são incluídas na resposta JSON.

## Boas Práticas

1. **Use mensagens amigáveis**: Ao lançar exceções que podem chegar ao usuário, use mensagens claras e em português.

2. **Use códigos HTTP apropriados**:
   - 400-499: Erros do cliente (dados inválidos, não autorizado, etc.)
   - 500-599: Erros do servidor (bugs, problemas de infraestrutura, etc.)

3. **Não exponha detalhes técnicos**: Evite incluir informações sensíveis ou técnicas nas mensagens de exceção.

4. **Deixe o handler global trabalhar**: Na maioria dos casos, não é necessário fazer `try/catch` nos controllers.

5. **Use ValidationException para validações**: O Laravel já trata automaticamente as ValidationExceptions.

## Exemplos de Mensagens

### ✅ Boas Mensagens (Amigáveis)

```php
throw new \Exception('Este CPF já está cadastrado no sistema.', 422);
throw new \Exception('O animal não foi encontrado.', 404);
throw new \Exception('Você não tem permissão para excluir este registro.', 403);
throw new \Exception('O campo nome é obrigatório.', 422);
```

### ❌ Mensagens Ruins (Técnicas)

```php
throw new \Exception('SQLSTATE[23000]: Integrity constraint violation', 500);
throw new \Exception('Call to undefined method App\Service::method()', 500);
throw new \Exception('Column not found: 1054 Unknown column', 500);
```

Estas mensagens técnicas serão automaticamente substituídas pela mensagem padrão.

## Testando o Sistema

Para testar o tratamento de exceções:

1. **Erro de duplicação**: Tente criar um registro com dados únicos duplicados
2. **Erro de FK**: Tente excluir um registro que tem dependências
3. **Erro de validação**: Envie dados inválidos para um endpoint
4. **Erro 404**: Acesse um recurso inexistente
5. **Erro genérico**: Force um erro no código e verifique a mensagem

## Manutenção

Para adicionar novos tipos de exceções ou mensagens:

1. Edite `app/Common/ExceptionMessageMapper.php`
2. Adicione um novo `if` no método `map()`
3. Retorne um array com `message`, `status` e `show`
4. Atualize esta documentação
