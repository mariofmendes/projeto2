<?php 
//Verificando se está logado
include_once 'controller/verifica_login.php';
?>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header"><strong><i class="fa fa-list-alt"></i> Editar Usuário</strong></div>
			<div class="card-body card-block">

				<?php 
				if (isset($_GET['idusuario']) && $idusuario = trim($_GET['idusuario'])) {
					include_once 'model/usuario.php';
					$usuario = consultarUsuario($idusuario);
					$usuario = mysqli_fetch_assoc($usuario);
				}
				
				?>


				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="nome">Nome</label>
							<p><?php echo $usuario['nome_usuario'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="sobrenome">Sobrenome</label>
							<p><?php echo $usuario['sobrenome_usuario'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="email">E-mail</label>
							<p><?php echo $usuario['email_usuario'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="nivel">Nível de Acesso</label>
							<p><?php echo $usuario['nivel_usuario'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="telefone">Telefone</label>
							<p><?php echo $usuario['telefone_usuario'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="celular">Celular</label>
							<p><?php echo $usuario['celular_usuario'] ?></p>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="cpf">CPF</label>
							<p><?php echo $usuario['cpf_usuario'] ?></p>
						</div>
					</div>

					
					<div class="card-body">
						<a href="?pagina=lista-usuarios" class="btn btn-danger" >Voltar</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


