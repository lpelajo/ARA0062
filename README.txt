O usuário padrão já inserido no BBD é:
E-mail:	admin@admin.com
Senha:	1234

No item 7 do trabalho fiz umas pequenas modificações
para encaixar no tema que escolhi para meu trabalho:

 - A tabela se chama posts ao invés de blog;
 - O ID permanece como pedido, chave primário e Auto
Iconcremental;
 - O campo título é substituído pelo e-mail de quem
fez o post, e para isso utilizei uma chave
estrangeira com a tabela users, possibilitanto
a query.
 - O campo corpo do tipo text foi substituído pelo
campo content do tipo varchar[140], para imitar o
padrão de limite de tamanho de post original do
twitter e encaixar no meu tema escolhido.