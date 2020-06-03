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

        //Linking posts/views.php
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

        //Create Post
        public function create(){
            $data['title'] = 'Create Post';

            #Setting rules for form validation
            $this->form_validation->set_rules('title', 'Title', 'required'); #(name, format, isRequired?)
            $this->form_validation->set_rules('body', 'Body', 'required');

            #Check IF form has been submitted
            #If NOT submitted
            if($this->form_validation->run() === FALSE){
                #Load our views
                $this->load->view('templates/header');
                $this->load->view('posts/create', $data);
                $this->load->view('templates/footer');
            } else {#IF submitted and validation passes
                #create post to model
                $this->post_model->create_post();
                #load a success view
                //$this->load->view('post/success');
                #redirect to post create in lieu of success view
                redirect('posts');
            }            
        }

        #Delete Post
        public function delete($id){
            #echo $id; #Test of id is being received
            #Delete post
            $this->post_model->delete_post($id);
            redirect('posts');
        }
    }
