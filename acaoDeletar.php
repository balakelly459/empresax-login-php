<?php

require("./funcoesempresa.php");

$idFuncionario = $_GET["id"];

deletarFuncionario("./empresax.json", $idFuncionario);

header("location: indexempresa.php");

