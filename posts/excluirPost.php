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
  $bd = new Bd();
  
  $postID = $_POST["excPost"];
  $sql = "delete from `posts` where ID = '$postID'";
  $bd->exec($sql);
  echo '
    <script>
        window.location.replace("./gerenciarPosts.php");
    </script>
  ';
