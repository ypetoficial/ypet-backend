# Exemplos de Tratamento de Exceções

Este documento mostra exemplos práticos de como o sistema de tratamento de exceções funciona.

## Exemplos de Respostas

### 1. Erro de Duplicação (MySQL Error 1062)

**Cenário**: Tentar cadastrar um animal com número de registro já existente.

**Exceção Original**:
```
SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '12345' for key 'animals.registration_number'
```

**Resposta da API**:
```json
{
  "type": "error",
  "status": 422,
  "message": "Este registro já existe no sistema. Por favor, verifique os dados informados.",
  "show": true
}
```

---

### 2. Erro de Foreign Key ao Excluir (MySQL Error 1451)

**Cenário**: Tentar excluir um tutor que possui animais vinculados.

**Exceção Original**:
```
SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails
```

**Resposta da API**:
```json
{
  "type": "error",
  "status": 422,
  "message": "Não é possível excluir este registro pois existem outros dados vinculados a ele.",
  "show": true
}
```

---

### 3. Erro de Validação

**Cenário**: Enviar dados inválidos em um formulário.

**Exceção Original**: `ValidationException`

**Resposta da API**:
```json
{
  "type": "error",
  "status": 422,
  "message": "O campo nome é obrigatório.",
  "show": true,
  "errors": {
    "name": ["O campo nome é obrigatório."],
    "email": ["O campo email deve ser um endereço de e-mail válido."]
  }
}
```

---

### 4. Erro 404 - Recurso Não Encontrado

**Cenário**: Tentar acessar um animal que não existe.

**Exceção Original**: `NotFoundHttpException`

**Resposta da API**:
```json
{
  "type": "error",
  "status": 404,
  "message": "O recurso solicitado não foi encontrado.",
  "show": true
}
```

---

### 5. Erro de Autenticação

**Cenário**: Tentar acessar um endpoint protegido sem token.

**Exceção Original**: `AuthenticationException`

**Resposta da API**:
```json
{
  "type": "error",
  "status": 401,
  "message": "Você precisa estar autenticado para acessar este recurso.",
  "show": true
}
```

---

### 6. Erro de Permissão

**Cenário**: Tentar acessar um recurso sem permissão.

**Exceção Original**: `AccessDeniedHttpException`

**Resposta da API**:
```json
{
  "type": "error",
  "status": 403,
  "message": "Você não tem permissão para acessar este recurso.",
  "show": true
}
```

---

### 7. Campo Obrigatório Nulo (MySQL Error 1048)

**Cenário**: Tentar salvar um registro sem preencher um campo obrigatório.

**Exceção Original**:
```
SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'name' cannot be null
```

**Resposta da API**:
```json
{
  "type": "error",
  "status": 422,
  "message": "O campo é obrigatório e não pode estar vazio.",
  "show": true
}
```

---

### 8. Valor Muito Longo (MySQL Error 1406)

**Cenário**: Tentar salvar um texto maior que o limite do campo.

**Exceção Original**:
```
SQLSTATE[22001]: String data, right truncated: 1406 Data too long for column 'description'
```

**Resposta da API**:
```json
{
  "type": "error",
  "status": 422,
  "message": "Um dos campos contém um valor muito longo. Por favor, reduza o tamanho.",
  "show": true
}
```

---

### 9. Erro de Conexão com Banco (MySQL Error 2002)

**Cenário**: Banco de dados indisponível.

**Exceção Original**:
```
SQLSTATE[HY000] [2002] Connection refused
```

**Resposta da API**:
```json
{
  "type": "error",
  "status": 503,
  "message": "Não foi possível conectar ao banco de dados. Por favor, tente novamente.",
  "show": true
}
```

---

### 10. Exceção Personalizada com Mensagem Amigável

**Cenário**: Lançar uma exceção customizada no código.

**Código**:
```php
throw new \Exception('Este animal já passou por castração.', 422);
```

**Resposta da API**:
```json
{
  "type": "error",
  "status": 422,
  "message": "Este animal já passou por castração.",
  "show": true
}
```

---

### 11. Exceção Técnica (Será Substituída)

**Cenário**: Erro interno não tratado.

**Código**:
```php
throw new \Exception('Call to undefined method App\Service::nonExistentMethod()', 500);
```

**Resposta da API**:
```json
{
  "type": "error",
  "status": 500,
  "message": "Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.",
  "show": true
}
```

---

### 12. Resposta em Ambiente de Desenvolvimento

**Cenário**: Qualquer erro em ambiente local/development.

**Resposta da API** (com debug):
```json
{
  "type": "error",
  "status": 500,
  "message": "Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.",
  "show": true,
  "debug": {
    "exception": "Illuminate\\Database\\QueryException",
    "message": "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry...",
    "file": "/app/Domains/Animal/Services/AnimalService.php",
    "line": 45
  }
}
```

---

## Como Testar

### Teste 1: Duplicação de Registro

```bash
# Criar um animal
curl -X POST http://localhost/api/animals \
  -H "Content-Type: application/json" \
  -d '{"registration_number": "12345", "name": "Rex"}'

# Tentar criar novamente com o mesmo número
curl -X POST http://localhost/api/animals \
  -H "Content-Type: application/json" \
  -d '{"registration_number": "12345", "name": "Max"}'
```

### Teste 2: Excluir com Dependências

```bash
# Tentar excluir um tutor que tem animais
curl -X DELETE http://localhost/api/tutors/1
```

### Teste 3: Recurso Não Encontrado

```bash
# Tentar acessar um animal inexistente
curl http://localhost/api/animals/99999
```

### Teste 4: Validação

```bash
# Enviar dados inválidos
curl -X POST http://localhost/api/animals \
  -H "Content-Type: application/json" \
  -d '{"name": ""}'
```

### Teste 5: Sem Autenticação

```bash
# Acessar endpoint protegido sem token
curl http://localhost/api/protected-endpoint
```

---

## Logs em Produção

Em ambiente de produção, todos os erros são logados com detalhes completos:

```
[2024-10-19 01:32:00] production.ERROR: Exception caught
{
  "exception": "Illuminate\\Database\\QueryException",
  "message": "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '12345' for key 'animals.registration_number'",
  "file": "/var/www/app/Domains/Animal/Services/AnimalService.php",
  "line": 45,
  "trace": "Stack trace completo..."
}
```

Isso permite debug completo sem expor detalhes técnicos ao usuário final.
