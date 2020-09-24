<?php
require_once '../init.php';

// abre a conexão
$PDO = db_connect();


// sql_count para contar o total de registros
$sql_count = "SELECT count(cpf) FROM cadastro";
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();


// SQL para selecionar os registros
$sql_arry = "SELECT id, nome, sexo, datanasc, cidade, estado FROM cadastro order by nome asc";
// seleciona os registros
$stmt_array = $PDO->prepare($sql_arry);
$stmt_array->execute();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>INSTITUTO XAMÂNICO OM MANI PADME HUM</title>
    <link rel="stylesheet" type="text/css" href="../stilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width" scale="1">

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <!-- transforma a pagina em  responsivel-->
</head>

<body style="background-image:  url('../img/index-1.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; ">
    <!--Importando Script Jquery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <header>
        <nav class="navbar navbar-expand bg-dark">
            <a class="navbar-brand" href="#">OrganiZe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="../inicial.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../despesas/fromdespesas.php">Despesas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../receita/fromreceitas.php">Receita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastro</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div id="interface" style="background-image:  url('../img/logo-3.png'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; margin-top: 20px">

        <div class="container" style="color: rgba(236, 173, 33);">
            <from>
                <p>Total de Participantes Cadastrados: <?php echo $total ?></p>

                <?php if ($total > 0) : ?>

                    <table width="95%" align="center">
                        <thead>
                            <tr style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Codigo</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Data de Cadastro</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Nome</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Sexo</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Data Nascimento</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Cidade</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Estado</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Edit</th>
                                <th style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($cadastro = $stmt_array->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $cadastro['id'] ?></td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $cadastro['data'] ?></td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $cadastro['nome'] ?></td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $cadastro['sexo'] ?></td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $cadastro['datanasc'] ?></td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $cadastro['cidade'] ?></td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;"><?php echo $cadastro['estado'] ?></td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                        <a href="form-edit.php?id=<?php echo $cadastro['id'] ?>"><svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd" />
                                                <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd" />
                                            </svg></a>
                                    </td>
                                    <td style="border-top-style: groove;border-left-style: groove;border-right-style: groove;border-bottom-style: groove;">
                                        <a href="delete.php?id=<?php echo $cadastro['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">
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

                <?php endif; ?>
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