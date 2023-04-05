<?php

class auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        if(!($this->session->has_userdata('authentication'))){
            redirect(base_url(''));
        }
    }
}
