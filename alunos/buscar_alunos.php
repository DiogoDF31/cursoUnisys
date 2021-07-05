<?php
	//Conexão com o banco unisys
	include "../conexao.php";
	
	//Capturar o(s) parâmetro(s) informado(s) 'txtCodBarra'
	$codBarra = $_REQUEST['txtCodBarra'];
	
	//Montar o comando SQL para consultar no banco de dados
	$sql = "select nomeProduto,preco,estoque from produto 
	        where codBarra = '$codBarra' ";
		
	//Armazenar o recordset do registro encontrado
	$recordset = mysql_query($sql);
	$linha = mysql_fetch_array($recordset);
	
	//Retorno dos dados encontrados (usando JSON)
	echo json_encode(array( 'nome'    => $linha['nomeProduto'],
	                        'preco'   => $linha['preco'],
							'estoque' => $linha['estoque']  ));	
?>