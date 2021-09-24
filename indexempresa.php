<?php


session_start();
require("./funcoes.php");
$empresax = lerArquivo("./empresax.json");

if (isset($_GET["buscarFuncionario"])) {
    $empresax = buscarFuncionario($empresax, $_GET["buscarFuncionario"]);
}

$count = count($empresax);

if (
    !empty($_GET["first_name"]) && !empty($_GET["last_name"]) &&
    !empty($_GET["email"]) && !empty($_GET["gender"]) &&
    !empty($_GET["ip_address"]) && !empty($_GET["country"])
    && !empty($_GET["department"])
) {
    adicionarFuncionario([
        "first_name" => $_GET["first_name"],
        "last_name" => $_GET["last_name"],
        "email" => $_GET["email"],
        "gender" => $_GET["gender"],
        "ip_address" => $_GET["ip_address"],
        "country" => $_GET["country"],
        "department" => $_GET["department"],
    ]);

    header('location:' . dirname($_SERVER['PHP_SELF']));
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa X</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cadastro.css">
    <script src="script.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="quadro">
    <table>
        <h1>Funcionários da Empresa X</h1>
        <h2>A empresa conta com <em> <?= $count ?> </em> funcionários</h2>
        <form action="">
            <h4>Pesquisar: </h4>
            <div>
                <input type="text" value="<?= isset($_GET["buscarFuncionario"]) ? $_GET["buscarFuncionario"] : "" ?>" name="buscarFuncionario" placeholder="Buscar funcionário">
                <button id="button_lupa" class="material-icons">
                    person_search
                </button>
                <div class='toolbar'>
<h2>
    <?php echo 'Olá ' . strtoupper($_SESSION['usuario']) . ' - Login efetutado em: ' .$_SESSION['data_hora']; ?>
</h2>  
                </div>
                <button type="button" id="button__cadastrar">CADASTRAR FUNCIONÁRIO</button>
                <a class="material-icons" href="processa_login.php?logout=true">logout</a>

            </div>
        </form>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>E-mail</th>
            <th>Sexo</th>
            <th>Endereço IP</th>
            <th>País</th>
            <th>Departamento</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($empresax as $funcionario) :
        ?>
            <tr>
                <td><?= $funcionario->id ?></td>
                <td><?= $funcionario->first_name ?></td>
                <td><?= $funcionario->last_name ?></td>
                <td><?= $funcionario->email ?></td>
                <td><?= $funcionario->gender ?></td>
                <td><?= $funcionario->ip_address ?></td>
                <td><?= $funcionario->country ?></td>
                <td><?= $funcionario->department ?></td>
                <td>
            <button onclick="editar (<?=$funcionario->id ?>)" id="material-icons" class="material-icons">edit</button>
            <button onclick="deletar(<?= $funcionario->id ?>)"  id="material-icons-delete" class="material-icons">delete</button>
                </td>
                <!-- <td><button id="deletar">Excluir</button>
                <button class="material-icons">✏️</button></td> -->
            </tr>
        <?php
        endforeach;
        ?>
    </table>

    <div id="cadastrar__area">
        <form>
            <h1>CADASTRAR FUNCIONÁRIO</h1>
            <div id="perguntas__casdrastro">
                <div class="perguntas">
                    <label for="firstName">Nome
                        <input id="firstName" name="first_name" type="text" required>
                    </label>
                </div>
                <div class="perguntas">
                    <label for="lastName">Sobrenome
                        <input id="lastName" name="last_name" type="text" required>
                    </label>
                </div>
                <div class="perguntas">
                    <label for="email">E-mail
                        <input id="email" name="email" type="text" required>
                    </label>
                </div>
                <div class="perguntas">
                    <label for="ipAddress">Endereço de IP
                        <input id="ipAddress" name="ip_address" required>
                    </label>
                </div>
                <div class="perguntas">
                    <label for="country">País
                        <input id="country" name="country" type="text" required>
                    </label>
                </div>
                <div class="perguntas">
                    <label for="department">Departamento
                        <input id="department" name="department" type="text" required>
                    </label>
                </div>
                <div class="perguntas">
                    <label for="gender">Gênero
                        <select name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="button__area">
                <button type="button" id="button__cancelar">CANCELAR</button>
                <button id="button__cadastrar__funcionario">CADASTRAR</button>
            </div>
        </form>
    </div>

    </div>
    </div>
</body>

</html>