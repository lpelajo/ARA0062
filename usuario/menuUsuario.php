<?php
session_start();

if (!isset($_SESSION["autenticado"])) {
  echo "
    <script>
    window.location.replace('../sessaoExpirada.html');
    </script>
    ";
}

include_once "../servico/Bd.php";

$id = $_SESSION["autenticado"];
$sql = "select login from `users` where id = '$id'";
$bd = new Bd();

foreach ($bd->query($sql) as $row) {
  echo "<script>clogin = '" . $row['login'] . "';</script>";
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <link rel="stylesheet" href="../utils/generalStyle.css">

  <title>Gerenciamento de Usuário</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">
      <img src="../favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <img src="../utils/Fakebook-Logo.png" width="auto" height="20" class="d-inline-block mt-n1" alt="" loading="lazy">
    </a>
    <div class="btn-group form-inline ml-auto">
      <a class="navbar-brand" href="#" data-toggle="dropdown">
        <img src="../utils/userIcon.png" width="30" height="30" class="d-inline-block align-top" alt="Usuário" loading="lazy">
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item active" href="./menuUsuario.php">Configurações de Usuário</a>
        <a class="dropdown-item" href="../posts/gerenciarPosts.php">Gerenciar meus Posts</a>
        <div class="dropdown-divider"></div>
        <div class="mx-auto" style="width: 40%;">
          <a class="btn btn-primary bg-info" href="../logoff.php">Deslogar</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <form class="form-inline" style="    margin-block-end: 0em;">
      <div class="mx-auto my-3">
        <ul class="nav">
          <li class="nav-item">
            <a id="alterMail" class="btn btn-primary bg-info mx-2" href="#">Alterar E-mail</a>
          </li>
          <li class="nav-item">
            <a id="alterSenha" class="btn btn-primary bg-info mx-2" href="#">Alterar Senha</a>
          </li>
          <li class="nav-item">
            <a id="delUser" class="btn btn-primary bg-info mx-2" href="#">Excluir Conta</a>
          </li>
        </ul>
      </div>
    </form>

    <hr class="mt-0">

    <br>

    <div id="apendice">

    </div>

  </div> <!-- fim container -->

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <script src="./menuUsuario.js"></script>

  <?php
  if (isset($_SESSION["error"])) {
    echo '<script>
            erro=' . $_SESSION["error"] . ';
          </script>';
    unset($_SESSION["error"]);
  } else {
    echo '<script>erro=0;</script>';
  }
  echo '<script>errorCheck();</script>';

  if (isset($_SESSION["confirma"])) {
    echo '<script>
            console.log("' . $_SESSION["confirma"] . '");
            sucesso="' . $_SESSION["confirma"] . '";
          </script>';
    unset($_SESSION["confirma"]);
  } else {
    echo '<script>sucesso=0;</script>';
  }
  echo '<script>successCheck();</script>';
  ?>
  
</body>

</html>