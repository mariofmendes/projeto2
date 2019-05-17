<?php 
//iniciando a sessão
session_start();

//Arquivo onde estão funções de validar, inserir, deletar
include_once '../model/usuario.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//Chamando função que valida o login e verifica se email e senha estão corretos
	$valido = validarLogin($_POST);

	if (is_array($valido)) {
		$_SESSION['idusuario'] = $valido['idusuario'];
		$_SESSION['nome'] = $valido['nome_usuario'];
		$_SESSION['email'] = $valido['email'];
		$_SESSION['nivel'] = $valido['nivel_usuario'];
		$_SESSION['operacao'] = $valido['operacao'];
		header('Location: ../painel.php');
		exit();
	} else {
		header('Location: ../index.php?erro=' . $valido);
	}
} else {
	header('Location: ../index.php');
	exit();
}
?>