# YPet

Ypet é uma plataforma digital voltada à proteção e cuidado dos animais, oferecendo uma solução completa para gestão pública, atendimento ao cidadão e integração com Proterores animais.

O sistema é composto por um painel administrativo e dois aplicativos (Cidadão e Protetor), com recursos como adoção, denúncias, controle de vacinas, agendamento de castrações, Samupet e muito mais.

---

## Estrutura do Projeto

Este repositório contém o back-end do Ypet, desenvolvido em PHP utilizando o framework Laravel.

### Principais Módulos:
- Gestão de Animais
- Cadastro de Usuários (Cidadãos, Protetores, Veterinários)
- Vacinação e Produtos
- Denúncias e Ocorrências
- Castramóvel e Samupet
- Relatórios e Painéis
- Integração com Geolocalização e Notificações

---

## ⚙️ Tecnologias Utilizadas

- PHP 8
- Laravel 10
- MySQL / PostgreSQL
- Redis (opcional)
- Composer
- Git

---

## Como Rodar Localmente

### Pré-requisitos:
- PHP 8.1+
- Composer
- MySQL
- Git


### Passos:
```bash
# Clone o repositório
git clone https://github.com/[usuario]/ypet.git
cd ypet

# Instale as dependências PHP
composer install

# Copie o arquivo de exemplo de variáveis de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Configure seu banco de dados no .env e rode as migrations
php artisan migrate

# (Opcional) Rode o servidor local
php artisan serve
```
### Configuração usando Docker:
```bash
# Certifique-se de ter o Docker e Docker Compose instalados
# Clone o repositório
git clone https://github.com/[usuario]/ypet.git
cd ypet

# Inicie os containers
docker-compose up -d

# Acesse o container do PHP
docker-compose exec app bash

# Instale as dependências PHP dentro do container
composer install

# Gere a chave da aplicação
php artisan key:generate

# Configure seu banco de dados no .env e rode as migrations
php artisan migrate

# Rode o setup inicial
php artisan app:setup
```

### Acessando a Aplicação
A aplicação estará disponível em `http://localhost:8000` ou conforme configurado no seu ambiente Docker.
Use as credenciais padrão para acessar o painel administrativo:
- **Email:** ``super.user@ypet.com``
- **Senha:** ``superuser123``

---

## 📖 Documentação da API (Swagger)

O projeto utiliza Swagger (OpenAPI) para documentação da API.

### Como Gerar e Acessar a Documentação Swagger

1. **Gerar a documentação:**
   ```bash
   php artisan l5-swagger:generate
    ```
2. **Acessar a documentação:**
3. Abra seu navegador e acesse `http://localhost:8000/api/documentation` ou conforme configurado no seu ambiente.
