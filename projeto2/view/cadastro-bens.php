<?php
//Verificando se está logado
include_once 'controller/verifica_login.php';
?>

<form action="controller/usuario.php" method="POST">
    <div class="row">




        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong><i class="fa fa-list-alt"></i> Cadastrar Bens</strong></div>
                <div class="card-body card-block">


                    <ul>
                        <?php
                        if (count($_GET) > 1) {
                            unset($_GET['pagina']);
                            foreach ($_GET as $i => $campo) {
                                if ($campo == 'nr_inventario') {
                                    echo '<li>O NÚMERO DO INVENTÁRIO deve ser preenchido.</li>';
                                } elseif ($campo == 'identificacao') {
                                    echo '<li>A IDENTIFICAÇÃO deve ser preenchida.</li>';
                                } elseif ($campo == 'operacao') {
                                    echo '<li>A OPERAÇÃO deve ser preenchido.</li>';
                                } elseif ($campo == 'dt_cadbem') {
                                    echo '<li>A DATA DE CADASTRAMENTO deve ser preenchida.</li>';
                                } elseif ($campo == 'nr_rec') {
                                    echo '<li>O DOCUMENTO HÁBIL deve ser preenchido.</li>';
                                } elseif ($campo == 'hist_operacao') {
                                    echo '<li>O HISTÓRICO DA OPERAÇÃO deve ser preenchido.</li>';
                                } elseif ($campo == 'valor') {
                                    echo '<li>O VALOR deve ser preenchido.</li>';
                                }
                            }
                        }
                        ?>
                    </ul>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nr_inventario">Número de Inventário<span class="text-danger">*</span></label>
                                <input name="nr_inventario" type="text" class="form-control" placeholder="Ex.: 000001">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="identificacao">Identificação<span class="text-danger">*</span></label>
                                <input name="identificacao" type="text" class="form-control" placeholder="Ex.: Computador">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="operacao">Operação<span class="text-danger">*</span></label>
                                <select name="operacao" class="form-control">>
                                    <option value=""></option>
                                    <option value="1">1 - (Compra)</option>
                                    <option value="2">2 - (Aluguel)</option>
                                    <option value="3">3 - (Doação)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dt_cadbem">Data do Cadastramento<span class="text-danger">*</span></label>
                                <input name="dt_cadbem" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nr_rec">Documento Hábil<span class="text-danger">*</span></label>
                                <input name="nr_rec" type="text" class="form-control" placeholder="Ex.: 12345">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hist_operacao">Histórico da Operação<span class="text-danger">*</span></label>
                                <input name="hist_operacao" type="text" class="form-control" placeholder="Ex.: NF 123 - Empresa X - 27/02/2019">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php if ($_SESSION['operacao'] == 1) : ?>
                                    <label for="valor">Valor<span class="text-danger">*</span></label>
                                    <input name="valor" type="text" class="form-control" placeholder="Ex.: R$ 1.000,00">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary" role="button">Cadastrar</button>
                            <a href="?pagina=lista-usuarios" class="btn btn-danger">Cancelar</a>
                        </div>

                    </div>

                    <!-- Mensagem de cadastrado com sucesso -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') :
                        ?>
                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-success">Sucesso</span>
                                Usuário cadastrado com sucesso.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php
                endif ?>

                    <!-- Mensagem de erro ao cadastrado  -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'erro') :
                        ?>

                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                Erro ao tentar Cadastrar.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php
                endif ?>

                    <!-- 	Mensagem de usuário já escolhido -->
                    <?php
                    if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'bemerro') :
                        ?>

                        <div class="d-flex justify-content-around">
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-4 col-sm-12">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                O BEM escolhido já foi cadastrado.
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