<?php
    class Pages extends CI_Controller {
        public function view($page = 'home'){
            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) { //If file doesn't exist
                show_404(); //Load codeigniter function to show error 
            }
            
            //Load data to pass into view
            $data['title'] = ucfirst($page); //ucfirst() to uppercase the title of page

            //Load header
            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }
    }
