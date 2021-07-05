<?php

	include('../conexao.php');
	//Passagem de par�metros para a API
	$page  = $_GET['page']; 
	$limit = $_GET['rows']; 
	$sidx  = $_GET['sidx']; 
	$sord  = $_GET['sord']; 		

	$where = " WHERE 1 = 1 ";  //TUD�O
	
	//Filtro
	if( $_GET['txtNomeAluno'] != "" ){	 	
		$where .= " AND nomeAluno like '%".$_GET['txtNomeAluno']."%' ";		
	}
	
	if( $_GET['txtNomeCurso'] != "" ){	 	
		$where .= " AND nomeCurso like '%".$_GET['txtNomeAtendente']."%' ";		
	}
	
	$queryCount = "SELECT COUNT(idMatricula) as count
			  	   FROM tab_matriculas
					inner join tab_alunos on tab_matriculas.idAluno = tab_alunos.idAluno
				    inner join tab_cursos on tab_matriculas.idCurso = tab_cursos.idCurso
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
	
    $query = "select idMatricula,nomeAluno,cpf,telefone,nomeCurso,dataInicio,dataMatricula
              FROM tab_matriculas
              inner join tab_alunos on tab_matriculas.idAluno = tab_alunos.idAluno
              inner join tab_cursos on tab_matriculas.idCurso = tab_cursos.idCurso
			  $where
			  ORDER BY $sidx $sord 
			  LIMIT $start , $limit";				 
					
    $resultSet = mysql_query($query);
	
	$response->page = $page;
	$response->total = $total_pages;
	$response->records = $count;
	$i=0;
	
	while ( $row = mysql_fetch_array($resultSet) ){
						
			$response->rows[$i]['idMatricula']=$row['idMatricula'];
			$response->rows[$i]['nomeAluno']=$row['nomeAluno'];
			$response->rows[$i]['cpf']=$row['cpf'];
			$response->rows[$i]['telefone']=$row['telefone'];
            $response->rows[$i]['nomeCurso']=$row['nomeCurso'];
			$response->rows[$i]['dataMatricula']=$row['dataMatricula'];
            $response->rows[$i]['dataInicio']=$row['dataInicio'];
			$i++;
				
	}
	
	echo json_encode($response);

?>