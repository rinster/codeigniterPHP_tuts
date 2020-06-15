<?php
    class Post_model extends CI_Model{
        public function __construct() {
            $this->load->database(); //Load database
        }

        #GET: fetch all posts from DB
        public function get_posts($slug = FALSE){ # set slug to false is passed in as default
            if($slug === FALSE){ # check if slug is not passed in
                #order the posts by id to have recent posts first - decending order
                $this->db->order_by('posts.id', 'DESC');
                #join tables of categories with posts
                $this->db->join('categories', 'categories.id = posts.category_id');
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
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id')
            );
            return $this->db->insert('posts', $data);
        }

        #PUT: Delete post
        public function delete_post($id){
            $this->db->where('id', $id); #locate post by id
            $this->db->delete('posts'); #then delete it
            return true; #indicate post was sucessfully deleted
        }

        #POST: Submit post to DB
        public function update_post(){
            #echo $this->input->post('id');die(); #test id is being received
            $slug = url_title($this->input->post('title'));

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id')
            );
            $this->db->where('id', $this->input->post('id')); #locate post by id
            return $this->db->update('posts', $data);
        }

        #GET: Get categories data to populate form in create posts
        public function get_categories(){
            #organize categories by name
            $this->db->order_by('name'); 
            #store it into '$query'
            $query = $this->db->get('categories'); 
            #return data into an array
            return $query->result_array();
        }
    }