<?php
Class authentication extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("authentication_model");
    }

    public function login_index($data){
        $this->load->view("templates/header",$data);
        $this->load->view("authentication/login");
        $this->load->view("templates/footer");
    }

    public function login(){
        $this->load->helper("form");
        $this->load->library("form_validation");
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
}

?>