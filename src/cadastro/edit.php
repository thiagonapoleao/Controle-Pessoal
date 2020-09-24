<?php

require_once '../init.php';

// resgata os valores do formulário
$id = isset($_POST['id']) ? $_POST['id'] : null;
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


// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE cadastro SET nome = :nome, sexo = :sexo, datanasc = :datanasc, rg = :rg, cpf = :cpf, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade , estado = :estado, cep = :cep, telefone = :telefone, celular = :celular, email = :email WHERE id = :id";
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
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
	header('Location: ../index.php');
} else {
	echo "Erro ao alterar";
	print_r($stmt->errorInfo());
}
