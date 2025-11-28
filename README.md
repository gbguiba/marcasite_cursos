# 📘 Marcasite Cursos -- API Laravel

Bem-vindo ao repositório do **Marcasite Cursos**, um projeto
desenvolvido como **teste técnico Back-end/PHP/Laravel** --- focado no
que realmente importa: arquitetura limpa, organização e domínio do
ecossistema Laravel.\
Nada de firulas, só o poder bruto do código bem feito. ⚡

------------------------------------------------------------------------

## 🎯 Objetivo do Projeto

Demonstrar habilidades práticas em: - Arquitetura de APIs REST com
Laravel\
- Boas práticas de organização e manutenção\
- Validações robustas\
- Integrações externas (Mercado Pago)\
- Estrutura completa do ecossistema Laravel

------------------------------------------------------------------------

## ✅ Funcionalidades Implementadas

### 🧩 Estrutura de Código

-   Actions organizando regras de negócio\
-   Controllers limpos e objetivos\
-   Rotas estruturadas\
-   Requests customizadas com validação completa\
-   Resources para formatação de resposta\
-   Middlewares customizados\
-   Utilitários internos

### 🛠️ Infraestrutura e Banco

-   Migrations completas\
-   Factories\
-   Seeders com dados realistas\
-   Relacionamentos bem definidos

### 📬 Funcionalidades Adicionais

-   Job de envio de e-mail para confirmação\
-   Templates de e-mail\
-   Integração com Mercado Pago (sandbox)

------------------------------------------------------------------------

## ❌ Funcionalidades **não incluídas**

Esses pontos fogem do escopo de um teste de Back-end:

-   ✘ Interface Vue.js\
-   ✘ Laravel Scout para buscas\
-   ✘ Exportação PDF/Excel (feature de produto, não de teste)

------------------------------------------------------------------------

## 🧰 Tecnologias Utilizadas

-   **PHP 8.2+**\
-   **Laravel 11**\
-   **MySQL**\
-   **Mercado Pago SDK (sandbox)**\
-   **Mailtrap/SMTP para testes**

------------------------------------------------------------------------

## 🚀 Como Rodar o Projeto

``` bash
git clone https://github.com/gbguiba/marcasite_cursos

composer install

cp .env.example .env

php artisan key:generate
```

Configure suas credenciais no `.env`:

-   Banco MySQL\
-   Mercado Pago (Public Key + Access Token sandbox)\
-   Mailtrap/SMTP

Depois:

``` bash
php artisan migrate --seed
php artisan serve
```

A API estará rodando em:\
**http://localhost:8000**

**Senhas dos usuários/administradores: "123456"**

------------------------------------------------------------------------

## 📂 Repositório

🔗 https://github.com/gbguiba/marcasite_cursos

------------------------------------------------------------------------

## ⭐ Observação Final

O foco aqui foi entregar **qualidade**, **organização**, **clareza** e
**boas práticas de Laravel** --- exatamente o que se espera de um
desenvolvedor back-end. 🚀
