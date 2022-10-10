create table pedidosandre 
(
	id bigserial not null primary key,
	id_user int
)

create table vendasandre (
	id bigserial not null primary key,
	id_prod int not null,
	qtd int,
	preco float,
	nomeprod varchar(30),
	id_user int
)


