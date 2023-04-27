﻿# Controle de Estoque - Faculdade Impacta

O sistema servirá para sanar a necessidade de um controle de estoque
de uma empresa de smartphones, facilitando o registro de entrada e saída de
produtos, assim como toda a bateria de testes que tais aparelhos são
submetidos antes de serem disponibilizados a venda.

## Tutorial de instalação e utilização do sistema

Instale o [Wampserver64](https://www.wampserver.com/en/download-wampserver-64bits/) em sua máquina.

Caso você tenha definido uma senha de acesso para o PHPMyAdmin, modifique as variáveis de acesso ($localhost, $root e $passwd) no arquivo [connect.php](https://github.com/Batheus/impactaPhone-SistemaDeEstoque/blob/desenvolvimento/App/Models/connect.php).

Importe o banco de dados [estoque.sql](https://github.com/Batheus/impactaPhone-SistemaDeEstoque/blob/desenvolvimento/BD/estoque.sql) em seu PHPMyAdmin.

Para seu primeiro acesso ao sistema, utilize este acesso:

**Email:** admin@estoque.com | **Senha:** admin

[URL para acessar o sistema](http://localhost/estoqueimpacta)
