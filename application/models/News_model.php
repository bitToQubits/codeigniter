<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database(); //Cargando la libreria
        }

        public function get_news($slug = FALSE){
                if ($slug === FALSE)
                {
                        //Query builder te permite interactuar con la db, sanitizando el input
                        $query = $this->db->get('news'); //Obtener todos los articulos si no hay slug.
                        return $query->result_array();
                }
                //Obtener articulo si hay slug.
                $query = $this->db->get_where('news', array('slug' => $slug));
                return $query->row_array();
        }

        public function set_news(){
                $this->load->helper('url');

                //Retorna una url, que reemplaza espacios por - y pone todo el argumento en
                //minusculas. Parte del helper url
                $slug = url_title($this->input->post('title'), 'dash', TRUE); 

                //la function post de la libreria input sanitiza la data. Carga por defecto.
                //Cada elemento del array corresponde a una columna.
                $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text')
                );

                return $this->db->insert('news', $data); //Insertando la data en la db
        }

        public function update_new($slug = NULL){
                $this->load->helper('url');

                $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text')
                );

                $this->db->where('slug', $slug);
                return $this->db->update('news', $data); //Actualizando la data en la db
        }

        public function remove_new($slug){
                return $this->db->delete('news', array('slug' => $slug));
        }
}

?>