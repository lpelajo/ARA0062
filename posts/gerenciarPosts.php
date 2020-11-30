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

if (isset($_GET["cancel"])) {
    echo '
        <script>
            window.location.replace("./gerenciarPosts.php#post' . $_GET["cancel"] . '");
        </script>
    ';
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

    <link rel="stylesheet" href="../utils/generalStyle.css">

    <title>Meus Posts</title>
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
                <a class="dropdown-item" href="../usuario/menuUsuario.php">Configurações de Usuário</a>
                <a class="dropdown-item active" href="./gerenciarPosts.php">Gerenciar meus Posts</a>
                <div class="dropdown-divider"></div>
                <div class="mx-auto" style="width: 40%;">
                    <a class="btn btn-primary bg-info" href="../logoff.php">Deslogar</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <h1 class="fake-color fake-title d-inline-block mt-4 ml-4" style="z-index: 10;">Meus Posts</h1>
        <?php
        $sql = "select blog.ID, blog.corpo, blog.titulo, users.login from `blog`,`users` where blog.user_id = users.ID and users.ID = " . $id . " order by blog.ID desc";
        foreach ($bd->query($sql) as $row) {
            $user = $row['login'];
            $text = $row['corpo'];
            $titulo = $row['titulo'];
            $postID = $row['ID'];
            echo '
                <div class="card my-3" id="post' . $postID . '" style="width: 100%;">
                    <div class="py-2 post-color">
                        <h5 class="card-title ml-3 text-white" style="display:inline;">' . $user . '</h5>
                        <div class="dropdown ml-auto mr-3" style="display:inline; float:right;">
                            <button class="btn dropdown-toggle text-white my-n1 post-color" flip="true" style= "border-width:0px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu dropdown-menu-right post-dropdown" aria-labelledby="dropdownMenuButton">
            ';
            if (isset($_POST['selPost']) && $postID == $_POST['selPost']) {
                echo '
                                <a href="./gerenciarPosts.php?cancel=' . $postID . '" class="dropdown-item">Cancelar Edição</a>
                                <form action="./excluirPost.php" method="post" onsubmit="return confirm(\'Tem certeza que deseja excluir o Post?\');">
                                    <input hidden name="excPost" value=' . $postID . ' class="form-control">
                                    <button type="submit" class="dropdown-item btn btn-primary">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding:0.5rem;">
                        <form action="./salvarPost.php" method="post" class="form-inline">
                            <input type="hidden" name="attPost" value=' . $postID . ' class="form-control">
                            <textarea class="form-control mb-2" id="Textarea2" name=postTitle rows="1" maxlength="25" style="width: 100%; border-width: 4px; resize:none;"  >' . $titulo . '</textarea>
                            <div class="form-group" style="width:90%;">
                                <textarea class="form-control mr-2" id="Textarea1" name=postText rows="3" maxlength="140" required style="width: 100%; border-width: 4px; resize:none;"  >' . $text . '</textarea>
                            </div>
                            <div class="form-group mx-auto" style="width:10%;">
                                <button type="submit" class="btn btn-primary mx-auto py-3 px-3 bg-info">Confirmar <br> Edição</button>
                            </div>
                        </form>
                    </div>
                </div>
                ';
            } else {
                echo '  
                                <form action="./gerenciarPosts.php#post' . $postID . '" method="post">
                                    <input hidden name="selPost" value=' . $postID . ' class="form-control">
                                    <button type="submit" class="dropdown-item btn btn-primary">Editar</button>
                                </form>
                                <form action="./excluirPost.php" method="post" onsubmit="return confirm(\'Tem certeza que deseja excluir o Post?\');">
                                    <input hidden name="excPost" value=' . $postID . ' class="form-control">
                                    <button type="submit" class="dropdown-item btn btn-primary">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">' . $titulo . '</h6>
                        <pre class="card-text ml-3">' . $text . '</pre>
                    </div>
                </div>
                ';
            }
        }
        ?>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>