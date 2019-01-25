<?php 
require'./endadb.php';

$validPart = true;

date_default_timezone_set('America/Sao_Paulo');

$data = date('Y-m-d H:i');
$error = [];

!empty($_POST['id']) ? $id = $_POST['id'] : $id = null;
!empty($_POST['nome']) ? $nome = $_POST['nome'] : $nome = null;
!empty($_POST['descricao']) ? $descricao = $_POST['descricao'] : $descricao = null;
!empty($_POST['fatorPeso']) ? $fatorPeso = $_POST['fatorPeso'] : $fatorPeso = '0';
!empty($_POST['func']) ? $func = $_POST['func'] : $func = null;
!empty($_POST['field']) ? $field = $_POST['field'] : $field = null;

if (empty($func)) {
	$validPart = false;
	array_push($error, 'Função SQL');
}

if ($validPart) {

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
		if (empty($fatorPeso)) {
			$hasInfo = false;
			array_push($error, 'FatorPeso');
		}
		
		if ($hasInfo) {
			$sql = "INSERT INTO parts (name,description,weight,created) VALUES (?,?,?,?);";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute( array( $nome, $descricao, $fatorPeso, $data ) );
			print($result);
		}
	}

	if($func === 'load') {
		$sql = "SELECT * FROM parts ORDER BY id;";
		$stmt = $pdo->prepare( $sql );
		$stmt->execute();
		$result = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
		print($result);
	}

	if($func === 'loadOne') {
		$hasInfo = true;
		if (empty($id)) {
			$hasInfo = false;
			array_push($error, 'Id');
		}
		if ($hasInfo) {
			$sql = "SELECT * FROM parts WHERE id=? LIMIT 1;";
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
			$sql = $sql = "SELECT ".$field." FROM parts WHERE id=? LIMIT 1";
			
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
		if (empty($fatorPeso)) {
			$hasInfo = false;
			array_push($error, 'FatorPeso');
		}
		if ($hasInfo) {
			$sql = "UPDATE parts SET name=?, description=?, weight=?, modified=? WHERE id=?;";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute( array( $nome, $descricao, $fatorPeso, $data, $id ) );
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








