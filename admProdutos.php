<?php
    session_start();
    include('conexao.php');
    $email = $_SESSION['email'];
    if($email != 'admin@gmail.com')
    {
        header('Location: home.php');
        $_SESSION['naoAutorizado'] = true;
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include "head.php" ?>
    <link rel=stylesheet type="text/css" href="adm.css">
    <title>Área do administrador | KeyFriends</title>
</head>
<body>
            <!--Navigation bar-->
            <div id="nav-placeholder">
            </div>
            <script>
                $(function(){
                $("#nav-placeholder").load("nav.php");
                });
            </script>
            <script src="menu.js"></script>
            <!--end of Navigation bar-->
    <div class="busca"> 
        <div class="titleDB"> <p>Seja bem vindo(a), administrador.<p> </div>
        <div class="userDB">
<!-- ----------------------------------------------- PRODUTOS ------------------------------------>

    <form action="" method="GET" class="form">
        <div class="titleDB"> <p>Tabela de produtos:<p> </div>
        <p id="titulo">Busque por um produto: 
            <input id="inputs" type="text" name="termoProd" required 
                value="<?php 
                    if(isset($_GET['termoProd']))
                    {echo $_GET['termoProd'];}?>"> 

                <button id="btnB" name="submit" type="Submit"> 
                    <i id="bot" class="fa-solid fa-magnifying-glass fa-2x"></i> 
                </button>   

                <button id="btnL" onclick="location.href='admProdutos.php'" type="button"> 
                    <i id="bot" class="fa fa-duotone fa-circle-xmark fa-2x"></i> 
                </button>
        </p>
    </form>

        <table border="2" class="table">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Material</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Editar </th>  
            <th>Excluir </th>        
        </tr>
    <?php
            if(isset($_GET['termoProd'])) {
                $buscaProd = strtoupper($_GET["termoProd"]);
                $sqlProd = "select * from produtosandre where CONCAT(id, upper(titulo), upper(material), preco) LIKE '%$buscaProd%' order by id ";
                $sqlProdID = "select id from produtosandre where CONCAT(id, upper(titulo), upper(material), preco) LIKE '%$buscaProd%' order by id";
                $queryProd = pg_query($conexao, $sqlProd);

                if(pg_num_rows($queryProd) > 0){
                   //for($i = 1000; $i <= pg_num_rows($queryProd)+999; $i++):
                    for($i = 0; $i < pg_num_rows($queryProd); $i++):
                        $sqlsaida = pg_fetch_array(pg_query($conexao, $sqlProd), $i);

                        echo "<tr>
                            <td>" . $sqlsaida['id']. "</td>
                            <td>" .$sqlsaida['titulo']. "</td>
                            <td>" .$sqlsaida['material']. "</td>
                            <td>" . number_format($sqlsaida['preco'], 2). "</td>
                            <td>" . $sqlsaida['estoque']. "</td>

                            <td> <form action='editarprod.php' method='post'> 
                                    <button input type='submit' name='submit' 
                                        id='".$sqlsaida['id']."-submit' 
                                        value ='".$sqlsaida['id']."<i class='fa-solid fa-pen-to-square'></i>
                                    </button>
                                </form>
                            </td>

                            <td> <form action='excluirprod.php' method='post'>
                                    <button input type='submit' name='submit'
                                        id='btnEx' id='".$sqlsaida['id']."-submit' 
                                        value =".$sqlsaida['id']."> <i class='fa-solid fa-trash-can fa-1x'> </i> 
                                    </button>
                                </form>
                            </td>
                        </tr>"; 
                    endfor;
                }
                    
                if(pg_num_rows($queryProd) <= 0)  {
                    echo "<tr><td colspan=4>" . "No Record Found" . "</td> </tr>";
                }
            } else {

		    $contProd = "SELECT COUNT(*) as total FROM produtosandre";
                $rowProd = pg_fetch_row(pg_query($conexao, $contProd));
                //for($i = 1001; $i <= $rowProd[0]+1000; $i++):
                for($i = 0; $i < $rowProd[0]; $i++):
                    $mostraresult = pg_fetch_array(pg_query($conexao, "select * from produtosandre order by id"), $i);

                    if($mostraresult['estoque'] == null) {
                        $mostraresult['estoque'] = 0;
                    }
                    echo "<tr>
                        <td>" . $mostraresult['id']."</td>
                        <td>" . $mostraresult['titulo']."</td>
                        <td>" . $mostraresult['material']."</td>
                        <td>" . number_format($mostraresult['preco'], 2)."</td>
                        <td>" . $mostraresult['estoque'] ?> </td>
                        <td> 
                           <a href=editarprod.php?id=<?php echo $mostraresult['id']; ?>><i id="bot" class="fa-solid fa-pen-to-square"></i></a> 
                        </td>

                        <td> <form action="excluirprod.php" method="post">
                                <input type="hidden" value="<?php echo $mostraresult['id']; ?>" name="id">
                                <button id="btnEx" id="<?php echo $mostraresult['id'];?>-submit" 
                                    value ="<?php echo $mostraresult['id'];?>"> 
                                    <i id="bot" class="fa-solid fa-trash-can fa-1x"> </i> 
                                </button>
                            </form>
                        </td>
                    </tr>

                    <?php endfor; ?> <?php
                } 
            
            echo "</table>";
            ?>
    </table>

    <div>
        <a href="adicionarProd.php" id="btnAdd"> 
            <button class="novo" type="submit">Novo produto
                <i id="bot" class="fa-solid fa-circle-plus"></i> 
            </button>
            
        </a>
    </div> 
<br><br>
    <a href="https://projetoscti.com.br/projetoscti20/site/addcompra.php">Adicionar compra! </a>
    
    <footer>

    </footer>
</body>
</html>
    