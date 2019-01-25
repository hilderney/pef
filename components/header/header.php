<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script
	  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
	  crossorigin="anonymous">
	</script>
	<script src="./js/config/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap-slider.js"></script>
	<link rel="stylesheet" type="text/css" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./node_modules/bootstrap/dist/css/bootstrap-slider.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./default.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Enda</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" id="home_link" href="./index.php">Home </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="about_link" role="button">Sobre</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Tabelas
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="nav-link" id="" href="./materials.php"> Materiais </a>
							<a class="nav-link" id="" href="./parts.php"> Partes </a>
							<span id="" class="dropdown-item">Another action</span>
							<span id="" class="dropdown-item">Something else here</span>
						</div>
					</li>

				</ul>
				<span class="navbar-text">
						<?php 
							date_default_timezone_set('America/Sao_Paulo');
							$date = date('Y-m-d H:i');
							echo $date;
						?>	
				</span>
			</div>
		</nav>
	</header>
	<div class="container">
		<div id="content" class="wrapper">


	