<?php
include('conexao.php');
session_start();
$email = $_SESSION['email'];
if($email != 'admin@gmail.com'){
    header('Location: logout.php');
    exit;
} else {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['desc'];
    $material= $_POST['material'];
    $preco = floatval($_POST['preco']);
    $estoque= intval($_POST['estoque']);
    $promocao = $_POST['promocao'];
    $porcentagem = intval($_POST['porcentagem']);

    $custo = floatval($_POST['custo']);
    $lucro = floatval($_POST['lucro']);
    $icms = floatval($_POST['icms']);
    
    

    if($promocao == 'Sim') {
        $boolPromo = 'true';
    } else {
        $boolPromo = 'false';
    }

    echo $titulo . " - " . $descricao . " - " . $preco . " - " . $estoque . " - " . $promocao . " - " . $porcentagem;




    $sql = "insert into produtosandre (titulo, descricao, material, preco, estoque, promocao, promoporcentagem, margemlucro, imposto, precoinicial )
        values ('$titulo', '$descricao', '$material', $preco, $estoque, '$boolPromo', $porcentagem, $lucro, $icms, $custo)";
    pg_query($conexao, $sql);

    ///////////////////////////// UPLOAD DE IMAGEM /////////////////////////////
    $sqlpegaid = "select id from produtosandre where titulo = '$titulo' and descricao = '$descricao' and material = '$material'";
    $result = pg_query($conexao, $sqlpegaid);
    $row = pg_fetch_array($result);
  $email = str_replace('.', '_', $_SESSION['email']);
  if($email == " ") {
    header('Location: home.php');
    exit;
  }
  $idprod = strval($row['id']);
  $numimagem = strval($_POST['fotonum']);

  $str1 = $target_dir . $idprod .  $numimagem . ".png";
  $str2 = $target_dir . $idprod .  $numimagem . ".jpg";
  $str3 = $target_dir . $idprod .  $numimagem . ".jpeg";

  rename('produtosimagem/'.$str1, 'produtosimagem/lixo/'.$str1);
  rename('produtosimagem/'.$str2, 'produtosimagem/lixo/'.$str2);
  rename('produtosimagem/'.$str3, 'produtosimagem/lixo/'.$str3);



$target_dir = "produtosimagem/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if(unlink($target_dir . $idprod .  $numimagem.".jpg")) {
  echo "Arquivo deletado com sucesso";
} elseif(unlink($target_dir . $idprod .  $numimagem.".png")) {
  echo "Arquivo deletado com sucesso";
} elseif(unlink($target_dir . $idprod .  $numimagem.".jpeg")) {
  echo "Arquivo deletado com sucesso";
}

  $email2 = $_SESSION['email'];
  $sqlnum = "update produtosandre set numberphoto = '$numimagem' where id = '$idprod'";
  pg_query($conexao, $sqlnum);

$filename   = $idprod; // 5dab1961e93a7-1571494241
$extension  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // jpg
$basename   = $filename .  $numimagem. "." . $extension; // 5dab1961e93a7_1571494241.jpg
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
    $_SESSION['nomeerroupload'] = "Arquivo n??o ?? uma imagem";
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
  $uploadOk = 0;
  $_SESSION['nomeerroupload'] = "Arquivo muito grande.";
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
  $_SESSION['nomeerroupload'] = "Arquivo n??o ?? uma imagem.";
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  $_SESSION['erroupload'] = true;

// if everything is ok, try to upload file
} else {
  $_SESSION['erroupload'] = false;
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $destination)) {

    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

header('Location: editarprod.php?id='.$idprod);
exit;
}


?>
