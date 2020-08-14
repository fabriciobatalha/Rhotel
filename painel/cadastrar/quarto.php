<?php
    include_once "../_rotinas/conexao.php";

    $consulta = getConn()->prepare("SELECT id, nome FROM hoteis");
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
                    <h1 class="text-center display-4 mb-5"> Cadastrar Quarto </h1>

                    <div class="text-center text-md-left mb-5">
                        <a class="btn btn-outline-primary" href="../cadastrar.php"> Voltar ao Cadastrar </a>
                    </div>
                    
                    <div class="row pt-5">
                        <div class="col"></div>

                        <div class="col-12 col-md-6">
                            <form action="../_rotinas/cadastrar/quarto.php" method="post" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Hotel </span>
                                    </div>

                                    <select id="idHotel" name="idHotel" class="custom-select" required>
                                        <?php
                                            if ($contarConsulta > 0) {
                                        ?>
                                                <option selected disabled></option>
                                        <?php
                                                foreach ($consulta as $dado) {
                                        ?>
                                                    <option value="<?php echo $dado['id']; ?>"> <?php echo $dado['nome']; ?> </option>
                                        <?php
                                                }
                                            }
                                                else {
                                        ?>
                                                    <option selected disabled></option>
                                        <?php
                                                }
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Nome </span>
                                    </div>

                                    <input type="text" class="form-control" id="nome" name="nome" maxlength="30" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Preço </span>
                                    </div>

                                    <input type="number" class="form-control" id="preco" name="preco" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Capacidade de Hóspedes </span>
                                    </div>

                                    <input type="number" class="form-control" id="capacidadeHospedes" name="capacidadeHospedes" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Quantidade de Camas </span>
                                    </div>

                                    <input type="number" class="form-control" id="quantidadeCamas" name="quantidadeCamas" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Imagem 1 </span>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagem-um" name="imagem-um" accept="image/png, image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="imagem-um"> Selecionar arquivo </label>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Imagem 2 </span>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagem-dois" name="imagem-dois" accept="image/png, image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="imagem-dois"> Selecionar arquivo </label>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Imagem 3 </span>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagem-tres" name="imagem-tres" accept="image/png, image/jpg, image/jpeg" required>
                                        <label class="custom-file-label" for="imagem-tres"> Selecionar arquivo </label>
                                    </div>
                                </div>
                                
                                <button class="btn btn-outline-success w-100" type="submit"> Cadastrar </button>
                            </form>
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