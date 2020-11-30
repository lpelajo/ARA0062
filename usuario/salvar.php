<?php
session_start();
include_once "../servico/Bd.php";

if (isset($_SESSION["login"])) {
    $login = $_SESSION["login"];
    unset($_SESSION["login"]);
} else {
    $login = $_POST["login"];
}
if (isset($_SESSION["senha"])) {
    $senha = $_SESSION["senha"];
    unset($_SESSION["senha"]);
} else {
    $senha = $_POST["senha"];
}


//Checa duplicidade de E-mail
$bd = new Bd();
$sql = "select ID from `users` where login = '$login' and status = 1";

$exists = false;
foreach ($bd->query($sql) as $row) {
    if ($row['ID'] != NULL) {
        $exists = true;
    }
}

if (isset($_SESSION["update"]) && $_SESSION["update"] == 2) { //altera a senha
    unset($_SESSION["update"]);
    $id = $_SESSION["autenticado"];
    $sql = "update `users` set senha='$senha' where id='$id'";
    $bd->exec($sql);
    $_SESSION["confirma"] = 'senha';
    echo " <script>
                window.location.replace('./menuUsuario.php');
            </script>";
} else if ($exists == true) { //Já existe um usuário com o mesmo nome
    $_SESSION["error"] = 2; //Cadastro Fail
    echo " <script>
                window.history.back();
            </script>";
} else if (isset($_SESSION["update"]) && $_SESSION["update"] == 1) { //altera o E-mail
    unset($_SESSION["update"]);
    $id = $_SESSION["autenticado"];
    $sql = "update `users` set login='$login', senha='$senha' where id='$id'";
    $bd->exec($sql);
    $_SESSION["confirma"] = 'email';
    echo " <script>
                window.location.replace('./menuUsuario.php');
            </script>";
} else {
    $dsenha = $_POST["dsenha"];
    if ($senha != $dsenha) {
        $_SESSION["error"] = 3; //Senhas diferentes
        echo " <script>
                window.history.back();
            </script>";
    } else { //cria usuário
        $sql = "select ID from `users` where login = '$login' and status = 0";

        $reativar = false;
        foreach ($bd->query($sql) as $row) {
            if ($row['ID'] != NULL) {
                $reativar = true;
                $id = $row['ID'];
            }
        }

        if ($reativar == true) { //reativa usuário
            $sql = "update `users` set senha='$senha', status = 1 where id='$id'";
            $bd->exec($sql);
        } else { //adiciona novo usuário
            $sql = "INSERT INTO `users` (`ID`, `login`, `senha`, `status`) VALUES (NULL, '$login', '$senha', '1')";
            $bd->exec($sql);
        }

        $_SESSION["login"] = $login;
        $_SESSION["senha"] = $senha;
        echo " <script>
                window.location.replace('../verifica.php');
            </script>";
    }
}
