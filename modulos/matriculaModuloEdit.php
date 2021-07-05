<?php
	include('../conexao.php');
		
	//Captura do "id"	
	$idProduto = $_REQUEST[id];
	
	//Pesquisar o Produto referente ao "id" passado pela JqGrid
	$rs = mysql_query("select * from produto where idProduto=$idProduto");
	$reg = mysql_fetch_object($rs);
	
	//Recordset para armazenar as categorias existentes
	$sql = "select -1 idCategoria,
	               '--Escolha a categoria--' nomeCategoria
            union
            select idCategoria, nomeCategoria from categoria";
	
	$rsCat = mysql_query($sql);
?>

<html>
<head>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
	<script>
		function editaProduto(){
		$.ajax({
			type:"POST",
			url:"produtoAction.php",
			dataType:"json",
			data:{acao:'editar',
			      idProduto:$("#idProduto").val(),
			      nomeProduto:$("#txtNomeProduto").val(),
				  idCategoria:$("#cboCategoria").val(),
				  preco:$("#txtPreco").val(),
			  	  estoque:$("#txtEstoque").val()
				  },
			success: function(data, textStatus, request){
				$("#retorno").html(data['retorno']);
			}	
		  });
	    }
		
		function limpaForm(){
				$("#retorno").html('');
				$("#txtNomeProduto").val('');
				$("#cboCategoria").val('-1');
				$("#txtPreco").val('');
				$("#txtEstoque").val('');
				$("#txtNomeProduto").focus();
		}	
	</script>
	
</head>
<body>
	<center><h3>Altera&ccedil;&atilde;o de Produtos</h3></center>
	<hr>
	<form>
		<center>
		<input hidden type="text" name="idProduto" id="idProduto" value="<?=$idProduto?>">
		<table>
			<tr><td>Nome do Produto</td>
				<td><input type='text' name='txtNomeProduto' id='txtNomeProduto'
						   value='<?=$reg->nomeProduto?>'></td>
			</tr>
			
			<tr><td>Categoria</td>
				<td>
					<select name='cboCategoria' id='cboCategoria'>
					    <!-- <option value=-1>--Escolha a categoria--</option> -->
					<?
						while ($regCat = mysql_fetch_object($rsCat)){
						    $selecionado = ($regCat->idCategoria == $reg->idCategoria)?"selected":"";
							
							echo "<option value=".$regCat->idCategoria." $selecionado>".
							                      $regCat->nomeCategoria."</option>";
						}
					?>
					</select>
				</td>
			</tr>	
			
			<tr><td>Preço</td>
				<td><input type='text' name='txtPreco' id='txtPreco' value='<?=$reg->preco?>'></td>
			</tr>
			
			<tr><td>Estoque</td>
				<td><input type='text' name='txtEstoque' id='txtEstoque' value='<?=$reg->estoque?>'></td>
			</tr>	
			
			<tr><td><input type="button" name="btnSalvar" id="btnSalvar" 
			               value="Salvar" onClick="editaProduto()"></td>
						   
				<td><input type="button" value="Limpar" id="btnLimpar" 
				           onClick="limpaForm()"></td>
			</tr>	
 		</table>
		<div name="retorno" id="retorno"></div>
		</center>
	</form>
</body>
</html>