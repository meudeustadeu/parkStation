        <?php $this->load->view('layout/navbar') ?>

        <div class="page-wrap">

            <?php $this->load->view('layout/sidebar') ?>

            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="<?php echo $icone_view; ?> bg-blue"></i>
                                    <div class="d-inline">
                                        <h5>Registro de usuários</h5>
                                        <span><?php echo (isset($subtitulo) ? $subtitulo : 'Um novo conceito em estacionamento!'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a data-toggle="tooltip" data-placement="bottom" title="Ir para a home" href="<?php echo base_url('/') ?>"><i class="ik ik-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a data-toggle="tooltip" data-placement="bottom" title="Lista de usuários cadastrados" href="<?php echo base_url('usuarios') ?>">Usuários</a>
                                        </li>
                                        <li data-toggle="tooltip" data-placement="bottom" class="breadcrumb-item active" aria-current="page">Edição de usuário</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Última modificação: <?= formata_data_banco_com_hora(isset($usuario) ? $usuario->data_ultima_alteracao : ''); ?></div>

                                <div class="card-body">


                                    <form class="forms-sample" name="form_core" method="post">
                                        <div class="form-group row">
                                            <div class="col-md-6 mb-20">
                                                <label>Nome</label>
                                                <input type="text" class="form-control" placeholder="Nome" name="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
                                                <?php echo form_error('first_name', '<div class="mt-5 alert alert-danger"> ', '</div>'); ?>
                                            </div>
                                            <div class="col-md-6 mb-20">
                                                <label>Sobrenome</label>
                                                <input type="text" class="form-control" placeholder="Sobrenome" name="last_name" value="<?php echo (isset($usuario) ? $usuario->last_name : set_value('last_name')); ?>">
                                                <?php echo form_error('last_name', '<div class="mt-5 alert alert-danger"> ', '</div>'); ?>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 mb-20">
                                                <label>Usuário</label>
                                                <input type="text" class="form-control" placeholder="Nome de usuário" name="username" value="<?php echo (isset($usuario) ? $usuario->username : set_value('username')); ?>">
                                                <?php echo form_error('username', '<div class="mt-5 alert alert-danger"> ', '</div>'); ?>

                                            </div>
                                            <div class="col-md-6 mb-20">
                                                <label>Email (Login)</label>
                                                <input type="text" class="form-control" placeholder="usuario@hotmail.com" name="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
                                                <?php echo form_error('email', '<div class="mt-5 alert alert-danger"> ', '</div>'); ?>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 mb-20">
                                                <label>Senha</label>
                                                <input type="password" class="form-control" placeholder="******" name="password" value="">
                                                <?php echo form_error('password', '<div class="mt-5 alert alert-danger"> ', '</div>'); ?>

                                            </div>
                                            <div class="col-md-6 mb-20">
                                                <label>Cofirmação de senha</label>
                                                <input type="password" class="form-control" placeholder="******" name="password_confirm" value="">
                                                <?php echo form_error('password_confirm', '<div class="mt-5 alert alert-danger"> ', '</div>'); ?>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 mb-20">
                                                <label>Perfil de acesso</label>
                                                <select class="form-control" name="perfil" id="">
                                                    <?php if (isset($usuario)) : ?>
                                                        <option value="2" <?php echo ($perfil_usuario->id == 2 ? 'selected' : '') ?>>Atendente</option>
                                                        <option value="1" <?php echo ($perfil_usuario->id == 1 ? 'selected' : '') ?>>Administrador</option>
                                                    <?php else : ?>
                                                        <option value="2">Atendente</option>
                                                        <option value="1">Administrador</option>
                                                    <?php endif ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-20">
                                                <label>Ativo</label>
                                                <select class="form-control" name="active" id="">
                                                    <?php if (isset($usuario)) : ?>
                                                        <option value="0" <?php echo ($usuario->active == 0 ? 'selected' : '') ?>>Não ativo</option>
                                                        <option value="1" <?php echo ($usuario->active == 1 ? 'selected' : '') ?>>Ativo</option>
                                                    <?php else : ?>
                                                        <option value="0">Não ativo</option>
                                                        <option value="1">Ativo</option>
                                                    <?php endif ?>
                                                </select>
                                            </div>
                                        </div>

                                        <?php if (isset($usuario)) : ?>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="hidden" class="form-control" name="usuario_id" value="<?php echo $usuario->id ?>">
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        <button type="submit" class="btn btn-success mr-2">Gravar</button>
                                        <a href="<?php echo base_url('usuarios') ?>" class="btn btn-danger">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="w-100 clearfix">
                    <span class="text-center text-sm-left d-md-inline-block">Copyright © <?php echo date('Y') ?> ThemeKit v2.0. All Rights Reserved.</span>
                    <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Customization <i class="fa fa-code text-dark"></i> by <a href="javascript:void" class="text-dark">dev@meudeustadeu</a></span>
                </div>
            </footer>
        </div>

        <script>
            $.notify("Hello World");
            notify();
        </script>