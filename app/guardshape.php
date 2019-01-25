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
			$sql = "INSERT INTO guardshapes (name,description,weight,created) VALUES (?,?,?,?);";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute( array( $nome, $descricao, $fatorPeso, $data ) );
			print($result);
		}
	}

	if($func === 'load') {
		$sql = "SELECT * FROM guardshapes ORDER BY id;";
		$stmt = $pdo->prepare( $sql );
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (empty($result)) {
			$stmt2 = $pdo->prepare( "INSERT INTO guardshapes (name,description,created) VALUES ('Item 0','Item para ser alterado',?);" );
			$in = $stmt2->execute( array($data) );
			if($in > 0){
				
				$stmt3 = $pdo->prepare( "SELECT * FROM guardshapes ORDER BY id;" );
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
			$sql = "SELECT * FROM guardshapes WHERE id=? LIMIT 1;";
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
			$sql = $sql = "SELECT ".$field." FROM guardshapes WHERE id=? LIMIT 1";
			
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
			$sql = "UPDATE guardshapes SET name=?, description=?, weight=?, modified=? WHERE id=?;";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute( array( $nome, $descricao, $fatorPeso, $data, $id ) );
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
			$sql = "DELETE FROM guardshapes WHERE id=?;";
			$stmt = $pdo->prepare( $sql );
			$result = $stmt->execute(array( $id ) );
			print($result);
		}
	}
}
else {
	EndaDB::disconnect();
	$retorno = 'Foi encontrado os seguintes erros: ';
	foreach ($error as $e) {
		$retorno = $retorno.$e.', ';
	}
	print $retorno;
}