# Sistema de Controle de Assistência Técnica de Consoles/PCs Gamer

## Integrantes
- Jeferson — Banco de dados (migrations, models, relacionamentos, seeders), Correções nos códigos, criação e atualização para aplicar FRONT-END.
- Bruno — Regras de negócio (controllers, rotas, middleware, policy)
- Arthur — Telas (views Blade, navegação, estilização com Tailwind)
- Murilo — Validação e testes (Form Requests, testes manuais dos 3 papéis)

## Descrição
Sistema web para controle de assistência técnica de equipamentos gamer (consoles, PCs e
notebooks). Clientes cadastram seus equipamentos e abrem ordens de serviço descrevendo o
problema; técnicos assumem, diagnosticam e fecham as ordens; administradores gerenciam todo
o sistema, incluindo os usuários.

## Tecnologias utilizadas
- Laravel 12
- PHP 8.2+
- PostgreSQL (hospedado no Neon)
- Blade + Tailwind CSS
- Laravel Breeze (autenticação)

## Papéis de usuário (campo `role`)
- **admin** — acesso total: gerencia usuários, exclui equipamentos e ordens de serviço.
- **tecnico** — assume ordens de serviço, atualiza diagnóstico/status.
- **cliente** — cadastra os próprios equipamentos e abre ordens de serviço para eles.

| Funcionalidade                    | Admin | Técnico                          | Cliente             |

| Ver equipamentos                   | Todos | Todos                             | Só os próprios       |
| Cadastrar equipamento              | Sim   | Sim                                | Sim (próprio)        |
| Editar equipamento                 | Sim   | Sim                                | Sim (próprio)        |
| Excluir equipamento                | Sim   | Não                                | Não                  |
| Abrir Ordem de Serviço (OS)        | Sim   | Sim                                | Sim (equip. próprio) |
| Atualizar diagnóstico/status da OS | Sim   | Só se for o técnico responsável   | Não                  |
| Excluir OS                         | Sim   | Não                                | Não                  |
| Gerenciar usuários (role)          | Sim   | Não                                | Não                  |

## Estrutura do projeto (MVC)
- **Models**: `User`, `Equipamento`, `OrdemServico`, `Peca`
- **Controllers**: `EquipamentoController`, `OrdemServicoController`, `PecaController`, `Admin\UserController`
- **Views (Blade)**: `resources/views/equipamentos/*`, `resources/views/ordens/*`, `resources/views/admin/users/*`
- **Middleware**: `CheckRole` (alias `role`) — protege as rotas por papel (ex: `role:admin`)
- **Policy**: `OrdemServicoPolicy` — controla quem pode ver/editar/excluir uma OS
- **Form Requests**: `StoreEquipamentoRequest`, `StoreOrdemServicoRequest`, `UpdateOrdemServicoRequest`

## Relacionamentos (Eloquent)
- `User` (cliente) `hasMany` `Equipamento`
- `Equipamento` `hasMany` `OrdemServico`
- `User` (técnico) `hasMany` `OrdemServico` (via `tecnico_id`, relação `ordensServicoComoTecnico`)
- `OrdemServico` `hasMany` `Peca`

## Instalação

1. Clonar o repositório e instalar as dependências:
```
git clone <url-do-repositorio>
cd Projeto_Back
composer install
npm install
```

2. Configurar o ambiente:
```
cp .env.example .env
php artisan key:generate
```

3. Configurar o banco de dados PostgreSQL no `.env`:
```
DB_CONNECTION=pgsql
DB_HOST=<host-do-banco>
DB_PORT=5432
DB_DATABASE=<nome-do-banco>
DB_USERNAME=<usuario>
DB_PASSWORD=<senha>
DB_SSLMODE=require
```

4. Rodar as migrations e seeders:
```
php artisan migrate:fresh --seed
```

5. Compilar os assets do front-end:
```
npm run build
```

## Execução
```
php artisan serve
```
Acesse em `http://127.0.0.1:8000`.

Para desenvolvimento com recarregamento automático do CSS/JS, use `npm run dev` em outro terminal.

## Usuários de teste (criados pelo seeder)

| Papel   | E-mail                | Senha      |
|---------|------------------------|------------|
| Admin   | admin@email.com        | 12345678   |
| Técnico | tecnico@email.com      | 12345678   |
| Técnico | tecnica2@email.com     | 12345678   |
| Cliente | cliente@email.com      | 12345678   |
| Cliente | cliente2@email.com     | 12345678   |