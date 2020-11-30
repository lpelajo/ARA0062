<?php
session_start();

if (! isset($_SESSION["autenticado"])){
        echo "
        <script>
        window.location.replace('../sessaoExpirada.html');
        </script>
        ";
}

include_once "../servico/Bd.php";

if (isset ($_SESSION["error"])){
    echo "<script>window.history.back()</script>";
}

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

$id = $_SESSION["autenticado"];

$sql = "Select login, senha from `users` where id = '$id'";
$bd = new Bd();

foreach ($bd->query($sql) as $row) {
    $dblogin = $row['login'];
    $dbsenha = $row['senha'];
}

if (isset($_POST["vlogin"])){
    $vlogin=$_POST["vlogin"];
    if ($vlogin != $dblogin || $senha != $dbsenha){
        $_SESSION["error"] = 1; //Autenticação Fail
        echo "  <script>
                    window.history.back();
                </script>";
    } else {
        $_SESSION["update"] = 1; //Atualiza E-mail
        $_SESSION["login"]=$login;
        $_SESSION["senha"]=$senha;
        echo "  <script>
                    window.location.replace('./salvar.php');
                </script>";
    }

} else if (isset($_POST["vsenha"]) && isset($_POST["ndsenha"])){
    $vsenha=$_POST["vsenha"];
    $ndsenha=$_POST["ndsenha"];
    if ($vsenha != $dbsenha){
        $_SESSION["error"] = 4; //Senha inválida
        echo "  <script>
                    window.history.back();
                </script>";
    } else if ($senha != $ndsenha){
        $_SESSION["error"] = 3; //Senhas diferentes
        echo "  <script>
                    window.history.back();
                </script>";
    } else {
        $_SESSION["update"] = 2; //Atualiza Senha
        $_SESSION["login"]=$login;
        $_SESSION["senha"]=$senha;
        echo "  <script>
                    window.location.replace('./salvar.php');
                </script>";
    }
}
