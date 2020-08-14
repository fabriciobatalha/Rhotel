<?php
    require_once '../conexao.php';

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $capacidadeHospedes = $_POST['capacidadeHospedes'];
    $quantidadeCamas = $_POST['quantidadeCamas'];
    $imagemUm = $_FILES['imagem-um'];
    $imagemDois = $_FILES['imagem-dois'];
    $imagemTres = $_FILES['imagem-tres'];
    $idHotel = $_POST['idHotel'];

    if (empty($nome) || empty($preco) || empty($capacidadeHospedes) || empty($quantidadeCamas) || empty($imagemUm) || empty($imagemDois) || empty($imagemTres) || empty($idHotel)) {
        echo "<script> alert('Preencha todos os campos!'); </script>";
    }
        else {
            $imagemUmExt = pathinfo($imagemUm['name'], PATHINFO_EXTENSION);
            $imagemDoisExt = pathinfo($imagemDois['name'], PATHINFO_EXTENSION);
            $imagemTresExt = pathinfo($imagemTres['name'], PATHINFO_EXTENSION);

            $formatosPermitidos = array("png", "PNG", "jpeg", "JPEG", "jpg", "JPG");

            if ((in_array($imagemUmExt, $formatosPermitidos)) && (in_array($imagemDoisExt, $formatosPermitidos)) && (in_array($imagemTresExt, $formatosPermitidos)))
			{
                $imagemUmNovo = md5(uniqid(time())) . "." . $imagemUmExt;
                $imagemDoisNovo = md5(uniqid(time())) . "." . $imagemDoisExt;
                $imagemTresNovo = md5(uniqid(time())) . "." . $imagemTresExt;

                $diretorio = '../../_img/quartos/';

                if ((move_uploaded_file($imagemUm['tmp_name'], $diretorio . $imagemUmNovo)) && (move_uploaded_file($imagemDois['tmp_name'], $diretorio . $imagemDoisNovo)) && (move_uploaded_file($imagemTres['tmp_name'], $diretorio . $imagemTresNovo))) {
                    $cadastrarQuarto = getConn()->prepare("INSERT INTO quartos (nome, preco, capacidadeHospedes, quantidadeCamas, imagemUm, imagemDois, imagemTres, idHotel) VALUES ('$nome', '$preco', '$capacidadeHospedes', '$quantidadeCamas', '$imagemUmNovo', '$imagemDoisNovo', '$imagemTresNovo', '$idHotel')");

                    if ($cadastrarQuarto->execute()) {
                        echo "<script> alert('Quarto cadastrado com sucesso!'); window.location='../../listar/quarto.php'; </script>";
                    }
                        else {
                            echo "<script> alert('Erro ao cadastrar quarto! Tente novamente!'); window.location='../../cadastrar/quarto.php'; </script>";
                            unlink($diretorio . $imagemUmNovo);
                            unlink($diretorio . $imagemDoisNovo);
                            unlink($diretorio . $imagemTresNovo);
                        }
                }
                    else {
                        echo "<script> alert('Erro ao fazer o envio das imagens! Tente novamente!'); window.location='../../cadastrar/quarto.php'; </script>";
                    }
            }
                else {
                    echo "<script> alert('Erro! As imagens não possuem um formato válido. Tente novamente!'); window.location='../../cadastrar/quarto.php'; </script>";
                }
        }
?>