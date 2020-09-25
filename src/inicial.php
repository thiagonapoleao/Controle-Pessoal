<?php
require_once 'init.php';

// abre a conexão
$PDO = db_connect();

// pega o CPF da URL
$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : null;


// busca os dados do usuário 
$sql = "SELECT nome, sexo, datanasc, cpf, rg, endereco, numero, bairro, cidade, estado, cep, telefone, celular, email FROM cadastro WHERE cpf = $cpf";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($user)) {
	echo "Nenhum usuário encontrado";
	header('Location: erro_consulta.php');
}

// sql_count para contar o total de registros
$sql_count_despesa = "SELECT COUNT(*) AS total FROM despesas where cpf = $cpf";
// conta o toal de registros
$stmt_count_despesa = $PDO->prepare($sql_count_despesa);
$stmt_count_despesa->execute();
$total_despesa = $stmt_count_despesa->fetchColumn();


// sql_count para contar o total de registros
$sql_count_receita = "SELECT COUNT(*) AS total FROM receita where cpf = $cpf";
// conta o toal de registros
$stmt_count_receita = $PDO->prepare($sql_count_receita);
$stmt_count_receita->execute();
$total_receita = $stmt_count_receita->fetchColumn();

// SQL para selecionar os registros
$sql_arry = "SELECT id, data, categoria, descricao, conta, valor  FROM despesas where cpf = $cpf";
// seleciona os registros
$stmt_array = $PDO->prepare($sql_arry);
$stmt_array->execute();

// SQL para selecionar os registros
$sql_arry_receita = "SELECT id, data, categoria, descricao, conta, valor  FROM receita where cpf = $cpf";
// seleciona os registros
$stmt_array_receita = $PDO->prepare($sql_arry_receita);
$stmt_array_receita->execute();

/// metodo para somar os valores das receitas
$sql_soma_receita = "SELECT SUM(valor) AS valor FROM receita where cpf = $cpf";
$stm_soma_receita = $PDO->prepare($sql_soma_receita);
$stm_soma_receita->execute();
$receita = $stm_soma_receita->fetchColumn();

// metodo para somar os valores das despesas
$sql_soma_despesa = "SELECT SUM(valor) AS valor FROM despesas where cpf = $cpf";
$stm_soma_despesa = $PDO->prepare($sql_soma_despesa);
$stm_soma_despesa->execute();
$despesa = $stm_soma_despesa->fetchColumn();

$saldo = $receita - $despesa;

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
	<script>
		function moeda(a, e, r, t) {
			let n = "",
				h = j = 0,
				u = tamanho2 = 0,
				l = ajd2 = "",
				o = window.Event ? t.which : t.keyCode;
			a.value = a.value.replace('R$ ', '');
			if (n = String.fromCharCode(o),
				-1 == "0123456789".indexOf(n))
				return !1;
			for (u = a.value.replace('R$ ', '').length,
				h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
			;
			for (l = ""; h < u; h++)
				-
				1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
			if (l += n,
				0 == (u = l.length) && (a.value = ""),
				1 == u && (a.value = "R$ 0" + r + "0" + l),
				2 == u && (a.value = "R$ 0" + r + l),
				u > 2) {
				for (ajd2 = "",
					j = 0,
					h = u - 3; h >= 0; h--)
					3 == j && (ajd2 += e,
						j = 0),
					ajd2 += l.charAt(h),
					j++;
				for (a.value = " ",
					tamanho2 = ajd2.length,
					h = tamanho2 - 1; h >= 0; h--)
					a.value += ajd2.charAt(h);
				a.value += r + l.substr(u - 2, u)
			}
			return !1
		}
	</script>

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
						<a class="nav-link" href="#" data-toggle="modal" data-target="#meuModal">Novo Lançamento</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container">

			<!-- Modal -->
			<div id="meuModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-sm">

					<!-- Conteúdo do modal-->
					<div class="modal-content">
						<!-- Corpo do modal -->
						<div class="modal-body" style="font-size: 18px">
							<a class="nav-link text-danger" data-toggle="modal" data-target="#despesas"><svg class="bi bi-graph-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z" />
									<path fill-rule="evenodd" d="M14.39 9.041l-4.349-5.436L7 6.646 3.354 3l-.708.707L7 8.061l2.959-2.959 3.65 4.564.781-.625z" clip-rule="evenodd" />
									<path fill-rule="evenodd" d="M10 9.854a.5.5 0 00.5.5h4a.5.5 0 00.5-.5v-4a.5.5 0 00-1 0v3.5h-3.5a.5.5 0 00-.5.5z" clip-rule="evenodd" />
								</svg>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Despesas</a>
							<a class="nav-link text-success" class="nav-link" data-toggle="modal" data-target="#receita"><svg class="bi bi-graph-up" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z" />
									<path fill-rule="evenodd" d="M14.39 4.312L10.041 9.75 7 6.707l-3.646 3.647-.708-.708L7 5.293 9.959 8.25l3.65-4.563.781.624z" clip-rule="evenodd" />
									<path fill-rule="evenodd" d="M10 3.5a.5.5 0 01.5-.5h4a.5.5 0 01.5.5v4a.5.5 0 01-1 0V4h-3.5a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
								</svg>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Receita</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Despesas -->
			<div id="despesas" class="modal fade" role="dialog">
				<form action="despesas/add.php" method="post" class="needs-validation" novalidate>
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<div class="form-row">
									<div class="col-md-13 mb-3">
										<label>Nome</label>
										<input type="text" name="nome" id="nome" value="<?php echo $user['nome']; ?>" class="form-control">
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-9 mb-3">
										<label>CPF</label>
										<input type="text" name="cpf" id="cpf" value="<?php echo $user['cpf']; ?>" class="form-control">
									</div>
								</div>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-row">
									<div class="col-md-6 mb-3">
										<label for="validationCustom01">Data</label>
										<input type="date" name="data" id="data" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="validationServer02">Informe o Valor</label>
										<input type="text" name="valor" id="valor" placeholder="R$" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" required>
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-9 mb-3">
										<label for="validationServer03">Descrição</label>
										<input type="text" name="descricao" id="descricao" class="form-control" required>
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-6 mb-3">
										<label for="validationServer04">Categoria</label>
										<input type="text" name="categoria" id="categoria" class="form-control" list="categorias" required>
										<datalist id="categorias">
											<option>Lazer</option>
											<option>Alimentação</option>
											<option>Pagamento</option>
										</datalist>
									</div>
									<div class="col-md-6 mb-3">
										<label for="validationServer05">Conta</label>
										<input type="text" name="conta" id="conta" class="form-control" list="contas" required>
										<datalist id="contas">
											<option>Carteira</option>
											<option>Cartão</option>
										</datalist>
									</div>
								</div>
							</div>
							<div class="modal-footer" style="align-self: center;">
								<button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 200px">Fechar</button>
								<button type="submit" class="btn btn-primary" style="width: 200px">Salvar</button>
							</div>

						</div>
					</div>
				</form>
			</div>

			<!-- Modal Rceita -->
			<div id="receita" class="modal fade" role="dialog">
				<form action="receita/add.php" method="post" class="needs-validation" novalidate>
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<div class="form-row">
									<div class="col-md-13 mb-3">
										<label>Nome</label>
										<input type="text" name="nome" id="nome" value="<?php echo $user['nome']; ?>" class="form-control">
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-9 mb-3">
										<label>CPF</label>
										<input type="text" name="cpf" id="cpf" value="<?php echo $user['cpf']; ?>" class="form-control">
									</div>
								</div>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">

								<div class="form-row">
									<div class="col-md-6 mb-3">
										<label for="validationServer01">Data</label>
										<input type="date" name="data" id="data" value="<?php echo date('Y-m-d'); ?>" class="form-control">
									</div>
									<div class="col-md-6 mb-3">
										<label for="validationServer02">Informe o Valor</label>
										<input type="text" name="valor" id="valor" placeholder="R$" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" required>
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-9 mb-3">
										<label for="validationServer03">Descrição</label>
										<input type="text" name="descricao" id="descricao" class="form-control" required>
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-6 mb-3">
										<label for="validationServer04">Categoria</label>
										<input type="text" name="categoria" id="categoria" class="form-control" list="categorias" required>
										<datalist id="categorias">
											<option>Pagamento</option>
											<option>Vale</option>
										</datalist>
									</div>
									<div class="col-md-6 mb-3">
										<label for="validationServer05">Conta</label>
										<input type="text" name="conta" id="conta" class="form-control" list="contas" required>
										<datalist id="contas">
											<option>Carteira</option>
											<option>Cartão</option>
										</datalist>
									</div>
								</div>
							</div>
							<div class="modal-footer" style="align-self: center;">
								<button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 200px">Fechar</button>
								<button type="submit" class="btn btn-primary" style="width: 200px">Salvar</button>
							</div>

						</div>
					</div>
				</form>
			</div>


		</div>

		<div id="interface">

			<div class="container" style="margin-top: 30px; width: 80%; box-shadow: 0px 0px 10px rgba(0, 0, 0, .5); ">
				<form action="" method="post" class="needs-validation" id="formSearch" novalidate>
					<div align="center">
						<div class="form-row">
							<div class="col-sm-2 mb-1">
								<img src="../img/logo-1.png" alt="">
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-6 mb-1">
								<label for="validationServer01">Nome</label>
								<input type="text" name="nome" id="nome" value="<?php echo $user['nome']; ?> " class="form-control">
							</div>
							<div class="col-sm-2 mb-1">
								<label for="validationServer02">RG</label>
								<input type="text" name="rg" id="rg" value="<?php echo $user['rg']; ?> " class="form-control">
							</div>
							<div class="col-sm-2 mb-1">
								<label for="validationServer03">CPF</label>
								<input type="text" name="cpf" id="cpf" value="<?php echo $user['cpf']; ?> " class="form-control">
							</div>
						</div>


						<br>
					</div>
				</form>

			</div>
		</div>

		<div class="container" align="center">
			<div class="row" style="margin-top: 50px; min-width: 300px; text-align: center; font-size: 18px">
				<div class="col-sm-3">
					<div class="shadow-lg p-3 mb-5 bg-white rounded">
						<p class="card-title"><img src="https://img.icons8.com/ultraviolet/36/000000/refund-2.png" />Saldo Atual</p>
						<p class="card-text"><?php echo 'R$ ' . number_format($saldo, 2, ',', '.') ?></p>
					</div>
				</div>
				<br>
				<div class="col-sm-3">
					<div class="shadow-lg p-3 mb-5 bg-white rounded">
						<p class="card-title text-success"><svg class="bi bi-arrow-down" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M4.646 9.646a.5.5 0 01.708 0L8 12.293l2.646-2.647a.5.5 0 01.708.708l-3 3a.5.5 0 01-.708 0l-3-3a.5.5 0 010-.708z" clip-rule="evenodd" />
								<path fill-rule="evenodd" d="M8 2.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V3a.5.5 0 01.5-.5z" clip-rule="evenodd" />
							</svg>Receita</p>
						<p class="card-text text-success"><?php echo 'R$ ' . number_format($receita, 2, ',', '.') ?></p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="shadow-lg p-3 mb-5 bg-white rounded">
						<p class="card-title text-danger"><svg class="bi bi-arrow-up" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd" />
								<path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z" clip-rule="evenodd" />
							</svg>Despesa</p>
						<p class="card-text text-danger"><?php echo 'R$ ' . number_format($despesa, 2, ',', '.') ?></p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="shadow-lg p-3 mb-5 bg-white rounded">
						<p class="card-title"><img src="https://img.icons8.com/dusk/36/000000/bank-card-back-side.png" />Cartão de Credito</p>
						<p class="card-text"><?php echo 'R$ ' . number_format($despesa, 2, ',', '.') ?></p>
					</div>
				</div>

			</div>
		</div>
		<div class="container" id="container" style="margin-top: 50px; background-color: rgb(255,255,255); width: 70%; border-radius: 5%; ">
			<form method="post">
				<br>
				<p>Total de despesas: <?php echo $total_despesa ?></p>
				<?php if ($total_despesa > 0) : ?>

					<table width="100%" align="center">
						<thead>
							<tr>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Data</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Categoria</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Descricao</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Conta</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Valor</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"></th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"></th>
							</tr>
						</thead>
						<tbody>
							<?php while ($despesas = $stmt_array->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo  dateConvert($despesas['data']) ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $despesas['categoria'] ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $despesas['descricao'] ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $despesas['conta'] ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo 'R$ ' . number_format($despesas['valor'], 2, ',', '.') ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
										<a href="despesas/form-edit.php?id=<?php echo $despesas['id'] ?>"><svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd" />
												<path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd" />
											</svg></a>
									</td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
										<a href="despesas/delete.php?id=<?php echo $despesas['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">
											<svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z" />
												<path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd" />
											</svg>
										</a>

									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>

				<?php else : ?>

					<p>Nenhuma despesa registrada</p>

				<?php endif; ?>
			</form>
			<br>
		</div>
		<div class="container" id="container" style="margin-top: 50px; background-color: rgb(255,255,255); width: 70%; border-radius: 5%; ">
			<from>
				<p>Total de receita: <?php echo $total_receita ?></p>

				<?php if ($total_receita > 0) : ?>
					<table width="100%" align="center">
						<thead>
							<tr>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Data</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Categoria</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Descricao</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Conta</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Valor</th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"></th>
								<th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"></th>
							</tr>
						</thead>
						<tbody>
							<?php while ($receita = $stmt_array_receita->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo  dateConvert($receita['data']) ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $receita['categoria'] ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $receita['descricao'] ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $receita['conta'] ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo 'R$ ' . number_format($receita['valor'], 2, ',', '.') ?></td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
										<a href="receita/form-edit.php?id=<?php echo $receita['id'] ?>"><svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd" />
												<path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd" />
											</svg></a>
									</td>
									<td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
										<a href="receita/delete.php?id=<?php echo $receita['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">
											<svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z" />
												<path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd" />
											</svg>
										</a>

									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>

				<?php else : ?>

					<p>Nenhuma receita registrada</p>

				<?php endif; ?>
				</form>
		</div>
		<br>
		<header>
			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</body>

</html>
<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>