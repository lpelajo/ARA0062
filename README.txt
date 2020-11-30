O usuário padrão já inserido no BBD é:
E-mail:	admin@admin.com
Senha:	1234

No item 2 e no item 7 do trabalho fiz umas pequenas
modificações para encaixar no tema que escolhi:

Na tabela users:
 - Foi adicionado o campo status do tipo tinyint()
na tabela users para definir se a conta está ativa
ou inativa (visto que o site não deleta a conta do
usuário quando este clica em deletar, apenas inativa)

Na tabela blog:
 - Foi adicionado o campo user-id do tipo INT na
tabela blog como chave estrangeira ligando ao ID
da tabela users.