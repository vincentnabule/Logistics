<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserRegistration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('UsersModel');
        $this->load->model('auth');
    }
    public function index()
    {
        $this->load->view('inc/header');
        $this->load->view('newuser');
        $this->load->view('inc/footer');
    }
    public function registration()
    {
        $this->form_validation->set_rules('userFirstName', 'First Name', 'alpha|trim|required');
        $this->form_validation->set_rules('userLastName', 'Last Name', 'alpha|trim|required');
        $this->form_validation->set_rules('usersGender', 'Gender ', 'trim|required');
        $this->form_validation->set_rules('userMail', 'Email Address *', 'trim|required|min_length[5]|max_length[30]|valid_email|is_unique[user_login.user_email]');
        $this->form_validation->set_rules('userRole', 'User Role ', 'trim|required');
        $this->form_validation->set_rules('userPhone', 'Phone Number ', 'numeric|min_length[10]|max_length[10]|trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data1 = array(
                'user_names' => ucwords($this->input->post('userFirstName')) . ' ' . ucwords($this->input->post('userLastName')),
                'user_gender' => $this->input->post('usersGender'),
                'user_contact' => $this->input->post('userPhone'),
                'user_email' => $this->input->post('userMail')
            );
            
            //Activating admin and truck owner to be able to access the system 
            if($this->input->post('userRole') == 'Admin' || $this->input->post('userRole') == 'Truck Owner'){
                $activate_user = 1;
            }else{
                $activate_user = 0;
            }

            // default password
            $pass = 12345;
            $encypt = md5($pass);
            $data2 = array(
                'user_email' => $this->input->post('userMail'),
                'user_password' => $encypt,
                'user_role' => $this->input->post('userRole'),
                'active_user' => $activate_user
            );

            // var_dump($data);
            $add_user = new UsersModel;
            $add_user->user_registration($data1);
            $add_user->save_logins($data2);

            $data['users'] = $add_user->all_users();
            $this->load->view('inc/header');
            $this->load->view('systemusers', $data);
            $this->load->view('inc/footer');
        }
    }
}
