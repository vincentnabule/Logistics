<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logistics extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('LogisticsModel');
        $this->load->model('UsersModel');

        $this->load->model('auth');
    }
    public function dashboard()
    {
        $data['trucks'] = $this->LogisticsModel->trucks();
        $data['trips'] = $this->LogisticsModel->trips();
        $data['trips_today'] = $this->LogisticsModel->today_trips();
        $data['trucks_count'] = $this->LogisticsModel->all_trucks();
        $data['drivers'] = $this->UsersModel->user_count('Driver');
        $data['owners'] = $this->UsersModel->user_count('Truck Owner');
        $data['staff'] = $this->UsersModel->user_count('Staff');

        $this->load->view('inc/header');
        $this->load->view('dashboard', $data);
        $this->load->view('inc/footer');
    }
    public function all_trips()
    {
        $data['trips'] = $this->LogisticsModel->trips();

        $this->load->view('inc/header');
        $this->load->view('trips', $data);
        $this->load->view('inc/footer');
    }
    public function trucks()
    {
        $this->load->model('UsersModel');

        $data['users'] = $this->UsersModel->all_users();
        $data['trucks'] = $this->LogisticsModel->trucks();
        $data['my_trucks'] = $this->LogisticsModel->my_trucks($this->session->userdata('user_data')['names']);


        $this->load->view('inc/header');
        $this->load->view('trucks', $data);
        $this->load->view('inc/footer');
    }
    public function add_truck()
    {
        $this->form_validation->set_rules('truckReg', 'Truck Reg', 'is_unique[trucks.truck_reg]');
        if ($this->form_validation->run() == FALSE) {
            // truck already registered
            $this->trucks();
        } else {
            $data = array(
                'truck_reg' => strtoupper($this->input->post('truckReg')),
                'truck_fuel' => $this->input->post('truckFuel'),
                'truck_owner' => $this->input->post('truckOwner'),
                'truck_driver' => $this->input->post('truckDrive')
            );

            $this->LogisticsModel->save_truck($data);
            $this->trucks();
        }
    }
    public function new_trip()
    {
        $data['trucks'] = $this->LogisticsModel->trucks();

        $this->load->view('inc/header');
        $this->load->view('newtrip', $data);
        $this->load->view('inc/footer');
    }
    public function add_trip()
    {
        $this->form_validation->set_rules('tripFrom', 'Trip From', 'alpha|trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('tripTo', 'Trip To', 'alpha|trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('tripDate', 'Trip Date', 'trim|required');
        $this->form_validation->set_rules('truck', 'Truck', 'required');
        $this->form_validation->set_rules('cargo', 'Cargo Description', 'trim|required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->new_trip();
        } else {
            $data = array(
                'truck' => $this->input->post('truck'),
                'trip_from' => ucwords($this->input->post('tripFrom')),
                'trip_to' => ucwords($this->input->post('tripTo')),
                'trip_date' => $this->input->post('tripDate'),
                'cargo_description' => htmlspecialchars($this->input->post('cargo'))
            );

            $save_trip = new LogisticsModel;
            $save_trip->save_trip($data);
            $this->all_trips();
        }
    }
    public function on_route($a)
    {
        $trip_route = new LogisticsModel;
        $trip_route->trip_route($a);
        redirect(base_url('all_trips'));
    }
    public function trip_done($a)
    {
        $newinput = explode('%20', $a);
        $trip = [
            'id' => $newinput[0],
            'truck' => $newinput[1] . ' ' . $newinput[2]
        ];

        $trip_complete = new LogisticsModel;
        $trip_complete->trip_completed($trip);
        redirect(base_url('all_trips'));
    }
    public function truck($a)
    {
        $reg = explode('%20', $a);
        $truck_reg = $reg[0] . ' ' . $reg[1];

        $trips = new LogisticsModel;
        $data['all_trips'] = $trips->truck_trips($truck_reg);
        $data['truck_number'] = $truck_reg;

        $this->load->view('inc/header');
        $this->load->view('history', $data);
        $this->load->view('inc/footer');
    }
}
