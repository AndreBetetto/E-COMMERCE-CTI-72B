create table userinfos (
    id_user int serial not null primary key,
    nome_completo varchar(90),
    ddd_number int,
    telephone_number varchar(15),
    /* Depois adicionar infos importantes para conclusão de cadastro */
)

create table produtosandre (
	id serial not null primary key,
	titulo varchar(45),
	descricao varchar(300),
	material varchar(35),
	preco double precision,
	estoque int,
	promocao bool,
	promoPorcentagem int
)







