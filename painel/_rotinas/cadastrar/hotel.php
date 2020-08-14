<?php
    require_once '../conexao.php';

    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    $sobre = $_POST['sobre'];
    $imagemUm = $_FILES['imagem-um'];
    $imagemDois = $_FILES['imagem-dois'];
    $imagemTres = $_FILES['imagem-tres'];
    $comodidades = implode(",", $_POST['comodidades']);

    if (empty($nome) || empty($localizacao) || empty($sobre) || empty($imagemUm) || empty($imagemDois) || empty($imagemTres)) {
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

                $diretorio = '../../_img/hoteis/';

                if ((move_uploaded_file($imagemUm['tmp_name'], $diretorio . $imagemUmNovo)) && (move_uploaded_file($imagemDois['tmp_name'], $diretorio . $imagemDoisNovo)) && (move_uploaded_file($imagemTres['tmp_name'], $diretorio . $imagemTresNovo))) {
                    $cadastrarHotel = getConn()->prepare("INSERT INTO hoteis (nome, localizacao, sobre, imagemUm, imagemDois, imagemTres, comodidades) VALUES ('$nome', '$localizacao', '$sobre', '$imagemUmNovo', '$imagemDoisNovo', '$imagemTresNovo', '$comodidades')");
                    
                    if ($cadastrarHotel->execute()) {
                        echo "<script> alert('Hotel cadastrado com sucesso!'); window.location='../../listar/hotel.php'; </script>";
                    }
                        else {
                            echo "<script> alert('Erro ao cadastrar hotel! Tente novamente!'); window.location='../../cadastrar/hotel.php'; </script>";
                            unlink($diretorio . $imagemUmNovo);
                            unlink($diretorio . $imagemDoisNovo);
                            unlink($diretorio . $imagemTresNovo);
                        }
                }
                    else {
                        echo "<script> alert('Erro ao fazer o envio das imagens! Tente novamente!'); window.location='../../cadastrar/hotel.php'; </script>";
                    }
            }
                else {
                    echo "<script> alert('Erro! As imagens não possuem um formato válido. Tente novamente!'); </script>";
                }
        }
?>