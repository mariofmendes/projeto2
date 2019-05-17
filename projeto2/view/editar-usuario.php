<?php 
//Verificando se está logado
include_once 'controller/verifica_login.php';
?>

<form action="controller/usuario.php<?php echo isset($_GET['idusuario']) ? '?idusuario=' . $_GET['idusuario'] : '' ?>" method="POST">
	<div class="row">


		

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header"><strong><i class="fa fa-list-alt"></i> Editar Usuário</strong></div>
				<div class="card-body card-block">


					<ul> 
						<?php
						if (count($_GET) > 1) {
							unset($_GET['pagina']);
							foreach ($_GET as $i => $campo) {
								if ($campo == 'nome') {
									echo '<li>O PRIMEIRO NOME deve ser preenchido.</li>';
								} elseif ($campo == 'sobrenome') {
									echo '<li>O SOBRENOME deve ser preenchido.</li>';
								} elseif ($campo == 'email') {
									echo '<li>O EMAIL deve ser preenchido.</li>';
								} elseif ($campo == 'emailinvalido') {
									echo '<li>EMAIL inválido.</li>';
								} elseif ($campo == 'senha') {
									echo '<li>A SENHA deve ser preenchida.</li>';
								} elseif ($campo == 'senhainvalida') {
									echo '<li>A SENHA deve ter no minimo 8 caracteres.</li>';
								} elseif ($campo == 'nivel') {
									echo '<li>O NÍVEL deve ser preenchido.</li>';
								} elseif ($campo == 'nivelinvalido') {
									echo '<li>SENHA inválida.</li>';
								} elseif ($campo == 'telefone') {
									echo '<li>O TELEFONE deve ser preenchido.</li>';
								} elseif ($campo == 'telefoneinvalido') {
									echo '<li>TELEFONE inválido.</li>';
								} elseif ($campo == 'celular') {
									echo '<li>O CELULAR deve ser preenchido.</li>';
								} elseif ($campo == 'celularinvalido') {
									echo '<li>CELULAR inválido.</li>';
								} elseif ($campo == 'cpf') {
									echo '<li>O CPF deve ser preenchido.</li>';
								} elseif ($campo == 'cpfinvalido') {
									echo '<li>NÚMERO DE CPF INVÁLIDO.</li>';
								}
								
							}
						}
						?>
					</ul>

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
								<input name="nome" type="text" class="form-control" placeholder="Ex.: João" value="<?php echo $usuario['nome_usuario'] ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="sobrenome">Sobrenome</label>
								<input name="sobrenome" type="text" class="form-control" placeholder="Ex.: da Silva" value="<?php echo $usuario['sobrenome_usuario'] ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="email">E-mail</label>
								<input name="email" type="email" class="form-control" placeholder="Ex.: exemplo@gmail.com" value="<?php echo $usuario['email_usuario'] ?>">
							</div>
						</div>

						<?php
// exemplo de vetor com elementos iniciais
						$nivel = array(
							'1' => 'Nível 1 (Administrador)',
							'2' => 'Nível 2 (Funcionário)',
							'3' => 'Nível 3 (Visitante)',
						);
						?>

						<div class="col-md-4">
							<div class="form-group">
								<label for="nivel">Nível de Acesso</label>
								<select name="nivel" class="form-control">
									<option></option>
									<?php foreach ($nivel as $posicao => $valor): ?>

										<?php if (isset($usuario) && $usuario['nivel_usuario'] == $posicao): ?>
											<option value="<?php echo $posicao ?>" selected><?php echo $valor ?></option>
											<?php else: ?>
												<option value="<?php echo $posicao ?>"><?php echo $valor ?></option>
											<?php endif; ?>

										<?php endforeach; ?>

									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="telefone">Telefone</label>
									<input name="telefone" type="text" class="form-control" placeholder="Ex.: 2133445577" value="<?php echo $usuario['telefone_usuario'] ?>">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="celular">Celular</label>
									<input name="celular" type="text" class="form-control" placeholder="Ex.: 21999888777" value="<?php echo $usuario['celular_usuario'] ?>">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="cpf">CPF</label>
									<input name="cpf" type="text" class="form-control" placeholder="Ex.: 14687114634" value="<?php echo $usuario['cpf_usuario'] ?>">
								</div>
							</div>

							
							<div class="card-body">
								<button type="submit" class="btn btn-success" role="button">Atualizar</button>
								<a href="?pagina=lista-usuarios" class="btn btn-danger" >Cancelar</a>
							</div>



						</div>

						
						<!-- Mensagem de cadastrado com sucesso -->
						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'sucesso'):
							?>
							<div class="d-flex justify-content-around">
								<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
									<span class="badge badge-pill badge-success">Sucesso</span>
									Usuário Atualizado com sucesso.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<?php 
						endif ?>

						<!-- Mensagem de erro ao cadastrado  -->
						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'erro'):
							?>

							<div class="d-flex justify-content-around">
								<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
									<span class="badge badge-pill badge-danger">Erro</span>
									Erro ao tentar Atualizar Usuário.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<?php 
						endif ?>


						<!-- 	Mensagem de usuário já escolhido -->
						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'emailerro'):
							?>

							<div class="d-flex justify-content-around">
								<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
									<span class="badge badge-pill badge-danger">Erro</span>
									O E-mail escolhido já foi cadastrado.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<?php 
						endif ?>

						<?php 
						if (isset($_GET['update']) && $_GET['update'] == 'cpferro'):
							?>

							<div class="d-flex justify-content-around">
								<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
									<span class="badge badge-pill badge-danger">Erro</span>
									O CPF escolhido já foi cadastrado.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<?php 
						endif ?>
					</div>
				</div>
			</div>

		</div>
	</form>

	
