<?php
  session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title> LOGIN |  KeyFriends</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="csscadastro.css" />
    <link rel="icon" href="logoAzul.png">
  </head>
  <body>
	      
    <div class="container">
      <div class="center">
      <?php 
	      if($_SESSION['erro_login'] == true): 
	    ?> 
	
      <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	      Erro: login ou senha incorretos!
      </div>
	    
      <?php 
		    endif; 
		    unset($_SESSION['erro_login']);
	    ?>
      
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