<?php
Class authentication_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function login(){
        $data = array(
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password")
        );

        $query = $this->db->get_where('users', $data, 1);

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function register_user(){
        $data = array(
            "username" => $this->input->post("username"),
            "password" => $this->input->post("pass")
        );

        return $this->db->insert("users", $data);
    }

    public function is_user(){
        $user = $this->input->post("username");
        $query = $this->db->get_where("users", array("username" => $user));

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}

?>