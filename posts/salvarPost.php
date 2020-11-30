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
$id = $_SESSION["autenticado"];

if (isset($_POST["attPost"])) {
    $text = $_POST["postText"];
    $postId = $_POST["attPost"];
    $sql = "update `posts` set content='$text' where id='$postId'";
    $bd->exec($sql);
    echo "  <script>
                window.location.replace('./gerenciarPosts.php#post" . $postId . "');
            </script>
        ";
} else if (isset($_POST["postText"])) {
    $text = $_POST["postText"];
    $sql = "INSERT INTO `posts` (`ID`, `user_id`, `content`) VALUES (NULL, '$id', '$text')";
    $bd->exec($sql);
    echo "   <script>
                window.history.back();
            </script>
    ";
}
