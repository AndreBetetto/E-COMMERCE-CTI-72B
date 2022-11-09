<?php
/*
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
date_default_timezone_set('Etc/UTC');

//Carrega as bibliotecas de classes
require 'PHPMailer/PHPMailerAutoload.php';

//Cria uma nova instância da classe PHPMailer
$mail = new PHPMailer;

//Diz ao PHPMailer para usar SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.kinghost.net';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = '';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'keyfriends@projetoscti.com.br'; //Preencher com o usuário da sua conta Gmail

//Password to use for SMTP authentication
//$mail->Password = 'YfTvkhprsLC0OJn5'; //Preencher com a senha do usuário da sua conta Gmail
$mail->Password = 'Key@Friends20adm';

//Set who the message is to be sent from
$mail->From='keyfriends@projetoscti.com.br'; //Preencher com a sua conta Gmail

$mail->FromName='KeyFriends'; //Preencher com o nome do remetente

//Set who the message is to be sent to
$mail->addAddress('beatriz.p.soche@unesp.br'); //Preencher com o email e nome de quem receberá a mensagem

//Set the subject line
$mail->Subject = 'KeyFriends agradece sua compra!'; //Preencher com o assunto do email

$mail->isHTML(true); //Configurar mensagem como HTML

$mail->CharSet='UTF-8'; //Configurar conjunto de caracteres da mensagem em HTML

//Replace the plain text body with one created manually
$mail->Body = '<head>
<meta charset="UTF-8">
<!-- <link rel="stylesheet" href="email.css"> -->
<script src="https://kit.fontawesome.com/60a756ccae.js" crossorigin="anonymous"></script>
<style>
    *{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: Helvetica, sans-serif;
}

body{
width: 71rem;
}

#marca{
padding: 1%;
color: #ee9b00;
}

.header{
margin: 1% 0 0 0;
background-color:#ee9b00;
width: 71rem;
}

#imgGrande{
width: 71rem;
height:22rem;
}

.titulo{
text-align: center;
padding: 4%;
color: #ee9b00;
font-size: 2.9rem;
}

.container{
width: 71rem;
}

.txt{
width: 100%;
display: flex;
flex-direction: column;
}

.text{
text-align: center;
font-size: 1.8rem;
padding: 1%;
color: #4b535c;
}

.btnCompre{
display: flex;
justify-content: center;
align-items: center;
width: 100%;
}

#btn{
width: fit-content;
padding: 1.3rem 3rem;
margin: 3%;
background-color: #ee9b00;
color: white;
text-decoration: none;
font-size: 1.4rem;
font-weight: bold;
border-radius: 3px;
}

.link{
margin: 1% 0 0 0;
width: 71rem;
background-color:#ee9b00;
display: flex;
justify-content: center;
align-items: center;
}

#icon{
padding: 4% 0;
color: #ee9b00;
}

.fa-solid{
color:white;
padding: 30%;
background-color: aqua;
border-radius: 100%;
}

footer{
display: flex;
align-items: center;
justify-content: space-evenly;  
}

#txt-footer
{
font-size: 1.2rem;
color: #4b535c;
}

.logoFooter{
height: 15%;
width: 30%;
margin-left: 20rem;
padding: 1rem;
}

</style>
</head>

<body>
<div class="header">
    <p id="marca">KeyFriends</p>
</div>

<img id="imgGrande" src="imagens/img-grande.jpg" alt="capa do email">

<div class="container">
    <h1 class="titulo">Agradecemos por sua compra!</h1>

    <div class="txt">
        <p class="text">Ficamos muito felizes por você ter escolhido a KeyFriends e aquirido</p>
        <p class="text">nossos produtos, esperamos que goste de seu chaveiro e volte sempre</p>
        <p class="text">para realizar novas compras!</p>
    </div>

    <div class="btnCompre">
        <a id="btn" href="http://projetoscti.com.br/projetoscti20/site/produtos.php">Comprar mais</a>
    </div>
</div>

<div class="link">
    <p id="icon">K</p>
    <a href="http://projetoscti.com.br/projetoscti20/site/home.php" target="_blank"> <i class="fa-solid fa-link fa-2x"></i> </a>
</div>

<footer>
    <div id="txt-footer">
        <p>&copy; 2022 KeyFriends - Todos os direitos reseverdos</p>
    </div>

    <img class="logoFooter" src="imagens/logo.svg" alt="logo">
</footer>
</body>'; //Mensagem em HTML

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}