<?php
  session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>PaginaLogin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="csscadastro.css" />
  </head>
  <body>
    <div class="container">
      <div class="center">
        <h2> <?php if($_SESSION['sem_login'] = true;)?>
          Erro: Login ou senha incorretos! <?php endif; ?>
        </h2>
          
          <h1>Login</h1>
          <form action="login.php" method="POST">
              <div class="txt_field">
                  <input type="text" name="email" required>
                  <span></span>
                  <label>E-mail</label>
              </div>
              <div class="txt_field">
                  <input type="password" name="password" required>
                  <span></span>
                  <label>Senha</label>
              </div>
              <div class="pass">Esqueceu senha?</div>
              <input name="submit" type="Submit" value="Login">
              <div class="signup_link">
                  Não possui cadastro? <a href="cadasstro.php">Cadastro</a>
              </div>
              <div class="signup_link">
                  <a href="home.php">Página inicial</a>
              </div>
          </form>
      </div>
    </div>
  </body>
</html>