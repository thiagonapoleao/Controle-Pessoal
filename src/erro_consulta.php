<?php
require_once 'init.php';

// abre a conexão
$PDO = db_connect();

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Contole Finaceiro</title>
	<link rel="stylesheet" type="text/css" href="css/stilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="author" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width" scale="1">
	<!-- transforma a pagina em  responsivel-->

</head>

<body style="background: rgb(240,248,255);">
	<header>
		<nav class="navbar navbar-expand bg-dark">
			<a class="navbar-brand" href="#">OrganiZe</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="cadastro/cadastro.php">Cadastro</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>

	<div class="container" id="campocpf" style="margin-top: 80px; width: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, .5); ">

		<div class="container" style="margin-left: 10px">
			<form action="index.php" method="get" class="needs-validation" id="formSearch" novalidate>
				<div align="center" >
					<div class="form-row">
						<div class="col-sm-1 mb-1">
							<img src="img/logo-1.png" alt="" style="margin-left: -35px;">
						</div>
					</div>
					<div class="form-container">
						<div class="col-sm-8 mb-1">
							<label for="validationServer01">CPF não cadastrado!</label>
						</div>
					</div>
					<br>
					<div class="container">
						<button type="submit" class="btn btn-dark">Nova Consulta</button>
					</div>
					<br>
				</div>
			</form>

		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!-- Adicionando JQuery -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	</div>


</body>

</html>