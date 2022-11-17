        <?php $this->load->view('layout/navbar') ?>

        <div class="page-wrap">

        <?php $this->load->view('layout/sidebar') ?>

            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="ik ik-users bg-blue"></i>
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
                                            <a title="Ir para a home" href="<?php echo base_url('/') ?>"><i class="ik ik-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Registro de usuários</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>



                    <?php if ($message = $this->session->flashdata('sucesso')) :  ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success bg-success text-white alert-dismissible fade show" role="alert" style="font-size: 15px;">
                                        <b><i class="ik ik-check"></i>&nbspAlterações feitas com sucesso! 😁</b>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                                        <i class="ik ik-x text-white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    <?php endif ?>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><a class="btn btn-success" href="">+ Cadastrar</a></div>
                            <div class="card-body">
                                <table class="table data_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuário</th>
                                            <th>Email</th>
                                            <th>Nome</th>
                                            <th>Perfil de acesso</th>
                                            <th>Ativo</th>
                                            <th class="nosort text-right pr-50">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($usuarios as $user) : ?>
                                            <tr>
                                                <td><?= $user->id ?></td>
                                                <td><?= $user->username ?></td>
                                                <td><?= $user->email ?></td>
                                                <td><?= $user->first_name ?></td>
                                                <td><?= ($this->ion_auth->is_admin($user->id) ? 'Administrador' : 'Atendente') ?></td>
                                                <td><?= ($user->active == 1 ? '<span class="badge badge-pill badge-success mb-1">Sim</span>' : '<span class="badge badge-pill badge-warning mb-1">Não ativo</span>'); ?></td>
                                                <td class="text-right">
                                                    <a data-toggle="tooltip" data-placement="bottom" title="Clique para editar" type="button" class="btn btn-primary" href="<?php echo base_url('usuarios/core/' . $user->id) ?>"><i class="ik ik-edit-2"></i>Editar</a>
                                                    <a data-toggle="tooltip" data-placement="bottom" title="Clique para excluir" type="button" class="btn btn-danger" style="color: white;"><i class="ik ik-trash-2"></i>Excluir</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
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