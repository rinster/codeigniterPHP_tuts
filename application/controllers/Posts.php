<?php
    class Posts extends CI_Controller {
        public function index(){
            
            $data['title'] = 'Latest Posts';

            //Add posts into the data model
            $data['posts'] = $this->post_model->get_posts();
            #print_r($data['posts']); #test print if retrieving from DB

            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }

        //Linking views
        public function view($slug = NULL){
            $data['post'] = $this->post_model->get_posts($slug); 

            if(empty($data['post'])) { #if no slug, show 404 error message
                show_404();
            }
            #Else set post title to the data title
            $data['title'] = $data['post']['title'];

            #Load our views
            $this->load->view('templates/header');
            $this->load->view('posts/view', $data);
            $this->load->view('templates/footer');
        }
    }
