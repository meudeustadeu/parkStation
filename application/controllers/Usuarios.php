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
                $perfil_atual = $this->ion_auth->get_users_groups($usuario_id)->row();


                $this->form_validation->set_rules('first_name', 'nome', 'trim|required|min_length[5]|max_length[20]');

                $this->form_validation->set_rules('last_name', 'sobrenome', 'trim|required|min_length[5]|max_length[10]');

                $this->form_validation->set_rules('username', 'usuário', 'trim|required|min_length[5]|max_length[15]|callback_username_check');

                $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|min_length[10]|max_length[200]callback_email_check');

                $this->form_validation->set_rules('password', 'senha', 'trim|min_length[5]|max_length[10]');
                $this->form_validation->set_rules('password_confirm', 'confirmação de senha', 'trim|min_length[5]|max_length[10]|matches[password]');

                if($this->form_validation->run()){

                    $data = elements(
                        array(
                                    'first_name',
                                    'last_name',
                                    'username',
                                    'email',
                                    'password',
                                    'active'
                                    ), $this->input->post()
                    );


                    $password = $this->input->post('password');

                    if(!$password){
                        unset($data['password']);
                    };

                    $data = html_escape($data);


                    if($this->ion_auth->update($usuario_id,$data)){

                        $perfil_post = $this->input->post('perfil');

                        if($perfil_atual->id != $perfil_post){
                            $this->ion_auth->remove_from_group($perfil_atual->id, $usuario_id);
                            $this->ion_auth->add_to_group($perfil_post, $usuario_id);
                        }

                        $this->session->set_flashdata('sucesso' ,'Dados atualizados com sucesso');
                    }else{
                        $this->session->set_flashdata('error', 'Erro ao atualizar');
                    }
                    redirect($this->router->fetch_class());

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
        echo '<pre>';
        print_r($data);
        exit();
    }

    public function username_check($username)
    {
        $usuario_id = $this->input->post('usuario_id');
        if($this->core_model->get_by_id('users',array('username' => $username, 'id !=' => $usuario_id))){
            $this->form_validation->set_message('username_check', 'Usuário já existente. Tente outro.');
            return false;
        }else{
            return true;
        }
    }

    public function email_check($email)
    {
        $usuario_id = $this->input->post('usuario_id');
        if($this->core_model->get_by_id('users',array('email' => $email, 'id !=' => $usuario_id))){
            $this->form_validation->set_message('username_check', 'Este email já foi cadastrado. Tente outro. ');
            return false;
        }else{
            return true;
        }
    }
}


