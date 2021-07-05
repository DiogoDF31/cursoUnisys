<?php

	include('../conexao.php');
	//Passagem de parâmetros para a API
	$page  = $_GET['page']; 
	$limit = $_GET['rows']; 
	$sidx  = $_GET['sidx']; 
	$sord  = $_GET['sord']; 		

	$where = " WHERE 1 = 1 ";  //TUDÃO
	
	//Filtro
	if( $_GET['txtProduto'] != "" ){	 	
		$where .= " AND nomeProduto like '%".$_GET['txtProduto']."%' ";		
	}
	
	$queryCount = "SELECT COUNT(idProduto) as count
			  	   FROM produto 
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
	
    $query = "SELECT idProduto,
					 nomeProduto,
					 nomeCategoria,
					 preco,
					 estoque
			  FROM produto inner join categoria on produto.idCategoria = categoria.idCategoria
			  $where
			  ORDER BY $sidx $sord 
			  LIMIT $start , $limit";				 
					
    $resultSet = mysql_query($query);
	
	$response->page = $page;
	$response->total = $total_pages;
	$response->records = $count;
	$i=0;
	
	while ( $row = mysql_fetch_array($resultSet) ){
						
			$response->rows[$i]['idProduto']=$row['idProduto'];
			$response->rows[$i]['nomeProduto']=$row['nomeProduto'];
			$response->rows[$i]['nomeCategoria']=$row['nomeCategoria'];
			$response->rows[$i]['preco']=$row['preco'];
			$response->rows[$i]['estoque']=$row['estoque'];
			$i++;
				
	}
	
	echo json_encode($response);

?>