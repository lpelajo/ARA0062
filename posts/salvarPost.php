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
    $title = $_POST["postTitle"];
    $sql = "update `blog` set corpo='$text', titulo='$title' where id='$postId'";
    $bd->exec($sql);
    echo "  <script>
                window.location.replace('./gerenciarPosts.php#post" . $postId . "');
            </script>
        ";
} else if (isset($_POST["postText"])) {
    if (isset($_POST["postTitle"])){
        $title = $_POST["postTitle"];
    } else {$title = '';}
    $text = $_POST["postText"];
    $sql = "INSERT INTO `blog` (`ID`, `user_id`, `corpo`, `titulo`) VALUES (NULL, '$id', '$text', '$title')";
    $bd->exec($sql);
    echo "   <script>
                window.location.replace('../index.php');
            </script>
    ";
}
