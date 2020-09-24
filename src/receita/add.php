<?php

require_once '../init.php';

// pega os dados do formuário
$data = isset($_POST['data']) ? $_POST['data'] : null;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$conta = isset($_POST['conta']) ? $_POST['conta'] : null;
/**Script em PHP para formatar o valor para gravar no banco de dados usando a função str_replace**/
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$valor = str_replace(".","",$valor);



// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
$isoDate = dateConvert($data);

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO receita(cpf, data, categoria, descricao, conta, valor) VALUES(:cpf, :data, :categoria, :descricao, :conta, :valor)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':categoria', $categoria);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':conta', $conta);
$stmt->bindParam(':valor', $valor);


if ($stmt->execute())
{
	header('Location: ../index.php');
}
else
{
	echo "Erro ao cadastrar";
	print_r($stmt->errorInfo());
}