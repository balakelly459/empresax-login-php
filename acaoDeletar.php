<?php

require("./funcoes.php");

$idFuncionario = $_GET["id"];

deletarFuncionario("./empresax.json", $idFuncionario);

header("location: index.php");

