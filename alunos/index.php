<!DOCTYPE html>
<html lang="en">
<head>
<title>Produtos</title>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>  

<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="../js/jquery-ui-1.8.17.custom/css/smoothness/jquery-ui-1.8.17.custom.css">
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script> 
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script> 

<script type="text/javascript" src="js/jquery.form.js"></script>

<script src="../js/jquery.jqGrid-3.8.2/js/i18n/grid.locale-pt-br.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid-3.8.2/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<link href="../js/jquery.jqGrid-3.8.2/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>


<script>
$(function() {
	jQuery("#produtosGrid").jqGrid({
			url:'ajaxListarProduto.php',
			editurl:'modeloAction.php',
            datatype:'json',
            mtype:'GET',
            jsonReader:
				{'repeatitems':false},
            pager:'#produtosPagerGrid',
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
            sortname:'nomeProduto',
            sortorder:'asc',
			caption: "Produtos",
            colModel:[
                {label:'Cód.',width:60,align:'center',name:'idProduto'},
				{label:'Nome do Produto',width:400,align:'left',name:'nomeProduto'},
				{label:'Categoria',width:300,align:'left',name:'nomeCategoria'},
				{label:'Preco Unit',width:200,align:'left',name:'preco'},
				{label:'Unid em Estoque',width:200,align:'center',name:'estoque'}
            ] 
        });
	jQuery("#produtosGrid").jqGrid('navGrid', '#produtosPagerGrid', {del:false,add:false,edit:false,search:false,refresh:true} );
	
	//cadastro de produto
	$("#btnCadastrar").click(function(){
		window.location = "produtoCad.php";				   
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
	
		var linhaSelecionada = jQuery("#produtosGrid").getGridParam('selrow');
		
		var id = jQuery("#produtosGrid").getCell(linhaSelecionada,0);
		
		if(linhaSelecionada != null){
			
			if (confirm("Confirma a exclusão?") == true){
			
				$('#objetoQualquer').load('produtoAction.php?acao=excluir&idProduto='+id);
				jQuery("#produtosGrid").jqGrid('setGridParam',{url:'ajaxListarProduto.php?txtProduto=',page:1}).trigger('reloadGrid');
			}	
		}else{
			alert("Selecione um produto na grid");
		}			   
	})
	
	jQuery("#btnPesquisar").click(function(){
		var txtNome = $('#txtProduto').val();	
		
		jQuery("#produtosGrid").jqGrid('setGridParam',{url:'ajaxListarProduto.php?txtProduto='+txtNome ,page:1}).trigger('reloadGrid');
		
	})
	
	jQuery("#btnLimpar").click(function(){	
		$('#txtNomeProduto').val('');			
		jQuery("#produtosGrid").jqGrid('setGridParam',{url:'ajaxListarProdutos.php' ,page:1}).trigger('reloadGrid');		
	})
});
</script>
</head>
<body>
<div id="botoes" style="padding:4px 4px 4px 4px; color:#666; font-size:12px; font-weight:bold;">
    <input type="button" id="btnCadastrar" value="Cadastrar"/>
    <input type="button" id="btnEditar" value="Editar"/>
    <input type="button" id="btnDeletar" value="Deletar"/>
    <input type="text" id="txtProduto" name="txtProduto"/> 
    <input type="button" id="btnPesquisar" value="Pesquisar"/>  
    <input type="button" id="btnLimpar" value="Limpar"/>       
</div> 
<table id="produtosGrid" ></table>
<div id="produtosPagerGrid"></div>
<div id="objetoQualquer"></div>
</body>
</html>





