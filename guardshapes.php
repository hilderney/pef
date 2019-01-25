<?php 
	include './components/header/header.php';
?>

<script src="./js/controller/guardshapes.js"></script>

<ul id="tab_guardshapes" class="nav nav-tabs">
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
		<h1>Listar Forma da Guarda</h1>
		<div id="table-container"></div>
	</div>

	<div class="tab-pane fade" id="tabAdicionar" role="tabpanel" aria-labelledby="nav-tab-adicionar">
		<h1>Criar Nova Forma da Guarda</h1>
		<div class="form-row">
			<div class="form-group col">
				<label for="txt_guardShapeName"> Nome </label>
				<input type="text" class="form-control" id="txt_guardShapeName" placeholder="Nome da Peça">
			</div>
			<div class="form-group col">
				<label for="range_guardShapeWeight"> Fator de Peso : <span data-display="range_guardShapeWeight">1</span> </label>
				<input type="range" min="1" max="10" value="1" class="slider" id="range_guardShapeWeight">
			</div>
		</div>
		<div class="form-group">
			<label for="txt_guardShapeDesc">Descrição</label>
			<textarea class="form-control" id="txt_guardShapeDesc" rows="3" placeholder="Descrição da Peça"></textarea>
		</div>
		<button type="button" id="btn_createGuardShape" class="btn btn-primary">Adicionar</button>	
	</div>

	<div class="tab-pane fade" id="tabEditar" role="tabpanel" aria-labelledby="nav-tab-editar">
		<h1>Editar Peça</h1>
		<div class="form-row">
			<div class="form-group col">
				<label for="txt_guardShapeName_edit"> Nome </label>
				<input type="text" class="form-control" id="txt_guardShapeName_edit" placeholder="Nome da Peça">
			</div>
			<div class="form-group col">
				<label for="range_guardShapeWeight_edit"> Fator de Peso : <span data-display="range_guardShapeWeight_edit">1</span> </label>
				<input type="range" min="1" max="10" value="1" class="slider" id="range_guardShapeWeight_edit">
			</div>
		</div>
		<div class="form-group">
			<label for="txt_guardShapeDesc_edit">Descrição</label>
			<textarea class="form-control" id="txt_guardShapeDesc_edit" rows="3" placeholder="Descrição da Peça"></textarea>
		</div>
		<button type="button" id="btn_editGuardShape" class="btn btn-secondary">Salvar Alterações</button>
	</div>

</div>

<script>
	$('#tab_guardshapes a').on('click', function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
</script>

<?php 
	include './components/footer/footer.php';
?>