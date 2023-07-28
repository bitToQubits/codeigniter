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
}

?>