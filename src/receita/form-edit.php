<?php
require_once '../init.php';

// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// valida o ID
if (empty($id)) {
    echo "ID para alteração não definido";
    exit;
}


// abre a conexão
$PDO = db_connect();


// busca os dados du usuário a ser editado
$sql = "SELECT data, categoria, descricao, conta, valor FROM receita WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$idreceita = $stmt->fetch(PDO::FETCH_ASSOC);

// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($idreceita)) {
    echo "Receita não encontrada";
    exit;
}


// sql_count para contar o total de registros
$sql_count = "SELECT COUNT(*) AS total FROM receita";
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

// SQL para selecionar os registros
$sql_arry = "SELECT id, data, categoria, descricao, conta, valor  FROM receita";
// seleciona os registros
$stmt_array = $PDO->prepare($sql_arry);
$stmt_array->execute();

// metodo  para listar os tipos de contas existentes
// SQL para selecionar os registros
$sql_conta = "SELECT id, conta FROM conta";
// seleciona os registros
$stm_conta = $PDO->prepare($sql_conta);
$stm_conta->execute();


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contole Finaceiro</title>
    <link rel="stylesheet" type="text/css" href="../css/stilo.css">
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
    <nav class="navbar navbar-expand bg-dark">
        <a class="navbar-brand" href="#">OrganiZe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastro.php">Cadastro</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <form action="edit.php" method="post">
            <p style="text-align: center; font-size: 30px">receita</p>

            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label for="validationServer01">Data</label>
                    <input type="date" name="data" id="data" value="<?php echo $idreceita['data'] ?>" class="form-control is-valid" value="Mark" required>
                    <div class="valid-feedback">
                        <br>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationServer02">Categoria</label>
                    <input type="text" name="categoria" id="categoria" value="<?php echo $idreceita['categoria'] ?>" class="form-control is-valid" required>
                    <div class="valid-feedback">
                        <br>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationServer03">Descrição</label>
                    <input type="text" name="descricao" id="descricao" value="<?php echo $idreceita['descricao'] ?>" class="form-control is-valid" required>
                    <div class="valid-feedback">
                        <br>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationServer04">Conta</label>
                    <input type="text" name="conta" id="conta" value="<?php echo $idreceita['conta'] ?>" class="form-control is-valid" required>
                    <div class="valid-feedback">
                        <br>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationServer05">Informe o Valor</label>
                    <input type="text" name="valor" id="valor" placeholder="R$" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" value="<?php echo $idreceita['valor'] ?>">
                    <div class="valid-feedback">
                        <br>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <br>
                    <button type="submit" class="btn btn-dark">Alterar Cadastro</button>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                </div>
            </div>
        </form>
    </div>


</body>

</html>