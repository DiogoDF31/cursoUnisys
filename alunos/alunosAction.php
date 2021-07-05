<?php 
	include('../conexao.php');
	
	//Identifica a A��o a ser executada
	$acao = $_REQUEST[acao];

    //-- INSERIR --
	if ($acao == "inserir"){
	   //CAPTURA OS DADOS DO FORMUL�RIO
	   $nomeAluno = $_REQUEST[nomeAluno];
	   $cpf       = $_REQUEST[cpf];
	   $telefone     = $_REQUEST[telefone];
	   $dataNasc     = $_REQUEST[dataNasc];
	   $genero     = $_REQUEST[genero];
	
   	   //VALIDA��O DE DADOS
	   if ($nomeAluno == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Nome do aluno obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	
	   if ($cpf == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>CPF obrigat&oacuteria!</b></font>' ));
		  exit;
 	   }

	   if ($telefone == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>telefone obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }

	   if ($dataNasc == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>data nascimento obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }

		if ($genero == ''){
			echo json_encode(array( 'retorno' => '<font color=red><b>genero obrigat&oacuterio!</b></font>' ));
			exit;
		}

	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "INSERT INTO tab_alunos(nomeAluno, cpf, telefone, dataNasc, genero)
               VALUES('$nomeAluno', '$cpf', '$telefone', '$dataNasc', '$genero')";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=green>Cadastro com sucesso!</font>'));
	}
	
	/*
	//-- EDITAR --
	if ($acao == "editar"){
	   //CAPTURA OS DADOS DO FORMUL�RIO
	   $nomeAluno = $_REQUEST[nomeAluno];
	   $cpf       = $_REQUEST[cpf];
	   $telefone     = $_REQUEST[telefone];
	   $dataNasc     = $_REQUEST[dataNasc];
	   $genero     = $_REQUEST[genero];
	
   	   //VALIDA��O DE DADOS
		  if ($nomeAluno == ''){
			echo json_encode(array( 'retorno' => '<font color=red><b>Nome do aluno obrigat&oacuterio!</b></font>' ));
			exit;
		  }
	  
		 if ($cpf == ''){
			echo json_encode(array( 'retorno' => '<font color=red><b>CPF obrigat&oacuteria!</b></font>' ));
			exit;
		  }
		  
		 if ($telefone == ''){
			echo json_encode(array( 'retorno' => '<font color=red><b>telefone obrigat&oacuterio!</b></font>' ));
			exit;
		  }
		  
		 if ($dataNasc == ''){
			echo json_encode(array( 'retorno' => '<font color=red><b>data nascimento obrigat&oacuterio!</b></font>' ));
			exit;
		  }
		  
		  if ($genero == ''){
			  echo json_encode(array( 'retorno' => '<font color=red><b>genero obrigat&oacuterio!</b></font>' ));
			  exit;
		  }
	
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "update tab_alunos set nomeAluno = '$nomeAluno',
									cpf = $cpf,
									telefone       = $telefone,
									dataNasc     = $dataNasc,
									genero     = $genero  
	           where idProduto = $idProduto";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=blue>Altera&ccedil;&atilde;o com sucesso!</font>'));
	}
	*/
	
	//-- EXCLUIR --
	if ($acao == "excluir"){
	   //CAPTURA OS DADOS DO FORMUL�RIO
	   $cpf = $_REQUEST[cpf];
	
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "delete from tab_alunos where cpf = $cpf";

   	   mysql_query($sql) or die();
       //echo json_encode(array( 'retorno' => ''));
	}
?>


