<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('UsersModel');
         $this->load->model('auth');
    }
    public function users()
    {
        $data['users'] = $this->UsersModel->all_users();
        $this->load->view('inc/header');
        $this->load->view('systemusers', $data);
        $this->load->view('inc/footer');
    }
    public function sign_out()
    {
        $this->session->unset_userdata('authentication');
        $this->session->unset_userdata('user_data');
        redirect(base_url(''));
    }
    public function profile()
    {
        $this->load->view('inc/header');
        $this->load->view('profile');
        $this->load->view('inc/footer');
    }
    public function update_password()
    {
        $this->form_validation->set_rules('oldpass', 'Old Password', 'trim|required|min_length[5]|md5');
        $this->form_validation->set_rules('newpass', 'New Password', 'trim|required|min_length[5]|md5');
        $this->form_validation->set_rules('newpass2', 'Confirm Password', 'trim|required|min_length[5]|md5|matches[newpass]');

        if ($this->form_validation->run() == FALSE) {
            $this->profile();
        } else {
            # code...
            $data =  [
                'oldpassword' => $this->input->post('oldpass'),
                'newpassword' => $this->input->post('newpass')
            ];

            $user = new UsersModel;
            $updated = $user->change_password($data);
            if ($updated != false) {
                $this->session->set_flashdata('update', 'Password Changed Successfully');
                redirect(base_url('my_profile'));
            }else{
                $this->session->set_flashdata('update', 'Incorrect old Password');
                redirect(base_url('my_profile'));  
            }
            $this->profile();
            // var_dump($_POST);
        }
    }
}
