<?php
session_start();

include_once "./servico/Bd.php";
$bd = new Bd();
?>

<!doctype html>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <link rel="stylesheet" href="./utils/generalStyle.css">

  <title>Fakebook</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="#">
      <img src="./favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <img src="./utils/Fakebook-Logo.png" width="auto" height="20" class="d-inline-block mt-n1" alt="" loading="lazy">
    </a>

    <?php
    if (!isset($_SESSION["autenticado"])) {
      echo '
          <form class="form-inline ml-auto">
              <a class="nav-link btn btn-primary bg-info mx-1" href="./login.php?login=true">Login</a>
              <a class="nav-link btn btn-primary bg-info mx-1" href="./login.php?cadastro=true">Cadastro</a>
          </form>';
    } else {
      echo '
          <div class="btn-group form-inline ml-auto">
            <a class="navbar-brand" href="#" data-toggle="dropdown">
              <img src="./utils/userIcon.png" width="30" height="30" class="d-inline-block align-top" alt="Usuário" loading="lazy">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="./usuario/menuUsuario.php">Configurações de Usuário</a>
              <a class="dropdown-item" href="./posts/gerenciarPosts.php">Gerenciar meus Posts</a>
              <div class="dropdown-divider"></div>
              <div class="mx-auto" style="width: 40%;">
                <a class="btn btn-primary bg-info" href="./logoff.php">Deslogar</a>
              </div>
            </div>
          </div>
        ';
    }
    ?>
  </nav>
  <div class="container-fluid">

    <div class="mx-auto" style="width: 33%;">
      <img src="./utils/Fakebook-Logo.png" width="100%" height="auto" class="my-3" alt="" loading="lazy">
    </div>
    <?php
    $sql = "select blog.corpo, blog.titulo, users.login from `blog`,`users` where blog.user_id = users.ID order by blog.ID desc";
    foreach ($bd->query($sql) as $row) {
      $user = $row['login'];
      $text = $row['corpo'];
      $titulo = $row['titulo'];
      echo '
        <div class="card my-3" style="width: 100%;">
          <div class="py-2 post-color">
            <h5 class="card-title ml-3 text-white" style="display:inline;">' . $user . '</h5>
          </div>
          <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">' . $titulo . '</h6>
            <pre class="card-text ml-3">' . $text . '</pre>
          </div>
        </div>
      ';
    }
    echo '<div class="py-5 my-4"><div class="card post-color pt-3 mx-auto" style="width:33%;"><p class="card-title ml-3 text-white mx-auto">Este é o fim dos posts.</p></div></div>';

    if (isset($_SESSION["autenticado"])) {
      echo '
      <div class = "fixed-bottom bg-light">
      <form action="./posts/salvarPost.php" method="post" class="form-inline mb-4 ml-4">
        <textarea class="form-control mr-4 mt-2" id="Textarea2" name=postTitle rows="1" maxlength="25" style="width: 98%; border-width: 4px; resize:none;" placeholder="Titulo (Opcional)"></textarea>
        <div class="form-group" style="width:90%;">
          <textarea class="form-control mt-2" id="Textarea1" name=postText rows="3" maxlength="140" required style="width: 100%; border-width: 4px; resize:none;"  ></textarea>
        </div>
        <div class="form-group mx-auto" style="width:10%;">
          <button type="submit" class="btn btn-primary mx-auto py-4 px-4 bg-info">Postar</button>
        </div>
      </form>
      </div>

      <button onclick="topFunction()" id="topBtn" class="btnTop" title="Go to top" style="bottom: 200px;">^</button>
      ';
    } else {
      echo '
      <button onclick="topFunction()" id="topBtn" class="btnTop" title="Go to top">^</button>
      ';
    }

    echo'
    <script>
    var mybutton = document.getElementById("topBtn");

    window.onscroll = function() {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }

    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
    ';
    ?>

  </div> <!-- fim container -->

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>