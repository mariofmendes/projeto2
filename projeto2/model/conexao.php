<?php 
//Criando a conexão com o Banco de Dados

$conexao = mysqli_connect('localhost', 'root', '', 'patrimonio2') or die ('Erro ao tentar conectar');
mysqli_set_charset($conexao, 'utf-8');

?>