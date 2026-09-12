# Testes Manuais — Papéis de Usuário

Roteiro para validar as regras de permissão do sistema, testando com os 3 tipos de usuário
criados pelo `UserSeeder`. Rode `php artisan migrate:fresh --seed` antes de começar.

## Usuários de teste

| Papel   | E-mail                | Senha      |
|---------|-----------------------|------------|
| Admin   | admin@email.com       | 12345678   |
| Técnico | tecnico@email.com     | 12345678   |
| Técnico | tecnica2@email.com    | 12345678   |
| Cliente | cliente@email.com     | 12345678   |
| Cliente | cliente2@email.com    | 12345678   |

---

## 1. Login como Cliente (cliente@email.com)

- [x] Faz login com sucesso e é redirecionado ao dashboard.
- [x] Em "Equipamentos", vê **apenas** os equipamentos cadastrados por ele mesmo (não vê os do Cliente Ana).
- [x] Consegue **cadastrar** um novo equipamento próprio.
- [x] **Não** consegue editar ou excluir equipamento (botões de editar/excluir não aparecem, ou, se acessar a rota direto pela URL, recebe erro 403).
- [x] Consegue **abrir uma Ordem de Serviço (OS)** para um equipamento próprio.
- [x] Ao tentar abrir OS para um equipamento que não é dele (ex: forçando o `equipamento_id` de outro cliente na URL/form), recebe erro/validação.
- [x] Em "Ordens de Serviço", vê **apenas** as OS relacionadas aos próprios equipamentos.
- [x] **Não** consegue editar diagnóstico/status de uma OS (campo bloqueado ou 403 ao acessar `ordens/{id}/edit`).
- [x] **Não** consegue excluir uma OS.
- [x] Não consegue acessar `/admin/users` (recebe 403 ou é redirecionado).
- [x] O menu de navegação não mostra o link de administração de usuários.

## 2. Login como Técnico (tecnico@email.com)

- [x] Faz login com sucesso.
- [x] Em "Equipamentos", vê **todos** os equipamentos (de todos os clientes).
- [x] Consegue cadastrar e **editar** um equipamento.
- [x] **Não** consegue excluir equipamento (ação restrita ao admin).
- [x] Em "Ordens de Serviço", vê **todas** as OS do sistema.
- [x] Consegue **assumir** uma OS sem técnico responsável (ex: a que tem `tecnico_id = null` no seeder).
- [x] Consegue **atualizar diagnóstico e status** de uma OS em que ele é o técnico responsável.
- [x] Ao tentar editar uma OS de **outro técnico** (ex: logar como tecnica2@email.com e tentar editar uma OS atribuída ao tecnico@email.com), recebe 403.
- [x] **Não** consegue excluir nenhuma OS (nem a própria).
- [x] Não consegue acessar `/admin/users`.

## 3. Login como Admin (admin@email.com)

- [x] Faz login com sucesso.
- [x] Vê **todos** os equipamentos e **todas** as OS, sem restrição.
- [x] Consegue cadastrar, editar e **excluir** equipamentos.
- [x] Consegue editar e **excluir** qualquer Ordem de Serviço, mesmo as atribuídas a técnicos.
- [x] Consegue atualizar diagnóstico/status de qualquer OS, independente do técnico responsável.
- [x] Acessa `/admin/users` normalmente e vê a lista dos 5 usuários do seeder.
- [x] Consegue **editar o `role`** de um usuário (ex: promover um cliente a técnico) e o efeito reflete no sistema.
- [x] Consegue **excluir** um usuário.
- [x] O menu de navegação mostra o link de administração, visível somente para o admin.

## 4. Validações (Form Requests)

- [x] Tentar cadastrar equipamento sem `tipo`, `marca` ou `modelo` → mensagens de erro em português aparecem.
- [x] Tentar abrir OS sem selecionar equipamento → erro "Selecione o equipamento.".
- [x] Tentar abrir OS com `descricao_problema` menor que 10 caracteres → erro de tamanho mínimo.
- [x] Tentar atualizar OS com `status` fora de `aberta|em_andamento|concluida|cancelada` → erro "Status inválido.".
- [x] Tentar salvar `valor_total` negativo ou não numérico → erro de validação.
