# DocNestify 
### 📁 Sistema de Gestão de Clientes e Documentos

> Uma aplicação web completa desenvolvida em Laravel para gerenciamento eficiente de clientes, organização de documentos e sistema de acervo inteligente.

## 🚀 Sobre o Projeto

Este sistema foi desenvolvido para otimizar o gerenciamento de clientes e seus respectivos documentos, oferecendo uma solução completa que vai desde o cadastro até a organização e busca avançada de arquivos. A aplicação combina funcionalidades essenciais de gestão documental.

## ✨ Funcionalidades Principais

### 👥 Módulo de Cadastro de Clientes
- **Cadastro Completo**: Registro detalhado de informações dos clientes
- **Gerenciamento de Dados**: Edição e atualização de informações cadastrais
- **Busca e Filtros**: Localização rápida de clientes específicos

### 📂 Módulo de Gestão de Pastas e Arquivos
- **Pastas Personalizadas**: Criação de estruturas organizadas por cliente
- **Upload de Documentos**: Sistema seguro para envio de arquivos
- **Sistema de Tags**: Marcação inteligente para categorização flexível
- **Categorização**: Organização hierárquica por tipos de documento

### 🔍 Módulo de Acervo Digital
- **Busca Avançada**: Localização de arquivos por múltiplos critérios
- **Filtros por Tags**: Sistema de filtros dinâmicos por marcações
- **Filtros por Categorias**: Busca estruturada por classificações
- **Busca Combinada**: Utilização simultânea de tags e categorias
- **Exportação**: Funcionalidade de download 

## 🛠️ Tecnologias Utilizadas

- **Framework**: Laravel (PHP)
- **Frontend**: Blade Templates, Bootstrap, CSS3, HTML5, JavaScript
- **Banco de Dados**: PostgreSQL
- **Armazenamento**: Sistema de arquivos S3
- **Containerização**: Docker & Docker Compose
- **Autenticação**: Laravel Authentication
- **Validação**: Laravel Validation

## 🐳 Configuração com Docker

Este projeto utiliza Docker para facilitar o ambiente de desenvolvimento e produção.

### Pré-requisitos
- Docker
- Docker Compose

### Como executar

1. **Clone o repositório**
```bash
git clone [url-do-repositorio]
cd docnestify
```

2. **Configure as variáveis de ambiente**
```bash
cp .env.example .env
```

3. **Execute o projeto com Docker**
```bash
docker-compose up -d
```

4. **Instale as dependências do Laravel**
```bash
docker-compose exec app composer install
```

5. **Execute as migrações**
```bash
docker-compose exec app php artisan migrate
```

6. **Acesse a aplicação**
```
http://localhost:8000
```

### Estrutura dos Containers
- **app**: Container principal da aplicação Laravel
- **database**: Container PostgreSQL
- **nginx**: Servidor web para servir a aplicação
