<?php

	include('../conexao.php');
	//Passagem de par�metros para a API
	$page  = $_GET['page']; 
	$limit = $_GET['rows']; 
	$sidx  = $_GET['sidx']; 
	$sord  = $_GET['sord']; 		

	$where = " WHERE 1 = 1 ";  //TUD�O
	
	//Filtro
	if( $_GET['txtAlunos'] != "" ){	 	
		$where .= " AND nomeAluno like '%".$_GET['txtAlunos']."%' ";		
	}
	
	$queryCount = "SELECT COUNT(idAluno) as count
			  	   FROM tab_alunos 
 			       $where";
				 
	$resultSetCount = mysql_query($queryCount);			 
				 
	$rowCount = mysql_fetch_array($resultSetCount);
	$count = $rowCount['count'];
	
	if( $count>0 ){
		$total_pages = ceil($count/$limit);	
	}else{
		$total_pages = 0;
	}
	
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit;
	
    $query = "SELECT idAluno,
					 nomeAluno,
					 cpf,
					 telefone,
					 dataNasc,
					 genero
			  FROM tab_alunos
			  $where
			  ORDER BY $sidx $sord 
			  LIMIT $start , $limit";				 
					
    $resultSet = mysql_query($query);
	
	$response->page = $page;
	$response->total = $total_pages;
	$response->records = $count;
	$i=0;
	
	while ( $row = mysql_fetch_array($resultSet) ){
						
			$response->rows[$i]['idAluno']=$row['idAluno'];
			$response->rows[$i]['nomeAluno']=$row['nomeAluno'];
			$response->rows[$i]['cpf']=$row['cpf'];
			$response->rows[$i]['telefone']=$row['telefone'];
			$response->rows[$i]['dataNasc']=$row['dataNasc'];
			$response->rows[$i]['genero']=$row['genero'];
			$i++;
				
	}
	
	echo json_encode($response);

?>