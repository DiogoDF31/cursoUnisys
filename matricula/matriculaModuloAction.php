<?php 
	include('../conexao.php');
	
	//Identifica a A��o a ser executada
	$acao = $_REQUEST[acao];

    //-- INSERIR --
	//CAPTURA OS DADOS DO FORMUL�RIO/URL
	if ($acao == "inserir"){
	   $idModulo  = $_REQUEST['idModulo'];
	   $idMatricula = $_REQUEST['idMatricula'];
	   $valorCobrado = $_REQUEST['valorCobrado'];
	
   	   //VALIDA��O DE DADOS
	   if ($idModulo <= 0){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Modulo obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	
	   if ($idMatricula <= 0){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Matricula obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }

	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "INSERT INTO tab_matriculaModulos(idMatricula,idModulo,valorCobrado)
               VALUES($idMatricula, $idModulo, $valorCobrado)";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=blue>Cadastro com sucesso!</font>'));
	}

	//Action para gravar o filme locado
	//Exemplo: http://127.0.0.1:8051/locadora/locacoes/locacaoAction.php?acao=gravaFilmeLocado&idLocacao=13&idFilme=6&valorLocacao=9.90
	if ($acao == 'gravaMatricula'){
		$idMatricula = $_REQUEST['idMatricula'];
		$idAluno = $_REQUEST['idAluno'];
		$idCurso = $_REQUEST['idCurso'];
		$dataMatricula = $_REQUEST['dataMatricula'];
		$sql="INSERT INTO tab_matriculas(idMatricula,idAluno,idCurso,dataMatricula)
			  VALUES($idMatricula, $idAluno, $idCurso, date_add(now()))";
		mysql_query($sql)or die("erro na grava��o");
		echo json_encode(array( 'retorno' => '<font color=blue>Matricula Salva!</font>'));	
	}	

	//--http://127.0.0.1:8051/locadora/locacoes/locacaoAction.php?acao=buscarValorLocacao&id=3
	//Action para atualizar o valor da loca��o no formul�rio
	if ($acao == 'buscarNomeAluno'){ 	
		$idAluno = $_REQUEST['id'];
		$sql = "select nomeAluno from tab_alunos
		        where idAluno = $idAluno";
		$rs = mysql_query($sql);
		$reg = mysql_fetch_array($rs);
		echo json_encode(array( 'nomeAluno'=>$reg['nomeAluno'] ));
	}



/*	
	//-- EDITAR --
	if ($acao == "editar"){
	   //CAPTURA OS DADOS DO FORMUL�RIO
	   $idAluno = $_REQUEST[idAluno];
	   $idCurso = $_REQUEST[idCurso];
	   $dataMatricula = $_REQUEST[dataMatricula];
	
   	   //VALIDA��O DE DADOS
	   if ($idAluno == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Nome do Aluno obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	
	   if ($idCurso == '-1'){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Curso obrigat&oacuteria!</b></font>' ));
		  exit;
 	   }

	   if ($dataMatricula == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Pre&ccedil;o obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "update produto set nomeProduto = '$nomeProduto',
	                              idCategoria = $idCategoria,
								  preco       = $preco,
	                              estoque     = $estoque 
	           where idProduto = $idProduto";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=blue>Altera&ccedil;&atilde;o com sucesso!</font>'));
	}
*/
	
	//-- EXCLUIR --
	if ($acao == "excluir"){
	   //CAPTURA OS DADOS DO FORMUL�RIO
	   $idMatriculaModulo = $_REQUEST[idMatriculaModulo];
	
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "delete from tab_matriculaModulos where idMatriculaModulo = $idMatriculaModulo";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => 'registro excluido'));
	}
?>


