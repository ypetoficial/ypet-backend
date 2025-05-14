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
