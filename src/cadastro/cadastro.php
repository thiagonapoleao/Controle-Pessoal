<?php
require_once '../init.php';

// abre a conexão
$PDO = db_connect();


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

<body style="background: rgb(240,248,255);">
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
                        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastro</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div id="interface">
        <div class="container" style="margin-top: 30px; width: 80%; box-shadow: 0px 0px 10px rgba(0, 0, 0, .5); ">
            <form action="add.php" method="post" class="needs-validation" id="formSearch" novalidate>
                <div align="center">
                    <br>
                    <div class="form-row">
                        <div class="col-sm-5 mb-1">
                            <label for="validationServer01">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer02">Sexo</label>
                            <select type="text" name="sexo" id="sexo" class="form-control" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </div>
                        <div class="col-sm-3 mb-1">
                            <label for="validationServer03">Data Nascimento</label>
                            <input type="date" name="datanasc" id="datanasc" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer04">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer05">RG</label>
                            <input type="text" name="rg" id="rg" class="form-control" required>
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer06">Endereço</label>
                            <input type="text" name="endereco" id="endereco" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer07">Numero</label>
                            <input type="text" name="numero" id="numero" class="form-control" required>
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label for="validationServer08">Bairro</label>
                            <input type="text" name="bairro" id="bairro" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer09">Cidade</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" required>
                        </div>
                        <div class="col-sm-1 mb-1">
                            <label for="validationServer010">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer11">CEP</label>
                            <input type="text" name="cep" id="cep" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer12">Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="form-control" required>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="validationServer13">Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control" required>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="validationServer14">E-Mail</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <button type="submit" class="btn btn-dark">Cadastrar</button>
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