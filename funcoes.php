<?php


function lerArquivo($nomeArquivo){

$arquivo = file_get_contents($nomeArquivo);

$arquivoArr = json_decode($arquivo);

return $arquivoArr;

}

//parametros da função:
//1-usuário vindo de fora
//2-senha vindo de fora
//3-dados do arquivo json de usuario e senha

function realizarLogin($usuario, $senha, $dados){
    foreach($dados as $dado){
        if ($dado->usuario == $usuario && $dado->senha == $senha) {
            
            //VARIÁVEIS DE SESSÃO:
            $_SESSION["usuario"] = $dado->usuario;
            $_SESSION["id"] = session_id();
            $_SESSION["data_hora"] = date('d/m/Y - h:i:s');

            header('location: indexempresa.php');
            exit;

        }
       
    }
    header('location: index.php');
}
 //FUNÇÃO DE VERIFICAÇÃO DE LOGIN:
 //VERIFICA SE O USUÁRIO PASSOU PELO PROCESSO DE LOGIN

 function verificarLogin(){

    if( $_SESSION["id"] != session_id() || (empty($_SESSION["id"])) ){
        header("location: index.php");
    }
 }

 function finalizarLogin(){
     session_unset();//limpa todas as variáveis de sessão
     session_destroy();//destrói a sessão ativa

     header('location: index.php');
 }

?>