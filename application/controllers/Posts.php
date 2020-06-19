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

            #retrieve categories data for the DB to insert into form
            $data['categories'] = $this->post_model->get_categories();

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
                
                #Upload image configuration
                $config['upload_path'] = './assets/images/posts';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '500';
                $config['max_height'] = '500';
                #upload files with the configuration stated above
                $this->load->library('upload', $config);
                #check if files are uploaded
                if(!$this->upload->do_upload('userfile')) {
                    #if upload fails or no file is uploaded
                    $errors = array('error' => $this->upload->display_errors());
                    $post_image = 'noimage.jpg'; #default image if user does not upload image
                } else {
                    #if file upload succeeds
                    $data = array('upload_data' => $this->upload->data()); #save file to specified upload path folder
                    $post_image = $_FILES['userfile']['name']; #pass the userfile name of image to the database
                } 
                
                #create post to model
                $this->post_model->create_post($post_image); #pass $post_image into model
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

        #Edit Post - Render the Edit post view
        public function edit($slug){
            $data['post'] = $this->post_model->get_posts($slug); 

            #retrieve categories data for the DB to populate into form
            $data['categories'] = $this->post_model->get_categories();

            if(empty($data['post'])) { #if no slug, show 404 error message
                show_404();
            }
            
            $data['title'] = 'Edit Post';

            #Load our views
            $this->load->view('templates/header');
            $this->load->view('posts/edit', $data);
            $this->load->view('templates/footer');
        }

        #Update Post
        public function update() {
            $this->post_model->update_post();
            redirect('posts');
        }
    }
