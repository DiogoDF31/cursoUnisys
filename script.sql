create table tab_Alunos(
	idAluno int not null primary key auto_increment,
	nomeAluno varchar(50) not null,
	cpf char(12) not null unique,
	telefone char(15),
	dataNasc char(10),
	genero char(1) check(genero='M' or genero='F')
) type=InnoDB;

create table tab_cursos(
	idCurso int not null primary key auto_increment,
	nomeCurso varchar(100) not null,
	dataInicio char(10)
) type=InnoDB;

create table tab_modulos(
	idModulo int not null primary key auto_increment,
	nomeModulo varchar(50) not null,
	preco numeric(10,2) check (preco >= 0)
) type=InnoDB;


create table tab_matriculas(
	idMatricula int not null primary key auto_increment,
	idAluno int,
	idCurso int,
	dataMatricula datetime,
	FOREIGN KEY (idAluno) references tab_alunos(idAluno) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY (idCurso) references tab_cursos(idCurso) ON UPDATE RESTRICT ON DELETE RESTRICT
) type=InnoDB;

create table tab_matriculaModulos(
	idMatriculaModulo int not null primary key auto_increment,
	idMatricula int,
	idModulo int,
	valorCobrado numeric(10,2) check (preco >= 0),
	FOREIGN KEY (idMatricula) references tab_matriculas(idMatricula) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY (idModulo) references tab_modulos(idModulo) ON UPDATE RESTRICT ON DELETE RESTRICT
) type=InnoDB;



// INSERT tab_alunos 
insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Diogo Danilo', '134928006-29', '991034684', '31/12/1999', 'M');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Jose Ricardo', '252492190-55', '991034000', '29/08/1980', 'M');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Maria Helena', '789652480-51', '987034000', '05/04/2000', 'F');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Julia Rodrigues', '981155200-20', '988524000', '13/01/1998', 'F');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Marcos Costa', '832639390-84', '887024000', '21/08/1990', 'M');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Giovana Alves', '121079460-86', '991234321', '01/10/1970', 'F');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Diego Daniel', '925500290-20', '997894987', '10/01/1989', 'M');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Geraldo Pereira', '025926900-00', '997891234', '19/03/1974', 'M');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Sarah Fernandes', '396998720-20', '995641234', '10/12/2001', 'F');

insert into tab_Alunos(nomeAluno ,cpf,telefone,dataNasc,genero)
values('Pedro Sampaio', '377315240-00', '995640258', '30/05/1999', 'M');


// INSERT tab_cursos

insert into tab_cursos(nomeCurso,dataInicio)
values('Sistema da Informacao','01/08/2021');

insert into tab_cursos(nomeCurso,dataInicio)
values('Educação Fisica','01/08/2021');

insert into tab_cursos(nomeCurso,dataInicio)
values('Java','15/07/2021');

insert into tab_cursos(nomeCurso,dataInicio)
values('Direito','01/08/2021');

insert into tab_cursos(nomeCurso,dataInicio)
values('JavaScript','20/06/2021');


// INSERT tab_matriculas
insert into tab_matriculas(idAluno,idCurso,dataMatricula)
values(3,1,now());
insert into tab_matriculas(idAluno,idCurso,dataMatricula)
values(1,3,now());
insert into tab_matriculas(idAluno,idCurso,dataMatricula)
values(1,1,now());
insert into tab_matriculas(idAluno,idCurso,dataMatricula)
values(1,2,now());
insert into tab_matriculas(idAluno,idCurso,dataMatricula)
values(2,2,now());
insert into tab_matriculas(idAluno,idCurso,dataMatricula)
values(3,3,now());




// INSERT tab_modulos
insert into tab_modulos(nomeModulo,preco)
values('WEB 1',1300);
insert into tab_modulos(nomeModulo,preco)
values('Spring',900);

// INSERT tab_matriculaModulos
insert into tab_matriculaModulos(idMatricula,idModulo,valorCobrado)
values(1,1,1000);
insert into tab_matriculaModulos(idMatricula,idModulo,valorCobrado)
values(2,2,600);


// SELECT

select idMatriculaModulo,nomeModulo,preco from tab_matriculaModulos inner join  tab_modulos  tab_matriculaModulos.nomeModulo; = tab_matriculaModulos.idMatriculaModulo;


// CHAMADAS DAS APIs

http://127.0.0.1:8051/cursoUnisys/matricula/ajaxListarMatriculas.php?page=1&rows=11&sidx=dataMatricula&sord=desc&txtNomeAluno=&txtNomeCurso=

http://127.0.0.1:8051/cursoUnisys/matricula/ajaxListarMatriculaModulos.php?page=1&rows=10&sidx=nomeModulo&sord=desc&txtNomeModulo=&txtNomeAluno=


