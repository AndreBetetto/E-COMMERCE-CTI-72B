<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="csscadastro.css" />
  </head>
  <body>
    <div class="container">
      <div class="center">
          <h1>Cadastrar</h1>
          <form method="POST" action="cadastrar.php">
              <div class="txt_field">
                  <input type="text" name="name" required>
                  <span></span>
                  <label>Nome</label>
              </div>
              <div class="txt_field">
                  <input type="email" name="email" required>
                  <span></span>
                  <label>Email</label>
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

              <input name="submit" type="Submit" value="Cadastrar">
              <div class="signup_link">
                  Já tem uma conta ? <a href="paginalogin.php">Login aqui</a>
              </div>
          </form>
      </div>
  </div>
  </body>
</html>