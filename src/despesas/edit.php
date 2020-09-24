<?php

require_once '../init.php';

// resgata os valores do formulário
$data = isset($_POST['data']) ? $_POST['data'] : null;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$conta = isset($_POST['conta']) ? $_POST['conta'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
/**Script em PHP para formatar o valor para gravar no banco de dados usando a função str_replace**/
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$valor = str_replace(".", "", $valor);


// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
$isoDate = dateConvert($data);

// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE despesas SET cpf = :cpf, data = :data, categoria = :categoria, descricao = :descricao, valor = :valor, conta = :conta  WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':categoria', $categoria);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':valor', $valor);
$stmt->bindParam(':conta', $conta);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
	header('Location: ../index.php');
} else {
	echo "Erro ao alterar";
	print_r($stmt->errorInfo());
}
