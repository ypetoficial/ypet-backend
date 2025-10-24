# Fluxo de Recuperação de Senha

Este documento descreve o fluxo completo de recuperação de senha da aplicação, incluindo exemplos de requisições e respostas.

## Visão Geral

O fluxo de recuperação de senha consiste em 3 etapas:

1. **Solicitar reset de senha** - Envia um email com o token de recuperação
2. **Validar token** - Verifica se o token enviado é válido
3. **Resetar senha** - Redefine a senha do usuário

---

## 1. Solicitar Reset de Senha

Envia um email para o usuário com o token de recuperação de senha.

### Endpoint
```
POST /api/auth/forgot-password
```

### Headers
```
Content-Type: application/json
Accept: application/json
```

### Request Body
```json
{
  "email": "usuario@exemplo.com"
}
```

### Respostas

#### Sucesso (200 OK)
```json
{
  "message": "We have emailed your password reset link."
}
```

#### Erro - Email não encontrado (422 Unprocessable Entity)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "We can't find a user with that email address."
    ]
  }
}
```

#### Erro - Validação (422 Unprocessable Entity)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "O campo e-mail é obrigatório."
    ]
  }
}
```

---

## 2. Validar Token de Reset

Valida se o token enviado por email é válido e não expirou.

### Endpoint
```
POST /api/auth/validate-reset-token
```

### Headers
```
Content-Type: application/json
Accept: application/json
```

### Request Body
```json
{
  "email": "usuario@exemplo.com",
  "token": "a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6"
}
```

### Respostas

#### Sucesso (200 OK)
```json
{
  "message": "Token válido.",
  "valid": true
}
```

#### Erro - Token inválido ou expirado (422 Unprocessable Entity)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "token": [
      "O token de redefinição é inválido ou expirou."
    ]
  }
}
```

#### Erro - Usuário não encontrado (422 Unprocessable Entity)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "Usuário não encontrado."
    ]
  }
}
```

#### Erro - Validação (422 Unprocessable Entity)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "O campo e-mail é obrigatório."
    ],
    "token": [
      "O token de redefinição é obrigatório."
    ]
  }
}
```

---

## 3. Resetar Senha

Redefine a senha do usuário após validação do token.

### Endpoint
```
POST /api/auth/reset-password
```

### Headers
```
Content-Type: application/json
Accept: application/json
```

### Request Body
```json
{
  "email": "usuario@exemplo.com",
  "token": "a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6",
  "password": "NovaSenha123!",
  "password_confirmation": "NovaSenha123!"
}
```

### Respostas

#### Sucesso (200 OK)
```json
{
  "message": "Your password has been reset."
}
```

#### Erro - Token inválido (422 Unprocessable Entity)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "This password reset token is invalid."
    ]
  }
}
```

#### Erro - Validação (422 Unprocessable Entity)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "password": [
      "A senha deve ter pelo menos 8 caracteres."
    ],
    "password_confirmation": [
      "A confirmação da senha não confere."
    ]
  }
}
```

---

## Fluxo Completo - Exemplo

### Passo 1: Usuário solicita reset
```bash
curl -X POST http://localhost/api/auth/forgot-password \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "usuario@exemplo.com"
  }'
```

**Resposta:** Email enviado com token

---

### Passo 2: Validar token recebido no email
```bash
curl -X POST http://localhost/api/auth/validate-reset-token \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "usuario@exemplo.com",
    "token": "a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6"
  }'
```

**Resposta:** Token válido

---

### Passo 3: Resetar senha
```bash
curl -X POST http://localhost/api/auth/reset-password \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "usuario@exemplo.com",
    "token": "a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6",
    "password": "NovaSenha123!",
    "password_confirmation": "NovaSenha123!"
  }'
```

**Resposta:** Senha redefinida com sucesso

---

## Regras de Validação

### Forgot Password
- `email`: obrigatório, formato de email válido

### Validate Reset Token
- `email`: obrigatório, formato de email válido
- `token`: obrigatório, string

### Reset Password
- `email`: obrigatório, formato de email válido
- `token`: obrigatório, string
- `password`: obrigatório, mínimo 8 caracteres
- `password_confirmation`: obrigatório, deve ser igual ao campo `password`

---

## Observações Importantes

1. **Expiração do Token**: Os tokens de reset têm validade configurada no arquivo `config/auth.php` (padrão: 60 minutos)

2. **Uso Único**: Após o reset bem-sucedido, o token é invalidado automaticamente

3. **Segurança**: Todos os endpoints são públicos, mas o token garante que apenas quem tem acesso ao email pode resetar a senha

4. **Rate Limiting**: Considere implementar rate limiting para prevenir abuso dos endpoints de email

5. **Validação Intermediária**: O endpoint `/validate-reset-token` é opcional mas recomendado para melhorar a UX, permitindo validar o token antes do usuário preencher a nova senha
