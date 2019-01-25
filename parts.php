<?php 
	include './components/header/header.php';
?>

<script src="./js/controller/parts.js"></script>

<ul id="tab_parts" class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link active" id="nav-tab-listar" href="#tabListar"> Lista </a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="nav-tab-adicionar" href="#tabAdicionar"> Adiciona </a>
	</li>
	<li class="nav-item">
		<a class="nav-link nav-no-header" id="nav-tab-editar" href="#tabEditar"> </a>
	</li>
</ul>

<div class="tab-content" id="myTabContent">

	<div class="tab-pane fade show active" id="tabListar" role="tabpanel" aria-labelledby="nav-tab-listar">
		<h1>Listar Peças</h1>
		<div id="table-container"></div>
	</div>

	<div class="tab-pane fade" id="tabAdicionar" role="tabpanel" aria-labelledby="nav-tab-adicionar">
		<h1>Criar Nova Peça</h1>
		<div class="form-row">
			<div class="form-group col">
				<label for="txt_partName"> Nome </label>
				<input type="text" class="form-control" id="txt_partName" placeholder="Nome da Peça">
			</div>
			<div class="form-group col">
				<label for="range_partWeight"> Fator de Peso : <span data-display="range_partWeight">1</span> </label>
				<input type="range" min="1" max="10" value="1" class="slider" id="range_partWeight">
			</div>
		</div>
		<div class="form-group">
			<label for="txt_partDesc">Descrição</label>
			<textarea class="form-control" id="txt_partDesc" rows="3" placeholder="Descrição da Peça"></textarea>
		</div>
		<button type="button" id="btn_createPart" class="btn btn-primary">Adicionar</button>	
	</div>

	<div class="tab-pane fade" id="tabEditar" role="tabpanel" aria-labelledby="nav-tab-editar">
		<h1>Editar Peça</h1>
		<div class="form-row">
			<div class="form-group col">
				<label for="txt_partName_edit"> Nome </label>
				<input type="text" class="form-control" id="txt_partName_edit" placeholder="Nome da Peça">
			</div>
			<div class="form-group col">
				<label for="range_partWeight_edit"> Fator de Peso : <span data-display="range_partWeight_edit">1</span> </label>
				<input type="range" min="1" max="10" value="1" class="slider" id="range_partWeight_edit">
			</div>
		</div>
		<div class="form-group">
			<label for="txt_partDesc_edit">Descrição</label>
			<textarea class="form-control" id="txt_partDesc_edit" rows="3" placeholder="Descrição da Peça"></textarea>
		</div>
		<button type="button" id="btn_editPart" class="btn btn-secondary">Salvar Alterações</button>
	</div>

</div>

<script>
	$('#tab_parts a').on('click', function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
</script>

<?php 
	include './components/footer/footer.php';
?>