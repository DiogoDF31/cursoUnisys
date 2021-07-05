<?php

	include('../conexao.php');
	//Passagem de par�metros para a API
	$page  = $_GET['page']; 
	$limit = $_GET['rows']; 
	$sidx  = $_GET['sidx']; 
	$sord  = $_GET['sord']; 		

	$where = " WHERE 1 = 1 ";  //TUD�O
	
	//Filtro
	if( $_GET['txtNomeModulo'] != "" ){	 	
		$where .= " AND nomeModulo like '%".$_GET['txtNomeModulo']."%' ";		
	}
	/*
	if( $_GET['txtNomeAluno'] != "" ){	 	
		$where .= " AND nomeAluno like '%".$_GET['txtNomeAluno']."%' ";		
	}*/
	
	$queryCount = "SELECT COUNT(idMatriculaModulo) as count
			  	   FROM tab_matriculaModulos
					inner join tab_modulos on tab_matriculaModulos.idModulo = tab_modulos.idModulo
				    inner join tab_matriculas on tab_matriculaModulos.idMatricula = tab_matriculas.idMatricula
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
	
    $query = "select idMatriculaModulos,idMatricula,nomeAluno,nomeModulo,valorCobrado
				FROM tab_matriculaModulos
				inner join tab_modulos on tab_matriculaModulos.idModulo = tab_modulos.idModulo
				inner join tab_matriculas on tab_matriculaModulos.idMatricula = tab_matriculas.idMatricula
			  $where
			  ORDER BY $sidx $sord 
			  LIMIT $start , $limit";				 
					
    $resultSet = mysql_query($query);
	
	$response->page = $page;
	$response->total = $total_pages;
	$response->records = $count;
	$i=0;
	
	while ( $row = mysql_fetch_array($resultSet) ){
						
			$response->rows[$i]['idMatriculaModulos']=$row['idMatriculaModulos'];
			$response->rows[$i]['idMatricula']=$row['idMatricula'];
			$response->rows[$i]['nomeAluno']=$row['nomeAluno'];
			$response->rows[$i]['nomeModulo']=$row['nomeModulo'];
            $response->rows[$i]['valorCobrado']=$row['valorCobrado'];
			$i++;
				
	}
	
	echo json_encode($response);

?>