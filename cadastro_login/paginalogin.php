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
          <h1>Login</h1>
          <form action="login.php" method="POST">
              <div class="txt_field">
                  <input type="text" name="email" required>
                  <span></span>
                  <label>Username</label>
              </div>
              <div class="txt_field">
                  <input type="password" name="password" required>
                  <span></span>
                  <label>Senha</label>
              </div>
              <div class="pass">Esqueceu a senha?</div>
              <input name="submit" type="Submit" value="Entrar">
              <div class="signup_link">
                  Não foi cadastrado ? <a href="cadasstro.php">Cadastre-se</a>
              </div>
          </form>
      </div>
    </div>
  </body>
</html>