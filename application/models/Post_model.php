<?php
    class Post_model extends CI_Model{
        public function __construct() {
            $this->load->database(); //Load database
        }

        #GET: fetch all posts from DB
        public function get_posts($slug = FALSE){ # set slug to false is passed in as default
            if($slug === FALSE){ # check if slug is not passed in
                #order the posts by id to have recent posts first - decending order
                $this->db->order_by('id', 'DESC');
                #store the posts in the query
                $query = $this->db->get('posts');
                return $query->result_array();
            }
            //If slug param is passed in
            $query = $this->db->get_where('posts', array('slug' => $slug));
            return $query->row_array();
        }

        #POST: Create a post 
        public function create_post(){
            $slug = url_title($this->input->post('title'));

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body')
            );
            return $this->db->insert('posts', $data);
        }

        #PUT: Delete post
        public function delete_post($id){
            $this->db->where('id', $id); #locate post by id
            $this->db->delete('posts'); #then delete it
            return true; #indicate post was sucessfully deleted
        }
    }