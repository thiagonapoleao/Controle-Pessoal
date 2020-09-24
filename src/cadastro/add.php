<?php

require_once '../init.php';


// pega os dados do formuário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
$datanasc = isset($_POST['datanasc']) ? $_POST['datanasc'] : null;
$rg = isset($_POST['rg']) ? $_POST['rg'] : null;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$numero = isset($_POST['numero']) ? $_POST['numero'] : null;
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;
$cep = isset($_POST['cep']) ? $_POST['cep'] : null;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$celular = isset($_POST['celular']) ? $_POST['celular'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;


$PDO = db_connect();
$sql_count = "select count(*) user from cadastro where cpf = '" . $cpf . "'";
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

if ($total == 1) {
	header('Location: user_cadastrado.php');
} else {
	// a data vem no formato dd/mm/YYYY
	// então precisamos converter para YYYY-mm-dd
	$isoDate = dateConvert($data);

	// insere no banco
	$PDO = db_connect();
	$sql = "INSERT INTO cadastro( nome, sexo, datanasc, rg, cpf, endereco, numero, bairro, cidade, estado, cep, telefone, celular, email) VALUES( :nome, :sexo, :datanasc, :rg, :cpf, :endereco, :numero, :bairro, :cidade, :estado, :cep, :telefone, :celular, :email)";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':sexo', $sexo);
	$stmt->bindParam(':datanasc', $datanasc);
	$stmt->bindParam(':rg', $rg);
	$stmt->bindParam(':cpf', $cpf);
	$stmt->bindParam(':endereco', $endereco);
	$stmt->bindParam(':numero', $numero);
	$stmt->bindParam(':bairro', $bairro);
	$stmt->bindParam(':cidade', $cidade);
	$stmt->bindParam(':estado', $estado);
	$stmt->bindParam(':cep', $cep);
	$stmt->bindParam(':telefone', $telefone);
	$stmt->bindParam(':celular', $celular);
	$stmt->bindParam(':email', $email);

	if ($stmt->execute()) {
		header('Location: cadastro.php');
	} else {
		echo "Erro ao cadastrar";
		print_r($stmt->errorInfo());
	}
}
