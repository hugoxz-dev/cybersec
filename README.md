# Cybersec

![PHP](https://img.shields.io/badge/PHP-Backend-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-Frontend-F7DF1E?logo=javascript&logoColor=black)
![CSS](https://img.shields.io/badge/CSS3-Frontend-1572B6?logo=css3&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-Web_Server-D22128?logo=apache&logoColor=white)

Plataforma educacional **full stack** de cibersegurança. O projeto reúne interface web, regras de negócio, autenticação, persistência de dados e configuração do servidor em uma arquitetura MVC desenvolvida em PHP.

## Stack

| Camada | Tecnologias |
| --- | --- |
| Frontend | HTML renderizado por PHP, CSS3, JavaScript e Bootstrap 5 |
| Backend | PHP, MVC, sessões e PDO |
| Banco de dados | MySQL ou MariaDB |
| Servidor web | Apache com `mod_rewrite` e `.htaccess` |
| Segurança | Hash de senhas, consultas preparadas com PDO e configuração por variáveis de ambiente |

> A seção **Languages** do GitHub contabiliza principalmente as extensões e o volume dos arquivos. Como grande parte do HTML está dentro de arquivos `.php`, o PHP aparece como linguagem predominante, embora a aplicação seja full stack.

## Funcionalidades

- Cadastro, autenticação e gerenciamento de sessão
- Dashboard de aprendizagem
- Trilhas, módulos e aulas
- Laboratórios e desafios práticos
- Perguntas, quizzes e acompanhamento de progresso
- Ranking, badges e certificados
- Perfil do usuário e alteração de senha
- Área administrativa para conteúdo e usuários

## Estrutura

```text
app/
├── controllers/    # Fluxos HTTP e regras de aplicação
├── core/           # Roteamento, banco, sessão e infraestrutura MVC
├── models/         # Acesso e representação dos dados
└── views/          # Interface renderizada no servidor
config/             # Configurações da aplicação
database/           # Estrutura do banco de dados
public/             # Ponto de entrada e recursos públicos
```

## Requisitos

- PHP com extensão PDO MySQL
- MySQL ou MariaDB
- Apache com `mod_rewrite`

## Configuração local

1. Clone o repositório.
2. Configure o servidor web para servir o diretório `public/`.
3. Defina as variáveis de ambiente documentadas em `.env.example`.
4. Crie o banco indicado por `DB_NAME`.
5. Importe `database/cibersec.sql` quando o arquivo possuir a estrutura do banco.
6. Garanta permissão de escrita em `public/assets/uploads/profiles/`.

Exemplo de variáveis:

```env
APP_NAME=cybersec
BASE_URL=http://localhost/cybersec/public
DB_HOST=localhost
DB_NAME=cybersec
DB_USER=root
DB_PASS=
```

## Cuidados de segurança

- Nunca versione o arquivo `.env`, senhas, tokens ou chaves.
- Uploads de usuários permanecem fora do Git por meio do `.gitignore`.
- Em produção, use credenciais exclusivas para o banco e HTTPS.
- Valide tipo, tamanho e conteúdo dos arquivos enviados pelos usuários.
