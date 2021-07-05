<!DOCTYPE html>
<html lang="en">
<head>
<title>Matriculas</title>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>  

<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="../js/jquery-ui-1.8.17.custom/css/smoothness/jquery-ui-1.8.17.custom.css">
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script> 
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script> 

<script type="text/javascript" src="../js/jquery.form.js"></script>

<script src="../js/jquery.jqGrid-3.8.2/js/i18n/grid.locale-pt-br.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid-3.8.2/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<link href="../js/jquery.jqGrid-3.8.2/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>


<script>
$(function() {

	jQuery("#itemGrid").jqGrid({
			url:'ajaxListarMatriculas.php',
			editurl:'modeloAction.php',
            datatype:'json',
            mtype:'GET',
            jsonReader:
				{'repeatitems':false},
            pager:'#itemPagerGrid',
            rowNum:10,
            rowList:
				[10,20,30,40,50,60,70,80,90,100],
            sortable:true,
            viewrecords:true,
            gridview:true,
            autowidth:true,
            height:370,
            shrinkToFit:true,
            forceFit:true,
            hidegrid:false,
            sortname:'nomeCurso',
            sortorder:'asc',
			caption: "Curso",
            colModel:[
                {label:'Cód.',width:60,align:'center',name:'idMatricula'},
				{label:'Nome do aluno',width:200,align:'left',name:'nomeAluno'},
				{label:'Curso.',width:200,align:'left',name:'nomeCurso'},
				{label:'CPF',width:200,align:'center',name:'cpf'},
				{label:'Telefone',width:200,align:'center',name:'telefone'},
				{label:'Data da Matricula.',width:100,align:'center',name:'dataMatricula'},
				{label:'Data de Inicio',width:100,align:'center',name:'dataInicio'}				
            ] 
        });
		
	jQuery("#itemGrid").jqGrid('navGrid', '#itemPagerGrid', {del:false,add:false,edit:false,search:false,refresh:true} );
	
	$("#btnAdicionar").click(function(){
	
		//Captura os dados do fomulário
		var idMatricula = $("#idMatricula").val();
		var nomeAluno = $("#txtNomeAluno").val();
		var nomeCurso = $("#txtNomeCurso").val();
		var dataMatricula = $("#dataMatricula").val();
		
		
		//Gravação do Item	
		gravaMatricula(idMatricula,idAluno,idCurso,dataMatricula);
	
		//Limpa Item
		limpaItem();
		
		//Atualiza o display do Total
		atualizaTotal(idMatricula);
		
	})
	
	function atualizaTotal(idMatricula){
		$.ajax({
			type:"POST",
			url:"matriculaAction.php?acao=totalVenda&idVenda="+idVenda,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				$("#Total").html(data['total']);	
			}	
		});
	}

	function gravaMatricula(idMatricula,idAluno,idCurso,dataMatricula){
		$.ajax({
			type:"POST",
			url:"matriculaAction.php?acao=gravaMatricula&idMatricula="+idMatricula+"&idAluno="+idAluno+"&idCurso="+idCurso+"&dataMatricula="+dataMatricula,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				var idMatricula = $('#idMatricula').val();	
				jQuery("#itemGrid").jqGrid('setGridParam',{url:'ajaxListarMatriculas.php?idMatricula='+idMatricula ,page:1}).trigger('reloadGrid');
					
			}	
		});
	}

	function limpaItem(){
		$("#cboAluno").val(0);
		$("#cboCurso").val(1);
		$("#txtDataMatricula").val(2);
		$("#cboAluno").focus();
	}
	/*
	$("#btnTeste").click(function(){
		var linha = jQuery("#itemGrid").getGridParam('selrow');
		var conteudo = jQuery("#itemGrid").getCell(linha,1);
		$("#txtTeste").val(conteudo);
		
		//Destravar o btnSalvar
		$("#btnSalvar").removeAttr('disabled');
		
	})
	*/
	function deletaMatricula(idMatricula,idAluno,idCurso){
		$.ajax({
			type:"POST",
			url:"matriculaAction.php?acao=excluir&idMatricula="+idMatricula+"&idAluno="+idAluno+"&idCurso="+idCurso,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
			    var retorno = data['retorno'];
				refreshGrid(retorno);
			}	
		});
	}
	
	function refreshGrid(retorno){
		if (retorno > 0){
			var idMatricula = $('#idMatricula').val();	
			jQuery("#itemGrid").jqGrid('setGridParam',{url:'ajaxListarMatricula.php?idMatricula='+idMatricula ,page:1}).trigger('reloadGrid');
		}else{
			jQuery("#itemGrid").jqGrid('setGridParam',{url:'ajaxListarMatricula.php' ,page:1}).trigger('reloadGrid');
		}
	}	
	
		
	$("#btnRemover").click(function(){
	
		var linhaSelecionada = jQuery("#itemGrid").getGridParam('selrow');
		
		var idAluno = jQuery("#itemGrid").getCell(linhaSelecionada,0);
		
		var idMatricula = $("#idMatricula").val();
		
		if(linhaSelecionada != null){
			
			if (confirm("Confirma a exclusão?") == true){
			
				deletaMatricula(idMatricula,idAluno);
			}
			
		}else{
			alert("Selecione um Registro");
		}			   
	})
	
	/*
	jQuery("#btnPesquisar").click(function(){
		var txtNome = $('#txtNomeCliente').val();	
		
		jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarVendas.php?txtNomeCliente='+txtNome ,page:1}).trigger('reloadGrid');
		
	})
	*/
	
	$('#cboAluno').change(function(){
		//Captura o ID no combo
		var id = $('#cboAluno').val();
		//Chama a função que irá retornar o Preço do produto
		buscaAluno(id);
	})
	/*
	function buscaAluno(idProduto){
		$.ajax({
			type:"POST",
			url:"vendaAction.php?acao=buscarNomeAluno&id="+idAluno,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				$("#txtNomeAluno").val(data['nomeAluno']);	
			}	
		});
	}*/
	/*
	function CalcTotal(){
		quantidade = $("#txtQuantidade").val();
		preco = $("#txtPrecoVenda").val();
		desconto = $("#txtDesconto").val();
		
		total = quantidade * preco - desconto;
		
		$("#txtTotal").val(total);
	}
	
	$("#txtQuantidade").blur(function(){
		CalcTotal();
	})
	
	$("#txtDesconto").blur(function(){
		CalcTotal();
	})
	
	jQuery("#btnLimpar").click(function(){	
		$('#txtNomeProduto').val('');			
		jQuery("#produtosGrid").jqGrid('setGridParam',{url:'ajaxListarProdutos.php' ,page:1}).trigger('reloadGrid');		
	})
	*/
	$("#btnSalvar").click(function(){
		//Captura do idCliente e idVendedor selecionados nos combos
		var idAluno = $("#cboAluno").val();
		var idCurso = $("#cboCurso").val();
		//Validação de dados
		if (idAluno == '-1'){
			alert("Aluno não foi selecionado");
			$("#idAluno").focus();
			exit;
		}
		if (idCurso == '-1'){
			alert("Curso não foi selecionado");
			$("#idCurso").focus();
			exit;
		}
		//Gravação da venda
		AdicionaMatricula(idAluno,idCurso);

		//Desabilitar o botão btnSalvar
		//$("#btnSalvar").attr("disabled","disabled");
		
		//Habilitar o botão btnCancelar
		$("#btnCancelar").removeAttr("disabled");

		//Colocar o foco no cboProduto
		$("#cboAluno").focus();
		
	})
	
	function AdicionaMatricula(idAluno,idCurso){
		$.ajax({
			type:"POST",
			url:"matriculaAction.php?acao=inserir&idAluno="+idAluno+"&idCurso="+idCurso,
			dataType:"json",
			data:{},
			success: function(data, textStatus, request){
				$("#idMatricula").val(data['idMatricula']);	
			}	
		});
	}
	
	$("#btnCancelar").click(function(){
		if(confirm("Confirma cancelamento desta matricula?")){
			$.ajax({
				type:"POST",
				url:"matriculaAction.php?acao=deletaVenda&idVenda="+$("#idVenda").val(),
				dataType:"json",
				data:{},
				success: function(data, textStatus, request){
						refreshVenda(data['retorno']);
				}	
			}); //Fim do Ajax
		} //Fim do If
	})//Fim do evento click

	function refreshVenda(retorno){
		if (retorno == 1){
			alert("Venda cancelada!");
			limpaItem();
			refreshGrid();
			$("#cboCliente").val(0);
			$("#cboVendedor").val(0);
			$("#cboCliente").focus();
			$("#btnSalvar").removeAttr("disabled");
			$("#btnCancelar").attr("disabled","disabled");
			$("#Total").html("");
		}else{
			alert("Não foi possível cancelar esta venda!");
		}
	}

	jQuery("#btnLimpar").click(function(){
		$('#cboAluno').val('');	
		$('#cboCurso').val('');			
		jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarMatriculas.php' ,page:1}).trigger('reloadGrid');		
	})
});
</script>

<?php
include_once("../conexao.php");
?>
	<link rel="stylesheet" type="text/css" href="../css/matriculaCad.css">
</head>
<body>
<table id="matricula">
	<tr><td><input type="hidden" id="idMatricula"></td></tr>
	
	<tr><td class="nameAl">Nome do Aluno</td>
		<td class="nameCr">Curso</td>
		<td><input type="button" id="btnSalvar" value="Salvar"></td>
		<td><div id="Total"></td>
	</tr>
	
	<tr><td><select id="cboAluno">
				<option value="-1">-- Selecione o aluno --</option>
				<?
					$sql="select idAluno,nomeAluno 
					      from tab_alunos
						  order by nomeAluno";
					$rs=mysql_query($sql);
					while ($reg = mysql_fetch_object($rs)){
						echo "<option value=".$reg->idAluno.">".
						                      $reg->nomeAluno."</option>";
					}
				?>
			</select></td>
		<td><select id="cboCurso">
				<option value="-1">-- Selecione o curso --</option>
				<?
					$sql="select idCurso,nomeCurso
					      from tab_cursos
						  order by nomeCurso";
					$rs=mysql_query($sql);
					while ($reg = mysql_fetch_object($rs)){
						echo "<option value=".$reg->idCurso.">".
						                      $reg->nomeCurso."</option>";
					}
				?>
			</select></td>
		<!--<td><input type="button" id="btnCancelar" value="Cancelar" disabled></td> -->
		<!--<td><input type="button" id="btnCancelar" value="Cancelar" disabled></td> -->
		<td><input type="button" id="btnLimpar" value="Limpar"/></td>
	</tr>	
</table>

<hr>
<!--
<table id="matriculas" border="1">
	<tr><td>Nome do aluno</td>
		<td>Valor Locação(R$)</td>
	</tr>
	<tr><td><select id="cboFilme">
				<option value="-1"><-Selecione o filme-></option>
				<?
					$sql="select idFilme,nomeFilme
					      from filmes
						  order by nomeFilme";
					$rs=mysql_query($sql);
					while ($reg = mysql_fetch_object($rs)){
						echo "<option value=".$reg->idFilme.">".
						                      $reg->nomeFilme."</option>";
					}
				?>
			</select></td>
		<td><input type="text" id="txtValorLocacao" value="0.00">
		
		<td><input type="button" id="btnAdicionar" value="+">
		<td><input type="button" id="btnRemover" value="-">

	</tr>	
</table>
-->
<hr>

<table id="itemGrid" ></table>
<div id="itemPagerGrid"></div>
<div id="retorno"></div>
</body>
</html>






