<?php
//Verificando se está logado
include_once 'controller/verifica_login.php';
?>

<div class="row ">

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong class="card-title"><i class="fa fa-users"></i> Usuários</strong>
			</div>

			<?php
			include_once 'model/usuario.php';
			//Chamando função de consulta
			$usuarios = consultarUsuario();
			?>



			<div class="card-body">
				<table class="table table-hover estilo-tabela">
					<thead>
						<tr>
							<th scope="col">Nome</th>
							<th scope="col">Sobrenome</th>
							<th scope="col">Nível de Acesso</th>
							<th scope="col">Email</th>
							<th scope="col">Ações</th>
						</tr>
					</thead>
					<tbody>

						<!-- Exibindo usuários cadastrados -->
						<?php if (mysqli_num_rows($usuarios) > 0) : ?>
							<?php while ($usuario = mysqli_fetch_assoc($usuarios)) : ?>
								<tr>
									<td><?php echo $usuario['nome_usuario']; ?></td>
									<td><?php echo $usuario['sobrenome']; ?></td>
									<td><?php echo $usuario['nivel_usuario']; ?></td>
									<td><?php echo $usuario['email']; ?></td>
									<td>
										<a href="painel.php?pagina=visualizar-usuario&idusuario=<?php echo $usuario['idusuario']; ?>" class="btn btn-outline-success btn-sm">Visualizar</a>
										<a href="painel.php?pagina=editar-usuario&idusuario=<?php echo $usuario['idusuario']; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
										<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#staticModal<?php echo $usuario['idusuario']; ?>">Deletar</button>


										<!-- Início Modal -->
										<div class="modal fade" id="staticModal<?php echo $usuario['idusuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-sm" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="staticModalLabel">Atenção</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<p>
															Você deseja deletar este Usuário?
														</p>
													</div>
													<div class="modal-footer">
														<a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
														<a href="controller/usuario.php?acao=excluir&idusuario=<?php echo $usuario['idusuario'] ?>" class="btn btn-primary">Confirm</a>
													</div>
												</div>
											</div>
										</div>
										<!-- Fim Modal -->

									</td>
								</tr>
							<?php endwhile; ?>
						<?php else : ?>
							<tr>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>

				<!-- Mensagem de deletado com sucesso -->
				<?php
				if (isset($_GET['mensagem']) && $_GET['mensagem'] == 'deletadosucesso') :
					?>
					<div class="d-flex justify-content-around">
						<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
							<span class="badge badge-pill badge-success">Sucesso</span>
							Usuário deletado com sucesso.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				<?php
			endif ?>

				<!-- Mensagem de erro ao tentar deletar  -->
				<?php
				if (isset($_GET['mensagem']) && $_GET['mensagem'] == 'deletadoerro') :
					?>
					<div class="d-flex justify-content-around">
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
							<span class="badge badge-pill badge-danger">Erro</span>
							Erro ao tentar deletar.
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