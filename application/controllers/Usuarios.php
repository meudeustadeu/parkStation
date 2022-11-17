<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Usuarios extends CI_Controller{

    public function index(){

        $data = array(
            'titulo' => 'Usuários',
            'subtitulo' => 'Consulte, faça edição e exclua usuários',

            'usuarios' => $this->ion_auth->users()->result(),

            'styles' => array(
                '/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
            ),
            'scripts' => array(
                'plugins/datatables.net/js/jquery.dataTables.min.js',
                'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables.net/js/estacionamento.js',

            )
        );


        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function core($usuario_id = NULL)
    {
        if(!$usuario_id){
            exit('Pode cadastrar novo usuário');
        }else{
            if(!$this->ion_auth->user($usuario_id)->row()){
                exit('Usuário não existente');
            }else{
                //editar user
                $this->form_validation->set_rules('first_name', 'nome', 'trim|required|min_length[5]|max_length[20]');

                $this->form_validation->set_rules('last_name', 'sobrenome', 'trim|required|min_length[5]|max_length[10]');

                $this->form_validation->set_rules('username', 'usuário', 'trim|required|min_length[10]|max_length[10]');

                $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|min_length[10]|max_length[200]');

                $this->form_validation->set_rules('password', 'senha', 'trim|min_length[5]|max_length[10]');
                $this->form_validation->set_rules('password_confirm', 'confirmação de senha', 'trim|min_length[5]|max_length[10]|matches[password]');

                if($this->form_validation->run()){
                    echo '<pre>';
                    print_r($this->input->post());
                    exit();
                }else{
                    ///erro de validação

                    $data = array(
                        'titulo' => 'Usuários',
                        'subtitulo' => 'Realize aqui a edição dos usuários',
                        'icone_view' => 'ik ik-user',
                        'usuario' => $this->ion_auth->users($usuario_id)->row(),
                        'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                    );



                    $this->load->view('layout/header', $data);
                    $this->load->view('usuarios/core',$data);
                    $this->load->view('layout/footer');
                }
            }
        }


        // echo '<pre>';
        // print_r($data['perfil_usuario']);
        // exit();
    }
}


