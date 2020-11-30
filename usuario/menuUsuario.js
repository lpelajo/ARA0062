function Alterar() {
    html = `<div class="card mx-auto bg-light" style="width: 25rem;">
    <div class="card-body">
    <h5 class="card-title">`+ title + `</h5> ` + msgToUser + `
    <form action="AtualizarUsuario.php" method="post">
            ` + type + `            
        <div class="row">
            <button type="submit" class="btn btn-primary bg-info mr-auto ml-3">Alterar</button>
            <button id="cancela" class="btn btn-primary bg-info ml-auto mr-3">Cancelar</button>
        </div>
    </form>
  </div>
</div>`;
    $("#apendice").html(html);

    $("#cancela").click(function (e) {
        e.preventDefault();
        html = "";
        $("#apendice").html(html);
    })
}

function alteraEmail() {
    console.ou
    title = "Alterar E-mail";
    type = `
    <div class="form-group">
        <label for="InputEmail1">E-mail Atual</label>
        <input type="email" name="vlogin" class="form-control" id="InputEmail1" required>
    </div>
    <div class="form-group">
        <label for="InputEmail2">Novo E-mail</label>
        <input type="email" name="login" class="form-control" id="InputEmail2" required>
    </div>
    <div class="form-group">
        <label for="InputPassword1">Senha</label>
        <input type="password" name="senha" class="form-control" id="InputPassword1" required>
    </div>`;
    Alterar();
}

function alteraSenha() {
    title = "Alterar Senha";
    type = `
    <div class="form-group">
        <label for="InputEmail1">E-mail</label>
        <input type="email" name="login" value= ` + clogin + ` class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="InputPassword1">Senha Atual</label>
        <input type="password" name="vsenha" class="form-control" id="InputPassword1" required>
    </div>
    <div class="form-group">
        <label for="InputPassword2">Nova Senha</label>
        <input type="password" name="senha" class="form-control" id="InputPassword2" required>
    </div>
    <div class="form-group">
        <label for="InputPassword3">Confirme a Nova Senha</label>
        <input type="password" name="ndsenha" class="form-control" id="InputPassword3" required>
    </div>`;
    Alterar();
}

function delUsuario () {
    html = `
    <div class="card mx-auto bg-light" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title"> Deletar Usuário </h5> ` + msgToUser + `
            <form action="ExcluirUsuario.php" method="post">
                <div class="form-group">
                    <label for="InputEmail1">E-mail</label>
                    <input type="email" name="login" class="form-control" id="InputEmail1" required>
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Senha</label>
                    <input type="password" name="senha" class="form-control" id="InputPassword1" required>
                </div>
                <p>Tem certeza que deseja excluir sua conta?</p>
                <div class="row">
                        <button type="submit" class="btn btn-primary bg-info mr-auto ml-3">Sim</button>
                        <button id="btnNao" class="btn btn-primary bg-info ml-auto mr-3">Não</button>
                </div>
            </form>
        </div>
    </div>`;
    $("#apendice").html(html);

    $("#btnNao").click(function (e) {
        e.preventDefault();
        html = "";
        $("#apendice").html(html);
    })
}

function errorCheck () {
    if (erro == 1) {
        msgToUser = `<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger" role="alert">
        O e-mail e/ou senha são inválidos.
          </div></div>`;
        alteraEmail ();
    } else if (erro == 2) {
        msgToUser = `<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger" role="alert">
        O endereço de e-mail utilizado já está em uso.
          </div></div>`;
        alteraEmail ();
    } else if (erro == 3) {
        msgToUser = `<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger" role="alert">
        Ambas as senhas devem ser iguais.
          </div></div>`;
        alteraSenha ();
    } else if (erro == 4) {
        msgToUser = `<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger" role="alert">
        Senha inválida.
          </div></div>`;
        alteraSenha ();
    } else if (erro == 11) {
        msgToUser = `<div id=errorMessage><div class="alert animate__animated animate__fadeIn alert-danger" role="alert">
        O e-mail e/ou senha são inválidos.
          </div></div>`;
        delUsuario ();
    } else {
        msgToUser = '';
    }
    erro = 0;
}

function successCheck () {
    if (sucesso == 'email') {
        msgToUser = `<div id=successMessage><div class="alert animate__animated animate__fadeIn alert-success" role="alert">
        E-mail alterado com sucesso!
          </div></div>`;
        alteraEmail ();
    } else if (sucesso == 'senha') {
        msgToUser = `<div id=successMessage><div class="alert animate__animated animate__fadeIn alert-success" role="alert">
        Senha alterada com sucesso!
          </div></div>`;
          alteraSenha ();
    } else {
        msgToUser = '';
    }
    sucesso = 0;
}

function limpaMsgs () {
    erro = 0;
    sucesso = 0;
    errorCheck ();
    successCheck ();
}

$("#alterMail").click(function () {
    limpaMsgs ();
    alteraEmail ();
});

$("#alterSenha").click(function () {
    limpaMsgs ();
    alteraSenha ();
})

$("#delUser").click(function () {
    limpaMsgs ();
    delUsuario ();
})