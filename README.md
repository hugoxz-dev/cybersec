# cybersec

Plataforma educacional de ciberseguranca desenvolvida em PHP.

## Requisitos

- PHP com PDO MySQL
- MySQL ou MariaDB
- Apache com `mod_rewrite`

## Configuracao

1. Configure o servidor web para servir o diretorio `public/`.
2. Defina as variaveis de ambiente listadas em `.env.example`.
3. Crie o banco indicado por `DB_NAME` e importe `database/cibersec.sql`, quando houver conteudo nesse arquivo.
4. Garanta permissao de escrita em `public/assets/uploads/profiles/`.

Nunca envie o arquivo `.env`, senhas ou uploads de usuarios ao repositorio.
