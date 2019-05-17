<?php 

//Função que valida login
function validarLogin($usuario) {
	$email = isset($usuario['email']) && trim($usuario['email']) ? trim($usuario['email']) : null;
	$senha = isset($usuario['senha']) && trim($usuario['senha']) ? trim($usuario['senha']) : null;

	if ($email && $senha) {
		//Conexão com Banco de Dados
		include_once '../model/conexao.php';

		//A função mysqli_real_escape_string, protege contra ataques de SQL Injection
		$email = mysqli_real_escape_string($conexao, $email);
		$senha = mysqli_real_escape_string($conexao, $senha);

		$query = "SELECT * FROM usuario where email = '$email' and senha = md5('$senha')";

		//Executando a query
		$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));

		if (mysqli_num_rows($resultado) == 1) {
			return mysqli_fetch_assoc($resultado);
		} else {
			return 'invalido';
		}
	} else {
		return 'obrigatorio';
	}

}

//Função que valida os campos de cadastro
function validarUsuario($usuario, $idusuario = null) {
	$erros = array();

	//verificando se estar preenchido
	$nome_usuario = isset($usuario['nome_usuario']) && trim($usuario['email_usuario']) ? trim($usuario['email_usuario']) : null;	
	$sobrenome = isset($usuario['sobrenome']) && trim($usuario['sobrenome']) ? trim($usuario['sobrenome']) : null;
	$email = isset($usuario['email']) && trim($usuario['email']) ? trim($usuario['email']) : null;
	$senha = isset($usuario['senha']) && trim($usuario['senha']) ? trim($usuario['senha']) : null;
	$nivel = isset($usuario['nivel_usuario']) && trim($usuario['nivel_usuario']) ? trim($usuario['nivel_usuario']) : null;
	$telefone = isset($usuario['tel_usuario']) && trim($usuario['tel_usuario']) ? trim($usuario['tel_usuario']) : null;
	$celular = isset($usuario['cel_usuario']) && trim($usuario['cel_usuario']) ? trim($usuario['cel_usuario']) : null;
	$cpf = isset($usuario['cpf_usuario']) && trim($usuario['cpf_usuario']) ? trim($usuario['cpf_usuario']) : null;

	//validação
	if (!$nome_usuario) {
		$erros[] = 'nome_usuario';
	}

	if (!$sobrenome) {
		$erros[] = 'sobrenome';
	}

	if (!$email) {
		$erros[] = 'email';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$erros[] = 'emailinvalido';
	}


	if (!$idusuario) {
		if (!$senha) {
			$erros[] = 'senha';
		} elseif (strlen($senha) < 8) {
			$erros[] = 'senhainvalida';
		}
	}
	

	if (!$nivel) {
		$erros[] = 'nivel_usuario';
	} elseif ($nivel < 1 || $nivel > 3) {
	 	$erros[] = 'nivelinvalido'; #validação não esta funcionando
	 }

	 if (!$telefone) {
	 	$erros[] = 'tel_usuario';
	 } elseif ($telefone && strlen($telefone) != 10) {
	 	$erros[] = 'telefoneinvalido';
	 }

	 if (!$celular) {
	 	$erros[] = 'cel_usuario';
	 } elseif ($celular && strlen($celular) != 11) {
	 	$erros[] = 'celularinvalido';
	 }

	 if (!$cpf) {
	 	$erros[] = 'cpf_usuario';
	 } elseif ($cpf && !validaCPF($cpf)){
	 	$erros[] = 'cpfinvalido';
	 } 

	//Retornando array 'erros' e 'usuario'
	 return array(
	 	'erros' => $erros,
	 	'usuario' => array(
	 		'nome_usuario' => $nome_usuario,
	 		'sobrenome' => $sobrenome,
	 		'email' => $email,
	 		'senha' => $senha,
	 		'nivel_usuario' => $nivel,
	 		'tel_usuario' => $telefone,
	 		'cel_usuario' => $celular,
	 		'cpf_usuario' => $cpf,
	 	)
	 );
	}



//função que valida o CPF
	function validaCPF($cpf = null) {

    // Verifica se um número foi informado
		if (empty($cpf)) {
			return false;
		}

    // Elimina possivel mascara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' ||
			$cpf == '11111111111' ||
			$cpf == '22222222222' ||
			$cpf == '33333333333' ||
			$cpf == '44444444444' ||
			$cpf == '55555555555' ||
			$cpf == '66666666666' ||
			$cpf == '77777777777' ||
			$cpf == '88888888888' ||
			$cpf == '99999999999') {
			return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
	} else {

		for ($t = 9; $t < 11; $t++) {

			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}

		return true;
	}
}


function inserirUsuario($usuario) {
	//Conexão com Banco de Dados
	include_once '../model/conexao.php';

	//?Continuar usando o 'mysqli_real_escape_string'?
	$nome_usuario = mysqli_real_escape_string($conexao, $usuario['nome_usuario']);	
	$sobrenome = mysqli_real_escape_string($conexao, $usuario['sobrenome']);
	$email = mysqli_real_escape_string($conexao, $usuario['email']);
	$senha = mysqli_real_escape_string($conexao, $usuario['senha']);
	$nivel = mysqli_real_escape_string($conexao, $usuario['nivel_usuario']);
	$telefone = mysqli_real_escape_string($conexao, $usuario['tel_usuario']);
	$celular = mysqli_real_escape_string($conexao, $usuario['cel_usuario']);
	$cpf = mysqli_real_escape_string($conexao, $usuario['cpf_usuario']);

	//verificando se já tem alguem cadastrado com o mesmo email
	$query = "SELECT COUNT(*) as total FROM usuario WHERE email = '$email'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado alguem com o mesmo email cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=cadastro-usuario&cadastro=emailerro');
		exit();
	}

	//verificando se já tem alguem cadastrado com o mesmo cpf
	$query = "SELECT COUNT(*) as total FROM usuario WHERE cpf_usuario = '$cpf'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado alguem com o mesmo cpf cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=cadastro-usuario&cadastro=cpferro');
		exit();
	}

	$query = "INSERT INTO usuario (nome_usuario, sobrenome, email, senha, nivel_usuario, tel_usuario, cel_usuario, cpf_usuario) VALUES ('$nome_usuario', '$sobrenome', '$email', md5('$senha'), '$nivel', '$telefone', '$celular', '$cpf', now())";

	return mysqli_query($conexao, $query) or die (mysqli_error($conexao));

}


function consultarUsuario($idusuario = null) {
	//Conexão com Banco de Dados
	include_once 'model/conexao.php';
	$query = "SELECT * FROM usuario";
	if ($idusuario) {
		$query .= ' WHERE idusuario = ' . $idusuario;
	}
	return mysqli_query($conexao, $query);
}


function atualizarUsuario($usuario, $idusuario) {
	include '../model/conexao.php';

    //verificando se já tem alguem cadastrado com o mesmo email
	$email = $usuario['email'];
	$query = $query = "SELECT COUNT(*) as total FROM usuario WHERE email = '$email' and idusuario <> '$idusuario'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado alguem com o mesmo email cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=editar-usuario&update=emailerro&idusuario=' . $idusuario);
		exit();
	}

	//verificando se já tem alguem cadastrado com o mesmo cpf
	$cpf = $usuario['cpf'];
	$query = $query = "SELECT COUNT(*) as total FROM usuario WHERE cpf_usuario = '$cpf' and idusuario <> '$idusuario'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado alguem com o mesmo cpf cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=editar-usuario&update=cpferro&idusuario=' . $idusuario);
		exit();
	}

	$query = 'UPDATE usuario SET '
	. "nome_usuario='" . $usuario['nome_usuario'] . "',"
	. "sobrenome='" . $usuario['sobrenome'] . "',"
	. "email='" . $usuario['email'] . "',"
	. "nivel_usuario='" . $usuario['nivel_usuario'] . "',"
	. "tel_usuario='" . $usuario['tel_usuario'] . "',"
	. "cel_usuario='" . $usuario['cel_usuario'] . "',"
	. "cpf_usuario='" . $usuario['cpf_usuario'] . "'"
	. " WHERE idusuario = " . $idusuario;

	return mysqli_query($conexao, $query);
}


function excluirUsuario($idusuario){
	include '../model/conexao.php';
	$query = "DELETE FROM usuario where idusuario = '$idusuario'";
	return mysqli_query($conexao, $query);
}


function inserirBem($bem) {
	//Conexão com Banco de Dados
	include_once '../model/conexao.php';

	//?Continuar usando o 'mysqli_real_escape_string'?
	$nr_inventario = mysqli_real_escape_string($conexao, $bem['nr_inventario']);	
	$identificacao = mysqli_real_escape_string($conexao, $bem['identificacao']);
	$operacao = mysqli_real_escape_string($conexao, $bem['operacao']);
	$dt_cadbem = mysqli_real_escape_string($conexao, $bem['dt_cadbem']);
	$nr_rec = mysqli_real_escape_string($conexao, $bem['nr_rec']);
	$hist_operacao = mysqli_real_escape_string($conexao, $bem['hist_operacao']);
	$valor = mysqli_real_escape_string($conexao, $bem['valor']);

	//verificando se já tem o bem já cadastrado no sistema
	$query = "SELECT COUNT(*) as total FROM bem WHERE nr_inventario = '$nr_inventario'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado algum bem com o mesmo número cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=cadastro-bem&cadastro=bemerro');
		exit();
	}

	$query = "INSERT INTO bem (nr_inventario, identificao, operacao, dt_cadbem, nr_rec, hist_operacao, valor) VALUES ('$nr_inventario', '$identificacao', '$operacao', '$dt_cadbem', '$nr_rec', '$hist_operacao', '$valor', now())";

	return mysqli_query($conexao, $query) or die (mysqli_error($conexao));

}

function consultarBem($idbem = null) {
	//Conexão com Banco de Dados
	include_once 'model/conexao.php';
	$query = "SELECT * FROM bem";
	if ($idbem) {
		$query .= ' WHERE idbem = ' . $idbem;
	}
	return mysqli_query($conexao, $query);
}

function atualizarBem($bem, $idbem) {
	include '../model/conexao.php';

    //verificando se já tem algum bem com o mesmo número
	$nr_inventario = $bem['nr_inventario'];
	$query = $query = "SELECT COUNT(*) as total FROM bem WHERE nr_inventario = '$nr_inventario' and idbem <> '$idbem'";

	$resultado = mysqli_query($conexao, $query) or die (mysqli_error($conexao));
	$row = mysqli_fetch_assoc($resultado);

	//Se for encontrado alguem com o mesmo email cadastrado, redireciona para pagina de cadastro com um aviso
	if ($row['total'] == 1) {
		header('Location: ../painel.php?pagina=editar-bem&update=bemerro&idbem=' . $idusuario);
		exit();
	}
}
