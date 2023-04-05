  <?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogisticsModel extends CI_Model
{
    public function _construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function trucks()
    {
        $trucks = $this->db->query("select * from trucks");
        return $trucks->result();
    }
    public function my_trucks($a)
    {
        $this->db->select('*');
        $this->db->where('truck_owner', $a);
        $this->db->from('trucks');
        $my_trucks = $this->db->get();


        return $my_trucks->result();
    }
    public function save_truck($a)
    {
        return $this->db->insert('trucks', $a);
    }
    public function trips()
    {
        $trips = $this->db->query("select * from trips");
        return $trips->result();
    }
    
    public function today_trips()
    {
        $this->db->select('*');
        $this->db->where('trip_date', date('Y-m-d'));
        $this->db->from('trips');
        return $this->db->count_all_results();
    }
    public function all_trucks()
    {
        $this->db->select('*');
        $this->db->from('trucks');
        return $this->db->count_all_results();
    }
    public function save_trip($a)
    {
        if ($this->db->insert('trips', $a)) {
            $this->db->set('truck_status', 'Engaged');
            $this->db->where('truck_reg', $a['truck']);
            $this->db->update('trucks');
        }
    }
    public function trip_route($a)
    {
        $this->db->set('trip_status', 'On Route');
        $this->db->where('trip_id', $a);
        $this->db->update('trips');
    }
    public function trip_completed($a)
    {
        $this->db->set('trip_status', 'Completed');
        $this->db->where('trip_id', $a['id']);
        $this->db->update('trips');
        if ($this->db->update('trips')) {
            $this->db->set('truck_status', 'Available');
            $this->db->where('truck_reg', strtoupper($a['truck']));
            $this->db->update('trucks');
        }
    }
    public function truck_trips($a){
        $this->db->select('*');
        $this->db->from('trips');
        $this->db->where('truck', $a);
        $history = $this->db->get();

        return $history->result();      
    }
}
