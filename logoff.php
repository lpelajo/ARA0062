<?php
session_start();
if (! isset($_SESSION["autenticado"])) {
    echo "
    <script>
    window.location.replace('../sessaoExpirada.html');
    </script>
    ";
}
    unset($_SESSION["autenticado"]);
    echo '<script>
            window.location.replace("./index.php");
          </script>';
?>