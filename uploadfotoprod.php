<?php
  session_start();
  include('conexao.php');
  $email = str_replace('.', '_', $_SESSION['email']);
  if($email == " ") {
    header('Location: home.php');
    exit;
  }
  $idprod = $_SESSION['idtemp'];

  $str1 = $target_dir . $idprod .  $_SESSION['numberprod'] . ".png";
  $str2 = $target_dir . $idprod .  $_SESSION['numberprod'] . ".jpg";
  $str3 = $target_dir . $idprod .  $_SESSION['numberprod'] . ".jpeg";

  rename('produtosimagem/'.$str1, 'produtosimagem/lixo/'.$str1);
  rename('produtosimagem/'.$str2, 'produtosimagem/lixo/'.$str2);
  rename('produtosimagem/'.$str3, 'produtosimagem/lixo/'.$str3);

  

$target_dir = "produtosimagem/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if(unlink($target_dir . $idprod .  $_SESSION['numberprod'].".jpg")) {
  echo "Arquivo deletado com sucesso";
} elseif(unlink($target_dir . $idprod .  $_SESSION['numberprod'].".png")) {
  echo "Arquivo deletado com sucesso";
} elseif(unlink($target_dir . $idprod .  $_SESSION['numberprod'].".jpeg")) {
  echo "Arquivo deletado com sucesso";
}

$number1 = rand(1, 100);
  $number2 = rand(1, 100);
  $number3 = rand(1, 100);

  $numberfim = $number1 . $number2 . $number3;
  $_SESSION['numberprod'] = $numberfim;

  $email2 = $_SESSION['email'];
  $sqlnum = "update produtosandre set numberphoto = '$numberfim' where id = '$idprod'";
  pg_query($conexao, $sqlnum);

$filename   = $idprod; // 5dab1961e93a7-1571494241
$extension  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // jpg
$basename   = $filename .  $numberfim. "." . $extension; // 5dab1961e93a7_1571494241.jpg
$source       = $_FILES["fileToUpload"]["tmp_name"];
$_SESSION['pathimagem'] = $basename;
$destination  = $target_dir . "{$basename}";

move_uploaded_file( $_FILES["fileToUpload"]["tmp_name"], $destination );

header('Clear-Site-Data: "cache", "cookies", "storage", "executionContexts"');

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($basename)) {
  echo "Sorry, file already exists.";
  $uploadOk = 1;
}

if($email == " ") {
  echo "Voce nao esta logado.";
  $uploadOk = 1;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 1;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $destination)) {
    
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

header('Location: perfil.php');
exit;

?>
