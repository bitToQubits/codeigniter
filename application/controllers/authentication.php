<?php
Class authentication extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("authentication_model");
        $this->load->helper('url');
        $this->load->helper("form");
        $this->load->library("form_validation");
    }

    public function login_index($data){
        $this->load->view("templates/header",$data);
        $this->load->view("authentication/login");
        $this->load->view("templates/footer");
    }

    public function login(){
        $data['title'] = 'Inicie sesion por favor';

        $this->form_validation->set_rules("username","Usuario","required");
        $this->form_validation->set_rules("password","Clave","required");

        if($this->form_validation->run() === False){
            $this->login_index($data);
        }else{
            if($this->authentication_model->login() === false){
                $data['message'] = "Credenciales incorrectas";
                $this->login_index($data);
            }else{
                $data['title'] = 'Sesion iniciada';
                $data['message'] = "¡Inicio de sesion correcto!";
                $_SESSION['user'] = $this->input->post("username");  
                $this->login_index($data);
            }
        }
    }

    public function register(){
        $this->form_validation->set_rules("username", "Usuario", "required");
        $this->form_validation->set_rules("pass", "Clave", "required");
        $data['title'] = "Registro de Usuarios";

        if($this->form_validation->run() === false){
            $this->load->view("templates/header", $data);
            $this->load->view("authentication/register");
            $this->load->view("templates/footer");
        }else{
            if($this->authentication_model->is_user()){
                $data['message'] = "Usuario ya tomado. Elegir otro.";
                $this->load->view("templates/header", $data);
                $this->load->view("authentication/register", $data);
                $this->load->view("templates/footer");
            }else{
                $this->authentication_model->register_user();
                redirect('/authentication/login', 'location');
            }
        }
    }
}

?>