<?php
    //Recordset para armazenar as categorias existentes
	include('../conexao.php');
	$sql = "select -1 idCategoria,
	               '--Escolha a categoria--' nomeCategoria
            union all
            select idCategoria, nomeCategoria from categoria";
	
	$rs = mysql_query($sql);
	
?>
<html>
<head>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
	<script>
		function adicionaAluno(){
			$.ajax({
				type:"POST",
				url:"alunosAction.php",
				dataType:"json",
				data:{acao:'inserir',
				  	  nomeAluno:$("#txtNomeAluno").val(),
					  cpf:$("#txtCpf").val(),
					  telefone:$("#txtTelefone").val(),
					  dataNasc:$("#txtDataNasc").val(),
					  genero:$("#txtGenero").val()
					  },
				success: function(data, textStatus, request){
					$("#retorno").html(data['retorno']);
				}	
			});
		}
	
		function limpaForm(){
				$("#retorno").html('');
				$("#txtNomeAluno").val('');
				$("#txtCpf").val('');
				$("#txtTelefone").val('');
				$("#txtDataNasc").val('');
				$("#txtGenero").val('');
				$("#txtNomeAluno").focus();
		}	
	
	</script>
	
</head>
<body>
	<center><h3>Cadastro de Alunos</h3></center>
	<hr>
	
	<form>
		<center>
		<table>
			<tr><td>Nome do Aluno</td>
				<td><input type='text' name='txtNomeAluno' id='txtNomeAluno'></td>
				
			<tr><td>CPF</td>
				<td><input type='text' id="txtCpf"></input></td>
				
			<tr><td>Telefone</td>
				<td><input type='text' name='txtTelefone' id='txtTelefone'></td>
				
			<tr><td>Data Nascimento</td>
				<td><input type='text' name='txtDataNasc' id='txtDataNasc'></td>
				
			<tr><td>Genero</td>
				<td><input type='text' name='txtGenero' id='txtGenero'></td>
				
			<tr><td><input type="button" name="btnSalvar" id="btnSalvar" 
			               value="Salvar" onClick="adicionaAluno()"></td>
						   
				<td><input type="button" name="btnLimpar" id="btnLimpar"
						   value="Limpar" onClick="limpaForm()"></td>
			</tr>	
		</table>
		<div name="retorno" id="retorno"></div>
	</form>
</body>
</html>