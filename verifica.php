<?php
session_start();

if (isset($_SESSION["login"])) {
    $login=$_SESSION["login"];
    unset($_SESSION["login"]);
} else {
    $login=$_POST["login"];
}

if (isset($_SESSION["senha"])) {
    $senha=$_SESSION["senha"];
    unset($_SESSION["senha"]);
} else {
    $senha=$_POST["senha"];
}

include_once "./servico/Bd.php";

$sql = "select ID from `users` where login = '$login' and senha = '$senha' and status = 1";

$bd = new Bd();

$exists = false;

foreach ($bd->query($sql) as $row) {
    if ($row['ID'] != NULL){
        $exists = true;
        $ID = $row['ID'];
    }
}

if ($exists == true) {

    $_SESSION["autenticado"]=$ID;
    if (isset($_SESSION["select"])){unset($_SESSION["select"]);} //não há mais possibilidade de falha, portanto não será mais necessário voltar a tela de login para informar o erro
    
    $html ="
    <html>
        <head><title>Tela de verificação </title></head>
        <body>
         <script>
         window.location.replace('./index.php');
         </script>
        </boyd>
    </html>

";    
}else {
    unset ($_SESSION["autenticado"]);
    $_SESSION["error"] = 1; //Login Fail
    $html ="
<html>
    <head><title>Tela de verificação </title></head>
    <body>
    <script>
        window.history.back();
    </script>
    </bodys>
</html>";
    
}
echo $html;
?>