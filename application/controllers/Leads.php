<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Leads extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("Lead");
        }
        public function index(){
            $this->load->view('index');
        }

        public function index_html($current_page){
            $data["leads"] = $this->Lead->all($current_page);
            $this->load->view("partials/leads", $data);
        }

        public function index_json(){
            $data = array();
            $data["notes"] = $this->Note->all();
            echo json_encode($data);
        }

        public function get_pages(){
            $data["pages"] = $this->Lead->generage_pagination();
            $this->load->view("partials/pagination", $data);
        }

        public function update_pagination(){
            $data["pages"] = array($this->session->userdata("num_rows"));
            $this->load->view("partials/pagination", $data);
        }

        public function search(){
            $search = $this->input->post();
            if($search["name"] == NULL)
                $search["name"] = "%%";
            else
                $search["name"] = "%".$search["name"]."%";
            
            if($search["start_date"] == NULL)
                $search["start_date"] = "1970-01-01 00:00:00";
            
            if($search["end_date"] == NULL)
                $search["end_date"] = date("Y-m-d, H:i:s");
            
            $search["current_page"] = $this->session->userdata("current_page");

            $data["leads"] = $this->Lead->search($search);

            $this->load->view("partials/leads", $data);
        }

        public function page($page){
            return $this->session->set_userdata("current_page", $page);
        }
    }
?>