<!DOCTYPE html>
<html lang="en">
<head>
<title>Curso Unisys</title>
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
	jQuery("#vendasGrid").jqGrid({
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
	jQuery("#vendasGrid").jqGrid('navGrid', '#itemPagerGrid', {del:false,add:false,edit:false,search:false,refresh:true} );
	
	//cadastro de venda
	$("#btnCadastrar").click(function(){
		window.location = "matriculaCad.php";				   
	})
	
	$("#btnEditar").click(function(){
		var linhaSelecionada = jQuery("#produtosGrid").getGridParam('selrow');
		
		if (linhaSelecionada != null){
			var id = jQuery("#produtosGrid").getCell(linhaSelecionada,0);
		
			if(id != null){
				window.location = "produtoEdit.php?id="+id;				
			}
		}else{
			alert("Selecione um produto na grid");
		}	   
	})
	
	$("#btnDeletar").click(function(){
	
		var linhaSelecionada = jQuery("#vendasGrid").getGridParam('selrow'); 
		
		var id = jQuery("#vendasGrid").getCell(linhaSelecionada,0);
		
		if(linhaSelecionada != null){
			
			if (confirm("Confirma a exclusão?") == true){
			
				$('#objetoQualquer').load('matriculaAction.php?acao=excluir&idMatricula='+idMatricula);
				jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarMatriculas.php?txtNomeAluno=&txtNomeAluno=',page:1}).trigger('reloadGrid');
			}	
		}else{
			alert("Selecione uma venda na grid");
		}			   
	})
	
	$("#btnPesquisar").click(function(){
		var txtAluno = $('#txtNomeAluno').val();	
		var txtCurso = $('#txtNomeCurso').val();	
		
		jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarMatriculas.php?txtNomeAluno='+txtAluno+'&txtNomeCurso='+txtCurso,page:1}).trigger('reloadGrid');
		
	})
	
	jQuery("#btnLimpar").click(function(){	
		$('#txtNomeAluno').val('');	
		$('#txtNomeCurso').val('');			
		jQuery("#vendasGrid").jqGrid('setGridParam',{url:'ajaxListarMatriculas.php' ,page:1}).trigger('reloadGrid');		
	})
});
</script>
</head>
<body>
<div id="botoes" style="padding:4px 4px 4px 4px; color:#666; font-size:12px; font-weight:bold;">
    <input type="button" id="btnCadastrar" value="Cadastrar"/>
    <input type="button" id="btnEditar" value="Editar"/>
    <input type="button" id="btnDeletar" value="Deletar"/>
    Nome do Aluno:<input type="text" id="txtNomeAluno" name="txtNomeAluno"/> 
	Nome do Curso:<input type="text" id="txtNomeCurso" name="txtNomeCurso"/> 
    <input type="button" id="btnPesquisar" value="Pesquisar"/>  
    <input type="button" id="btnLimpar" value="Limpar"/>       
</div> 
<table id="vendasGrid" ></table>
<div id="vendasPagerGrid"></div>
<div id="objetoQualquer"></div>
</body>
</html>





