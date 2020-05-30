<?php
    class Post_model extends CI_Model{
        public function __construct() {
            $this->load->database(); //Load database
        }

        //GET: fetch all posts from DB
        public function get_posts($slug = FALSE){ // set slug to false is passed in as default
            if($slug === FALSE){ // check if slug is not passed in
                $query = $this->db->get('posts');
                return $query->result_array();
            }
            //If slug param is passed in
            $query = $this->db->get_where('posts', array('slug' => $slug));
            return $query->row_array();
        }
    }