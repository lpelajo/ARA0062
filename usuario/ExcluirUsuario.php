<?php
session_start();
include_once "../servico/Bd.php";

if (!isset($_SESSION["autenticado"])) {
    echo "
    <script>
    window.location.replace('../sessaoExpirada.html');
    </script>
    ";
}

$id = $_SESSION["autenticado"];
$login = $_POST["login"];
$senha = $_POST["senha"];
$bd = new Bd();

$sql = "select login, senha from `users` where id='$id'";
foreach ($bd->query($sql) as $row) {
    $dblogin = $row['login'];
    $dbsenha = $row['senha'];
}

if ($login != $dblogin || $senha != $dbsenha) {
    $_SESSION["error"] = 11; //Autenticação Fail
        echo "  <script>
                    window.history.back();
                </script>";
} else {
    $sql = "update `users` set status = 0 where id='$id'";
    $bd->exec($sql);
    unset($_SESSION["autenticado"]);
    echo    "<script>
            window.location.replace('../index.php');
        </script>";
}
