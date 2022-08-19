<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Cadastro</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="csscadastro.css" />
  </head>
  <body>
    <div class="container">
      <div class="center">
          <h1>Registro</h1>
          <form method="POST" action="cadastrar.php">
              <div class="txt_field">
                  <input type="text" name="name" required>
                  <span></span>
                  <label>Nome</label>
              </div>
              <div class="txt_field">
                  <input type="email" name="email" required>
                  <span></span>
                  <label>E-mail</label>
              </div>
              <div class="txt_field">
                  <input type="password" name="password" required>
                  <span></span>
                  <label>Senha</label>
              </div>

              <!--<div class="txt_field">
                  <input type="password" name="cpassword" required>
                  <span></span>
                  <label>Confirm Password</label>
              </div>-->

              <input name="submit" type="Submit" value="Sign Up">
              <div class="signup_link">
                  Possui uma conta? <a href="paginalogin.php">Faça login!</a>
              </div>
              <div class="signup_link">
                  <a href="home.php">Página inicial</a>
              </div>
          </form>
      </div>
  </div>
  </body>
</html>