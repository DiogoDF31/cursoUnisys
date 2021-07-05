<?php 
	include('../conexao.php');
	
	//Identifica a Ação a ser executada
	$acao = $_REQUEST[acao];

    //-- INSERIR --
	if ($acao == "inserir"){
	   //CAPTURA OS DADOS DO FORMULÁRIO
	   $nomeProduto = $_REQUEST[nomeProduto];
	   $idCategoria = $_REQUEST[idCategoria];
	   $preco       = $_REQUEST[preco];
	   $estoque     = $_REQUEST[estoque];
	
   	   //VALIDAÇÃO DE DADOS
	   if ($nomeProduto == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Nome do produto obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	
	   if ($idCategoria == '-1'){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Categoria obrigat&oacuteria!</b></font>' ));
		  exit;
 	   }

	   if ($preco == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Pre&ccedil;o obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }

	   if ($estoque == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Estoque obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }

	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "insert into produto(nomeProduto, idCategoria, preco, estoque)
               values('$nomeProduto', $idCategoria, $preco, $estoque)";

   	   mysql_query($sql) or die();
       echo json_encode(array( 'retorno' => '<font color=blue>Cadastro com sucesso!</font>'));
	}
	
	//-- EDITAR --
	if ($acao == "editar"){
	   //CAPTURA OS DADOS DO FORMULÁRIO
	   $idProduto   = $_REQUEST[idProduto];
	   $nomeProduto = $_REQUEST[nomeProduto];
	   $idCategoria = $_REQUEST[idCategoria];
	   $preco       = $_REQUEST[preco];
	   $estoque     = $_REQUEST[estoque];
	
   	   //VALIDAÇÃO DE DADOS
	   if ($nomeProduto == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Nome do produto obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }
	
	   if ($idCategoria == '-1'){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Categoria obrigat&oacuteria!</b></font>' ));
		  exit;
 	   }

	   if ($preco == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Pre&ccedil;o obrigat&oacuterio!</b></font>' ));
		  exit;
 	   }

	   if ($estoque == ''){
	      echo json_encode(array( 'retorno' => '<font color=red><b>Estoque obrigat&oacuterio!</b></font>' ));
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
	
	//-- EXCLUIR --
	if ($acao == "excluir"){
	   //CAPTURA OS DADOS DO FORMULÁRIO
	   $idProduto = $_REQUEST[idProduto];
	
	   //MONTAGEM DO COMANDO SQL 	
  	   $sql = "delete from produto where idProduto = $idProduto";

   	   mysql_query($sql) or die();
       //echo json_encode(array( 'retorno' => ''));
	}
?>


