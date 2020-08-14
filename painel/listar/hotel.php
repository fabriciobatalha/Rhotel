<?php
    include_once "../_rotinas/conexao.php";

    $consulta = getConn()->prepare("SELECT * FROM hoteis");
    $consulta->execute();
    $contarConsulta = $consulta->rowCount();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Página Inicial - SGEV </title>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="../_css/bootstrap.min.css">
        <link rel="stylesheet" href="../_css/master.css">
    </head>

    <body class="bg-light">
        <header>
            <nav class="navbar navbar-dark bg-dark shadow p-3 mb-5 bg-dark">
                <div class="container">
                    <p class="m-auto text-white"> Painel de Controle </p>
                </div>
            </nav>
        </header>

        <main>
            <section class="py-5">
                <div class="container">
                    <h1 class="text-center display-4 mb-5"> Listar Hotéis </h1>

                    <div class="text-center text-md-left mb-5">
                        <a class="btn btn-outline-primary" href="../listar.php"> Voltar ao Listar </a>
                    </div>
                    
                    <div class="row pt-5">
                        <div class="col"></div>

                        <div id="listagem-veiculos" class="col-8">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"> Nome </th>
                                        <th scope="col"> Localização </th>
                                        <th scope="col"> Excluir </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        if ($contarConsulta > 0) { 
                                            foreach ($consulta as $dado) { 
                                    ?>

                                    <tr>
                                        <td> <?php echo $dado['nome']; ?> </td>
                                        <td> <?php echo $dado['localizacao']; ?> </td>
                                        <td> <a href="../_rotinas/excluir/hotel.php?id=<?php echo $dado['id']; ?>"> <img src="../_img/icones/excluir.png" alt="Excluir Hotel"> </a> </td>
                                    </tr>

                                    <?php 
                                            }
                                        }
                                            else {
                                                echo "<td colspan='4' class='text-center'> Nenhum hotel cadastrado! </td>";
                                            }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col"></div>
                    </div>
                </div>
            </section>
        </main>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
        <script src="../_js/jquery.min.js"></script>
        <script src="../_js/popper.min.js"></script>
        <script src="../_js/bootstrap.min.js"></script>
    </body>
</html>