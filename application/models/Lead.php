<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Lead extends CI_Model {
        public function all($current_page){
            $offset = 15;
            $limit = ($offset * $current_page) - $offset;

            $query = "SELECT * FROM leads LIMIT ?, ?";
            $values = array($limit, $offset);

            $get_leads = $this->db->query($query, $values)->result_array();

            if($get_leads != NULL){
                return $get_leads;
            }
            else{
                return "No Result";
            }
        }

        public function search($search){
            $offset = 15;
            $limit = ($offset * $search["current_page"]) - $offset;

            $query_rows = "SELECT * FROM leads WHERE CONCAT(first_name, ' ', last_name) LIKE ? AND registered_datetime BETWEEN ? AND ?";
            $values_rows = array($search["name"], $search["start_date"], $search["end_date"]);

            $query = "SELECT * FROM leads WHERE CONCAT(first_name, ' ', last_name) LIKE ? AND registered_datetime BETWEEN ? AND ? LIMIT ?, ?";
            $values = array($search["name"], $search["start_date"], $search["end_date"], $limit, $offset);

            $get_leads = $this->db->query($query, $values)->result_array();

            $this->session->set_userdata("num_rows", CEIL($this->db->query($query_rows, $values_rows)->num_rows() / 15));
            
            if($get_leads != NULL){
                return $get_leads;
            }
            else{
                return "No Result";
            }
        }

        public function generage_pagination(){
            $pages = $this->db->query("SELECT CEIL(COUNT(*) / 15) AS pages FROM leads")->row_array();
            
            if($pages != NULL){
                return $pages;
            }
            else{
                return "None";
            }
        }

        public function create($new_note){
            $query = "INSERT INTO notes (title, created_at, updated_at) VALUES (?, ?, ?)";
            $values = array($new_note["note"], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));

            return $this->db->query($query, $values);
        }

        public function update($update_note){
            $query = "UPDATE notes SET title = ?, description = ?, updated_at = ? WHERE id = ? ";
            $values = array($update_note["title"], $update_note["description"], date("Y-m-d, H:i:s"), $update_note["id"]);

            return $this->db->query($query, $values);
        }

        public function delete($id){
            $query = "DELETE FROM notes WHERE id = ? ";
            $values = $id;

            return $this->db->query($query, $values);
        }
    }
?>
