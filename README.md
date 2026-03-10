# 🛒 Sistema de Vendas

Sistema web para **gestão de vendas de produtos**, permitindo o controle de **produtos, clientes, vendas e parcelamentos**.

O projeto foi desenvolvido utilizando **Laravel no backend** e **Bootstrap no frontend**, com banco de dados **PostgreSQL**, aplicando conceitos de arquitetura MVC e boas práticas de desenvolvimento web.

---

# 🚀 Funcionalidades

### 📦 Gestão de Produtos

- Cadastro de produtos
- Edição e atualização de informações
- Exclusão de produtos
- Listagem de produtos cadastrados

### 👤 Gestão de Clientes

- Cadastro de clientes
- Edição e exclusão de clientes
- Visualização das informações dos clientes

### 💳 Registro de Vendas

- Registro de vendas de produtos
- Cálculo automático do valor total da venda
- Associação de clientes às vendas

### 🧾 Parcelamento

- Definição de número de parcelas
- Cálculo automático do valor das parcelas
- Controle das parcelas geradas

### 📊 Controle de Dados

- Visualização de vendas realizadas
- Relacionamento entre produtos, clientes e vendas
- Organização das informações no banco de dados

---

# 🛠️ Tecnologias Utilizadas

### Backend

- PHP
- Laravel
- Eloquent ORM

### Frontend

- HTML
- CSS
- Bootstrap
- JavaScript

### Banco de Dados

- PostgreSQL

---

# 📁 Estrutura do Projeto

```text
SISTEMAVENDASDC/
│
├── app/
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── views/
│   └── css/
│
├── routes/
│
├── public/
├── artisan
├── composer.json
└── README.md
```

---

# ⚙️ Como Rodar o Projeto
### 1️⃣ Clonar o repositório
```
git clone https://github.com/A5Rezende/SistemaVendasDC
```
### 2️⃣ Entrar na pasta do projeto
```
cd SistemaVendasDC
cd projeto
```
### 3️⃣ Instalar dependências
```
composer install
```
### 4️⃣ Configurar o arquivo .env

Configure a conexão com o banco PostgreSQL:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sistema_vendas
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```
### 5️⃣ Rodar as migrações
```
php artisan migrate
```
### 6️⃣ Iniciar o servidor
```
php artisan serve
```
Depois disso acesse:
```
http://localhost:8000
```
# 🎯 Objetivo do Projeto

Este projeto foi desenvolvido com o objetivo de praticar desenvolvimento web utilizando Laravel, aplicando conceitos importantes como:

- Arquitetura MVC
- Modelagem de banco de dados
- CRUD completo
- Relacionamentos entre entidades
- Lógica de negócios para vendas e parcelamentos

# 👨‍💻 Autor

**Antônio Gabriel Cardoso de Rezende Orlandini**

Desenvolvedor Full Stack

Backend

- PHP (Laravel)
- Python (Django)
- Node.js

Frontend

- JavaScript
- React
- Bootstrap

Banco de Dados

- PostgreSQL
- MySQL
- MongoDB

# ⭐ Considerações Finais

Este projeto faz parte do meu portfólio pessoal e foi desenvolvido para praticar desenvolvimento de sistemas comerciais utilizando Laravel, incluindo cadastro de produtos, registro de vendas e gerenciamento de parcelamentos.
