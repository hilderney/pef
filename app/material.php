<?php 
require'./endadb.php';

$validMaterial = true;

date_default_timezone_set('America/Sao_Paulo');

$data = date('Y-m-d H:i');
$error = [];

!empty($_POST['id']) ? $id = $_POST['id'] : $id = null;
!empty($_POST['nome']) ? $nome = $_POST['nome'] : $nome = null;
!empty($_POST['descricao']) ? $descricao = $_POST['descricao'] : $descricao = null;
!empty($_POST['dureza']) ? $dureza = $_POST['dureza'] : $dureza = '0';
!empty($_POST['fatorPeso']) ? $fatorPeso = $_POST['fatorPeso'] : $fatorPeso = '0';
!empty($_POST['fatorValor']) ? $fatorValor = $_POST['fatorValor'] : $fatorValor = '0';
!empty($_POST['func']) ? $func = $_POST['func'] : $func = null;
!empty($_POST['field']) ? $field = $_POST['field'] : $field = null;

if (empty($func)) {
	$validMaterial = false;
	array_push($error, 'Função SQL');
}

if ($validMaterial) {

	$pdo = EndaDB::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	if($func === 'create') {
		$hasInfo = true;

		if (empty($nome)) {
			$hasInfo = false;
			array_push($error, 'Nome');
		}
		if (empty($descricao)) {
			$hasInfo = false;
			array_push($error, 'Descrição');
		}
		if (empty($dureza)) {
			$hasInfo = false;
			array_push($error, 'Dureza');
		}
		if (empty($fatorPeso)) {
			$hasInfo = false;
			array_push($error, 'Fator Peso');
		}
		if (empty($fatorValor)) {
			$hasInfo = false;
			array_push($error, 'Fator Valor');
		}

		if ($hasInfo) {

			$sql = "INSERT INTO materials (name,description,hardness,weight,value,created) VALUES (?,?,?,?,?,?);";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute( array( $nome, $descricao, $dureza, $fatorPeso, $fatorValor, $data ) );
			print($result);
		}
	}

	if($func === 'load') {
		$sql = "SELECT * FROM materials ORDER BY id;";
		$stmt = $pdo->prepare( $sql );
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (empty($result)) {
			$stmt2 = $pdo->prepare( "INSERT INTO materials (id,name,description,created) VALUES (0,'Item 0','Item para ser alterado',?);" );
			$in = $stmt2->execute( array($data) );
			if($in > 0){
				
				$stmt3 = $pdo->prepare( "SELECT * FROM materials ORDER BY id;" );
				$stmt3->execute();
				$result = json_encode($stmt3->fetchAll(PDO::FETCH_ASSOC));
				print($result);
			}
		}
		else{
			print(json_encode($result));
		}
	}

	if($func === 'loadOne') {
		$hasInfo = true;
		if (empty($id)) {
			$hasInfo = false;
			array_push($error, 'Id');
		}
		if ($hasInfo) {
			$sql = "SELECT * FROM materials WHERE id=? LIMIT 1;";
			$stmt = $pdo->prepare( $sql );
			$stmt->execute(array( $id ) );
			$result = json_encode($stmt->fetch());
			print($result);
		}
	}

	if($func === 'loadItem') {
		$hasInfo = true;
		if (empty($id)) {
			$hasInfo = false;
			array_push($error, 'Id');
		}
		if (empty($field)) {
			$hasInfo = false;
			array_push($error, 'Field');
		}
		if ($hasInfo) {
			$sql = $sql = "SELECT ".$field." FROM materials WHERE id=? LIMIT 1";
			
			$stmt = $pdo->prepare( $sql );
			$stmt->execute( array( $id ) );
			$result = json_encode( $stmt->fetch() );
			print($result);
		}
	}

	if($func === 'edit') {
		$hasInfo = true;
		if (empty($id)) {
			$hasInfo = false;
			array_push($error, 'Id');
		}
		if (empty($nome)) {
			$hasInfo = false;
			array_push($error, 'Nome');
		}
		if (empty($descricao)) {
			$hasInfo = false;
			array_push($error, 'Descrição');
		}
		if (empty($dureza)) {
			$hasInfo = false;
			array_push($error, 'Dureza');
		}
		if ($hasInfo) {
			$sql = "UPDATE materials SET name=?, description=?, hardness=?, weight=?, value=?, modified=? WHERE id=?;";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute( array( $nome, $descricao, $dureza, $fatorPeso, $fatorValor, $data, $id ) );
			print($result);
		}
	}

	if($func === 'delete') {
		$hasInfo = true;
		if (empty($id)) {
			$hasInfo = false;
			array_push($error, 'Id');
		}
		if ($hasInfo) {
			$sql = "DELETE FROM materials WHERE id=?;";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute(array( $id ) );
			print($result);
		}
	}

	EndaDB::disconnect();		
	
}
else {
	$retorno = 'Foi encontrado os seguintes erros: ';
	foreach ($error as $e) {
		$retorno = $retorno.$e.', ';
	}
	print $retorno;
}








