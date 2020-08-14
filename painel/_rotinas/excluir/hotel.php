<?php
	include_once "../conexao.php";

	$id = $_GET['id'];

	$consultaHotel = getConn()->prepare("SELECT * FROM hoteis WHERE id='{$id}'");
	$consultaHotel->execute();

	$consultaQuarto = getConn()->prepare("SELECT * FROM quartos WHERE idHotel='{$id}'");
	$consultaQuarto->execute();

    $excluirHotel = getConn()->prepare("DELETE FROM hoteis WHERE id='{$id}'");
	$excluirQuarto = getConn()->prepare("DELETE FROM quartos WHERE idHotel='{$id}'");

	$diretorioHotel = '../../_img/hoteis/';
	$diretorioQuarto = '../../_img/quartos/';

	foreach ($consultaHotel as $dadoHotel) {
		unlink($diretorioHotel . $dadoHotel['imagemUm']);
		unlink($diretorioHotel . $dadoHotel['imagemDois']);
		unlink($diretorioHotel . $dadoHotel['imagemTres']);
	}

	foreach ($consultaQuarto as $dadoQuarto) {
		unlink($diretorioQuarto . $dadoQuarto['imagemUm']);
		unlink($diretorioQuarto . $dadoQuarto['imagemDois']);
		unlink($diretorioQuarto . $dadoQuarto['imagemTres']);
	}

	if ($excluirHotel->execute() && $excluirQuarto->execute())
	{
		echo "<script> alert('Hotel excluído com sucesso!'); location='../../listar/hotel.php'; </script>";		
	}
		else
		{
			echo "<script> alert('Erro ao excluir hotel! Tente novamente!'); location='../../listar/hotel.php'; </script>";
		}
?>