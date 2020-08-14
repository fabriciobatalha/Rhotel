<?php
    include_once "_rotinas/conexao.php";

    $consultaHotel = getConn()->prepare("SELECT * FROM hoteis");
    $consultaHotel->execute();
    $contarConsultaHotel = $consultaHotel->rowCount();
?>

<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Rhotel </title>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="_css/bootstrap.min.css">
        <link rel="stylesheet" href="_css/master.css">
        <link href="https://fonts.googleapis.com/css2?family=Khand:wght@300&family=Sniglet&family=Quicksand:wght@400&display=swap" rel="stylesheet">
    </head>

    <body>
        <header>
            <nav class="navbar fixed-top navbar-light bg-dark">
                <a class="navbar-brand mx-auto py-3" href="index.php">
                    <img class="rounded" src="_img/logo-rhotel.png" width="150" height="70" alt="Logo Rhotel" loading="lazy">
                </a>
            </nav>
        </header>

        <main>
            <section id="hotel" class="py-5">
                <div class="container">
                    <h1 class="text-center text-primary pb-5"> Nossos Hotéis </h1>

                    <div class="row">
                        <?php 
                            if ($contarConsultaHotel > 0) {
                                foreach ($consultaHotel as $dadoHotel) {
                        ?>
                        <!-- Coluna de hotel -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow">
                                <div id="hotel<?php echo $dadoHotel['id']?>" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#hotel<?php echo $dadoHotel['id']?>" data-slide-to="0" class="active"></li>
                                        <li data-target="#hotel<?php echo $dadoHotel['id']?>" data-slide-to="1"></li>
                                        <li data-target="#hotel<?php echo $dadoHotel['id']?>" data-slide-to="2"></li>
                                    </ol>

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="painel/_img/hoteis/<?php echo $dadoHotel['imagemUm']; ?>" class="d-block w-100" alt="Imagem do hotel">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="painel/_img/hoteis/<?php echo $dadoHotel['imagemDois']; ?>" class="d-block w-100" alt="Imagem do hotel">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="painel/_img/hoteis/<?php echo $dadoHotel['imagemTres']; ?>" class="d-block w-100" alt="Imagem do hotel">
                                        </div>
                                    </div>

                                    <a class="carousel-control-prev" href="#hotel<?php echo $dadoHotel['id']?>" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only"> Anterior </span>
                                    </a>

                                    <a class="carousel-control-next" href="#hotel<?php echo $dadoHotel['id']?>" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only"> Próximo </span>
                                    </a>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title text-center mb-2"> <?php echo $dadoHotel['nome']; ?> </h5>

                                    <div class="card-localizacao text-center">
                                        <img src="_img/localizacao.png" alt="Ícone de localização">
                                        <p class="text-primary mb-2"> <?php echo $dadoHotel['localizacao']; ?> </p>
                                    </div>

                                    <p class="card-sobre mb-3"> <?php echo $dadoHotel['sobre']; ?> </p>
                                    
                                    <div class="card-comodidade text-center">
                                        <?php
                                            $comodid = explode(",", $dadoHotel['comodidades']);

                                            foreach ($comodid as $comodidSeparado) {
                                        ?>
                                                <p class="badge badge-primary text-wrap p-2 mb-2"> <?php echo $comodidSeparado; ?> </p>
                                        <?php
                                            }
                                        ?>
                                    </div>

                                    <div class="text-center py-3">
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalQuartos<?php echo $dadoHotel['id']; ?>"> + Ver Quartos </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Coluna de hotel -->

                        <!-- Modal dos quartos -->
                        <div class="modal fade" id="modalQuartos<?php echo $dadoHotel['id']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel"> Quartos </h5>
                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <?php
                                                $idHotel = $dadoHotel['id'];

                                                $consultaQuarto = getConn()->prepare("SELECT * FROM quartos WHERE idHotel='$idHotel'");
                                                $consultaQuarto->execute();
                                                $contarConsultaQuarto = $consultaQuarto->rowCount();

                                                if ($contarConsultaQuarto > 0) {
                                                    foreach ($consultaQuarto as $dadoQuarto) {
                                            ?>
                                            <div class="col-12 col-md-4 mb-4">
                                                <div class="card shadow">
                                                    <div id="quarto<?php echo $dadoQuarto['id'] ?>" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">
                                                            <li data-target="#quarto<?php echo $dadoQuarto['id'] ?>" data-slide-to="0" class="active"></li>
                                                            <li data-target="#quarto<?php echo $dadoQuarto['id'] ?>" data-slide-to="1"></li>
                                                            <li data-target="#quarto<?php echo $dadoQuarto['id'] ?>" data-slide-to="2"></li>
                                                        </ol>
                    
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <img src="painel/_img/quartos/<?php echo $dadoQuarto['imagemUm']; ?>" class="d-block w-100" alt="Imagem do quarto">
                                                            </div>
                    
                                                            <div class="carousel-item">
                                                                <img src="painel/_img/quartos/<?php echo $dadoQuarto['imagemDois']; ?>" class="d-block w-100" alt="Imagem do quarto">
                                                            </div>
                    
                                                            <div class="carousel-item">
                                                                <img src="painel/_img/quartos/<?php echo $dadoQuarto['imagemTres']; ?>" class="d-block w-100" alt="Imagem do quarto">
                                                            </div>
                                                        </div>
                    
                                                        <a class="carousel-control-prev" href="#quarto<?php echo $dadoQuarto['id'] ?>" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only"> Anterior </span>
                                                        </a>
                    
                                                        <a class="carousel-control-next" href="#quarto<?php echo $dadoQuarto['id'] ?>" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only"> Próximo </span>
                                                        </a>
                                                    </div>
                    
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center mb-2"> <?php echo $dadoQuarto['nome']; ?> </h5>
                    
                                                        <div class="row text-center card-detalhes">
                                                            <div class="col">
                                                                <p class="mb-0"> <?php echo $dadoQuarto['capacidadeHospedes']; ?> </p>
                                                                <p class="text-primary mb-2"> Hóspedes </p>
                                                            </div>

                                                            <div class="col">
                                                                <p class="mb-0"> <?php echo $dadoQuarto['quantidadeCamas']; ?> </p>
                                                                <p class="text-primary mb-2"> Camas </p>
                                                            </div>

                                                            <div class="col">
                                                                <p class="mb-0"> R$<?php echo $dadoQuarto['preco']; ?> </p>
                                                                <p class="text-primary mb-2"> Diária </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                                    else {
                                            ?>
                                                        <div class="col-12">
                                                            <div class="alert alert-warning text-center" role="alert"> Este hotel não possui quartos cadastrados! </div>
                                                        </div>
                                            <?php
                                                    }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fechar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal dos quartos -->

                        <?php
                                }
                            }
                                else {
                        ?>
                                    <div class="col"></div>

                                    <div class="col-12 col-md-6 text-center">
                                        <div class='alert alert-warning' role='alert'> Não há hotéis cadastrados! </div>
                                        <img class="container-fluid" src="_img/nenhum-hotel.png" alt="Ilustração para nenhum hotel encontrado">
                                    </div>
                                        
                                    <div class="col"></div>
                        <?php
                                }
                        ?>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <section class="py-5 bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <p class="text-white mb-2"> Um produto </p>
                            <a href="http://rbarcos.com.br" target="_blank"> <img class="mb-5" src="_img/logo-rbarcos.png" alt="Logo RBarcos"> </a>
                            <div class="text-center">
                                <a class="btn btn-outline-primary mb-5" href="painel/index.php"> Painel de Controle </a>
                            </div>
                            <p class="text-white mb-0"> @ 2020 Rhotel </p>
                        </div>
                    </div>
                </div>
            </section>
        </footer>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
        <script src="_js/jquery.min.js"></script>
        <script src="_js/popper.min.js"></script>
        <script src="_js/bootstrap.min.js"></script>
    </body>
</html>