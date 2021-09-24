<?php

//recebe o nome do arquivo
function lerArquivo($nomeArquivo) {
    //lê o arquivo como string
   $arquivo = file_get_contents($nomeArquivo);

   // transforma a string em array
   $jsonArray = json_decode($arquivo);

   //devolve o array
   return $jsonArray;
}

// function buscarFuncionario($empresax, $first_name) {
    
//     $expresaxFiltro = [];
//     foreach($empresax as $funcionario) {
//         if ($funcionario->first_name == $first_name) {
//             $empresaxFiltro[] = $funcionario;
//         }
//     }
//     return $empresaxFiltro;
// }

function buscarFuncionario($empresax, $nome)
{

    $empresaxFiltro = [];
    foreach ($empresax as $funcionario) {
        if (
            strpos($funcionario->first_name, $nome) !== false ||
            strpos($funcionario->last_name, $nome) !== false ||
            strpos($funcionario->department, $nome) !== false
        ) {
            $empresaxFiltro[] = $funcionario;
        }
    }
    return $empresaxFiltro;
}

function adicionarFuncionario(array $funcionario) {
    $empresax = lerArquivo('empresax.json');
    $id = count($empresax) + 1;
    $funcionario['id'] = $id;
    $empresax[] = $funcionario;
    $json = json_encode($empresax);
    file_put_contents('empresax.json', $json);
  }

  function deletarFuncionario($nomeArquivo, $idFuncionario) {
      $empresax = lerArquivo($nomeArquivo);

      foreach($empresax as $chave => $funcionario) {
          if ($funcionario->id == $idFuncionario) {
            unset($empresax[$chave]);
          }
       
      }

      $json = json_encode(array_values($empresax));

      file_put_contents($nomeArquivo, $json);
  }

  //Buscar funcionário por ID
  function buscarFuncionarioPorId($nomeArquivo, $idFuncionario){

      $empresax = lerArquivo($nomeArquivo);

      foreach ($empresax as $funcionario) {
          
        if ($funcionario->id == $idFuncionario) {
            
            return $funcionario;
        }

      }

      return false;

  }

  function editarFuncionario($nomeArquivo, $funcionarioEditado){

    $empresax = lerArquivo($nomeArquivo);

    foreach ($empresax as $chave => $funcionario) {
        if ($funcionario->id == $funcionarioEditado["id"]) {
            $empresax[$chave] = $funcionarioEditado;
        }
    }

    $json = json_encode(array_values($empresax));

    file_put_contents($nomeArquivo, $json);

  }
  