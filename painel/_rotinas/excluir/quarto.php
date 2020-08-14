<?php
	include_once "../conexao.php";

	$id = $_GET['id'];

	$consulta = getConn()->prepare("SELECT * FROM quartos WHERE id='{$id}'");
	$consulta->execute();

	$excluir = getConn()->prepare("DELETE FROM quartos WHERE id='{$id}'");

	$diretorio = '../../_img/quartos/';

	foreach ($consulta as $dado) {
		unlink($diretorio . $dado['imagemUm']);
		unlink($diretorio . $dado['imagemDois']);
		unlink($diretorio . $dado['imagemTres']);
	}

	if($excluir->execute())
	{
		echo "<script> alert('Quarto excluído com sucesso!'); location='../../listar/quarto.php'; </script>";
	}
		else
		{
			echo "<script> alert('Erro ao excluir quarto! Tente novamente!'); location='../../listar/quarto.php'; </script>";
		}
?>