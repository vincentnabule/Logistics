<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserLogin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->has_userdata('authentication')) {
            redirect(base_url('dashboard'));
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('UsersModel');
    }
    public function index()
    {
        $this->load->view('landingpage');
    }
    public function sign_up()
    {
        $this->form_validation->set_rules('userMail', 'Email Address', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('userPassword', 'Password', 'trim|required|min_length[4]|md5');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
            // var_dump($_POST);
        } else {
            $data = [
                'email' => $this->input->post('userMail'),
                'password' => $this->input->post('userPassword')
            ];

            $user = new UsersModel;
            $valid = $user->log_in($data);
            if ($valid != false) {
                $details = $user->this_user($valid->user_id);
                $detail = [
                    'user_id' => $details->user_id,
                    'names' => $details->user_names,
                    'gender' => $details->user_gender,
                    'contact' => $details->user_contact,
                    'email' => $details->user_email,
                    'register' => $details->registration_date,
                    'role' => $valid->user_role
                ];

                $this->session->set_userdata('authentication', $valid->user_role);
                $this->session->set_userdata('user_data', $detail);
                if($valid->password_changed == 0){
                    $this->session->set_flashdata('update', 'Change your password <br> You are still using the default password');
                    redirect(base_url('my_profile'));
                }else{
                    redirect(base_url('dashboard'));
                }
            } else {
                $this->session->set_flashdata('fail', 'Invalid email address or password');
                redirect(base_url(''));
            }
        }
    }
}
