# Marcasite Cursos – API (Laravel 11)

API desenvolvida como parte de um desafio técnico para demonstrar domínio em Laravel, arquitetura limpa, modelagem de dados, integrações externas e boas práticas de desenvolvimento Back-end.

O foco do projeto é apresentar uma estrutura sólida, organizada e escalável — sem incluir front-end Vue ou funcionalidades periféricas que não fazem parte do escopo essencial de uma prova para back-end.

---

## 🚀 Tecnologias & Ferramentas

- **PHP 8.2+**
- **Laravel 11**
- **MySQL**
- **Mercado Pago SDK (sandbox)**
- **Eloquent ORM**
- **Form Requests**
- **API Resources**
- **Jobs & Mailables**
- **Seeders / Factories**
- **Middlewares**
- **Query Builder avançado para buscas**

---

## 📦 Funcionalidades Implementadas

### 🔹 Autenticação
- Sistema de login usando **sessions**
- Proteção de rotas via middleware `auth`

### 🔹 Estrutura da API
- Controllers organizados em **Actions** (arquitetura clara e modular)
- Rotas bem segmentadas (`/auth`, `/courses`, `/enrollments`, etc.)
- Lógica isolada em classes específicas para maior desacoplamento

### 🔹 Validações
- FormRequests customizados com validação padronizada
- Mensagens claras e consistentes

### 🔹 Banco de Dados
- **Migrations** completas
- **Factories** para geração de dados reais
- **Seeders** para popular automaticamente cursos, usuários e inscrições

### 🔹 Integração Mercado Pago
- Criação de pagamentos no **modo sandbox**
- Retorno estruturado para simulação de compra
- Serviço próprio encapsulando regras de integração

### 🔹 Busca Avançada
Implementada manualmente usando Query Builder e filtros dinâmicos.  
*(Sem Laravel Scout — proposital para demonstrar domínio direto das queries.)*

### 🔹 Envios de E-mail
- Mailable + Job assíncrono para confirmação de criação de conta

### 🔹 Utilitários Internos
- Classes helpers específicas criadas para o projeto
- Padronização de respostas e erros

---

## 🧪 Como Rodar o Projeto

### 1. Clone o repositório
```bash
git clone https://github.com/gbguiba/marcasite_cursos
cd marcasite_cursos
