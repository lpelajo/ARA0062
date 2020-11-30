<?php
session_start();
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

  <link rel="stylesheet" href="./utils/generalStyle.css">

  <title>Login Fez-se Book</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">
      <img src="./favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <img src="./utils/Fakebook-Logo.png" width="auto" height="20" class="d-inline-block mt-n1" alt="" loading="lazy">
    </a>
    <form class="form-inline ml-auto">
      <a class="nav-link btn btn-primary bg-info mx-1" href="./login.php?login=true">Login</a>
      <a class="nav-link btn btn-primary bg-info mx-1" href="./login.php?cadastro=true">Cadastro</a>
    </form>
  </nav>

  <div class="container-fluid">

    <div class="mx-auto mt-5" style="max-width: 25%;">

      <?php
      if (isset($_SESSION["error"])) {
        if ($_SESSION["error"] == 1) { //Login Fail
          echo '<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger my-2" role="alert">
        O e-mail e/ou senha são inválidos.
          </div></div>';
        } else if ($_SESSION["error"] == 2) { //Cadastro Fail
          echo '<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger my-2" role="alert">
        O endereço de e-mail utilizado já está em uso.
          </div></div>';
        } else if ($_SESSION["error"] == 3) { //Senhas Diferentes
          echo '<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger my-2" role="alert">
        Ambas as senhas devem ser iguais.
          </div></div>';
        }
        unset($_SESSION["error"]);
      }

      if (!isset($_SESSION["select"]) || $_SESSION["select"] == 1) { //Default Login
        echo '
        <div id=userInterface class="card bg-light">
          <h5 class="card-title ml-3 mt-3"">Login</h5>
          <div class="card-body">
            <form action="verifica.php" method="post">
              <div class="form-group mr-auto">
                <label for="InputEmail1">E-mail</label>
                <input type="email" name="login" class="form-control" id="InputEmail1" size="20" required placeholder="example@email.com">
              </div>
              <div class="form-group">
                <label for="InputPassword1">Senha</label>
                <input type="password" name="senha" class="form-control" id="InputPassword1" required>
              </div>
              <button type="submit" class="btn btn-primary bg-info">Entrar</button>
            </form>
          </div>
        </div>
      ';
      } else if ($_SESSION["select"] == 2) { //Cadastro
        echo '
        <div id=userInterface class="card bg-light">
          <h5 class="card-title ml-3 mt-3"">Cadastro</h5>
          <div class="card-body">
            <form action="./usuario/salvar.php" method="post">
              <div class="form-group">
                <label for="InputEmail1">E-mail</label>
                <input type="email" name="login" class="form-control" id="InputEmail1" required placeholder="example@email.com">
              </div>
              <div class="form-group">
                <label for="InputPassword1">Senha</label>
                <input type="password" name="senha" class="form-control" id="InputPassword1" required>
              </div>
              <div class="form-group">
                <label for="InputPassword2">Confirme sua senha</label>
                <input type="password" name="dsenha" class="form-control" id="InputPassword2" required>
              </div>
              <button type="submit" class="btn btn-primary bg-info">Cadastrar</button>
            </form>
          </div>
        </div>
      ';
      } else { //Caso inesperado, destroi sessão
        echo '<script>
              window.location.replace("./logoff.php");
            </script>';
      }

      if (isset($_GET["login"])) {
        $_SESSION["select"] = 1;
        echo '<script>
              window.location.replace("./login.php");
            </script>';
      } else if (isset($_GET["cadastro"])) {
        $_SESSION["select"] = 2;
        echo '<script>
              window.location.replace("./login.php");
            </script>';
      }
      ?>

    </div>
  </div> <!-- fim container -->

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>