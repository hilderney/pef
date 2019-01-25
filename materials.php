<?php 
	include './components/header/header.php';
?>

<script src="./js/controller/material.js"></script>

<ul id="tab_material" class="nav nav-tabs">
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
		<h1>Listar Materiais</h1>
		<div id="table-container"></div>
	</div>

	<div class="tab-pane fade" id="tabAdicionar" role="tabpanel" aria-labelledby="nav-tab-adicionar">
		<h1>Criar Novo Material</h1>
		<div class="form-row">
			<div class="form-group col">
				<label for="txt_materialName"> Nome </label>
				<input type="text" class="form-control" id="txt_materialName" placeholder="Nome do Material">
			</div>
			<div class="form-group col">
				<label for="range_materialDurability"> Dureza : <span data-display="range_materialDurability">1</span> </label>
				<input type="range" min="1" max="100" value="1" class="slider" id="range_materialDurability">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="range_materialWeight"> Fator de Peso : <span data-display="range_materialWeight">1</span> </label>
				<input type="range" min="1" max="25" value="1" class="slider" id="range_materialWeight">
			</div>
			<div class="form-group col">
				<label for="range_materialValor"> Fator de Preço : <span data-display="range_materialValor">1</span> </label>
				<input type="range" min="1" max="25" value="1" class="slider" id="range_materialValor">
			</div>
		</div>
		<div class="form-group">
			<label for="txt_materialDesc">Descrição</label>
			<textarea class="form-control" id="txt_materialDesc" rows="3" placeholder="Descrição do Material"></textarea>
		</div>
		<button type="button" id="btn_createMaterial" class="btn btn-primary">Adicionar</button>	
	</div>

	<div class="tab-pane fade" id="tabEditar" role="tabpanel" aria-labelledby="nav-tab-editar">
		<h1>Editar Material</h1>
		<div class="form-row">
			<div class="form-group col">
				<label for="txt_materialName_edit"> Nome </label>
				<input type="text" class="form-control" id="txt_materialName_edit" placeholder="Nome do Material">
			</div>
			<div class="form-group col">
				<label for="range_materialDurability"> Dureza : <span data-display="range_materialDurability_edit">1</span> </label>
				<input type="range" min="1" max="50" value="1" class="slider" id="range_materialDurability_edit">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="range_materialWeight_edit"> Fator de Peso : <span data-display="range_materialWeight_edit">1</span> </label>
				<input type="range" min="1" max="25" value="1" class="slider" id="range_materialWeight_edit">
			</div>
			<div class="form-group col">
				<label for="range_materialValor_edit"> Fator de Preço : <span data-display="range_materialValor_edit">1</span> </label>
				<input type="range" min="1" max="25" value="1" class="slider" id="range_materialValor_edit">
			</div>
		</div>
		<div class="form-group">
			<label for="txt_materialDesc_edit">Descrição</label>
			<textarea class="form-control" id="txt_materialDesc_edit" rows="3" placeholder="Descrição do Material"></textarea>
		</div>
		<button type="button" id="btn_editMaterial" class="btn btn-secondary">Salvar Alterações</button>
	</div>

</div>

<script>
	$('#tab_material a').on('click', function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
</script>

<?php 
	include './components/footer/footer.php';
?>