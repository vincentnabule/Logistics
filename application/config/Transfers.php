<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers extends MY_Controller {

    public $role;
    public $username;
    var $data;

    function __construct()
    {
        parent::__construct();

        if( !isset($_SESSION['userrole']) || !isset($_SESSION['username']) ){
            //session is not set. cancel back to login page
            redirect(site_url('pages/logout'));
        }
        else{
            #echo "Success";
            $this->role = $_SESSION['userrole'];
            $this->username = $this->session->userdata('username');
            
            $this->load->model('Majorselects');
            $this->load->model('Inserts');
            $this->load->model('Users_Model');
            $this->load->model('Transfers_Model', 'transfer');
            
            $this->data['active_user'] = $this->Majorselects->get_user();
        }
    }

    public function index () {
        #$this->permission_check('accounts_view');
        $this->session->set_userdata('referred_from', current_url());

        $this->data['page'] = 'Journal Entry';

        //$this->data['all_items'] = $this->Majorselects->all_items();

        $this->load->view('inc/admin_header', $this->data);
        $this->load->view('accounting/transfers', $this->data);
        $this->load->view('inc/footer');
    }

    public function accounts () {
        #$this->permission_check('accounts_view');
        $this->session->set_userdata('referred_from', current_url());

        $this->data['page'] = 'Accounts';

        $this->load->view('inc/admin_header', $this->data);
        $this->load->view('accounting/accounts', $this->data);
        $this->load->view('inc/footer');
    }

    public function add_transfer() {
        #$this->permission_check('accounts_add');
        $accountidcr = trim($_POST['account_idcr']);
        $accountiddr = trim($_POST['account_iddr']);
        $amount = trim($_POST['amount']);
        $fiscalyearid = trim($_POST['fiscal_year']);
        $other_reference = trim($_POST['reference']);
        $transaction_date = trim($_POST['transaction_date']);

        date_default_timezone_set('Africa/Nairobi');
        $reference = date('YmdHis');

        if(!isset($accountidcr) || !isset($accountiddr) || !isset($amount)) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning">Bad request!. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
            redirect('transfers/index');
        }
        if($accountidcr == $accountiddr){
            //cr & dr cannot be equal
            $this->session->set_flashdata('alert', '<div class="alert alert-warning">Failed!. The DR and CR account cannot be the same. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
            redirect('transfers/index');
        }
        // Get the account details for both the DR & CR accounts
        $acccr = $this->db->where('account_id',$accountidcr)->get('accounts')->row();
        $accdr = $this->db->where('account_id',$accountiddr)->get('accounts')->row();

        $insert_data = array(
            array(  //DR
                "org_id"=> $_SESSION['orgid'],
                "account_id"=> $accdr->account_id,
                "account_code"=> $accdr->account_code,
                "account_type_id"=> $accdr->account_type_id,
                "subaccount_type_id"=> $accdr->subaccount_type_id,
                "fiscal_year_id"=> $fiscalyearid,
                //"student_id"=> $student_id,            
                "voucher_code"=> $reference,
                "voucher_amount"=> $amount,
                "reference"=>$other_reference,
                "voucher_type"  => 'dr',
                "transaction_date"=> $transaction_date,
                "created_by"=> $_SESSION['userid'],
                "approved_by"=> '',
                "narrative"=> $_POST['narrative'],
            ),
            array(  //CR
                "org_id"=> $_SESSION['orgid'],
                "account_id"=> $acccr->account_id,
                "account_code"=> $acccr->account_code,
                "account_type_id"=> $acccr->account_type_id,
                "subaccount_type_id"=> $acccr->subaccount_type_id,
                "fiscal_year_id"=> $fiscalyearid,
                //"student_id"=> $student_id,            
                "voucher_code"=> $reference,
                "voucher_amount"=> $amount,
                "reference"=>$other_reference,
                "voucher_type"  => 'cr',
                "transaction_date"=> $transaction_date,
                "created_by"=> $_SESSION['userid'],
                "approved_by"=> '',
                "narrative"=> $_POST['narrative'],
            )
        );
        
        if($this->db->insert_batch('vouchers', $insert_data)) {
            // Log Some Trail Data
            $trail = array(
                'event_name' => "double_journal_entry",
                'operator' => $_SESSION['userid'],
                'username' => $_SESSION['username'],
                'computer' => '{"hostname" : "'.gethostname().'" , "os" : "'.php_uname().'" }',
                'source' => 'vouchers',
                'source_id' => $reference,
                'narrative' => json_encode($insert_data),
                'task' => json_encode($insert_data),
                "start_time" => date('Y-m-d H:m:s')
            );
            $this->db->insert('sys_logs', $trail);

            $this->session->set_flashdata('alert', '<div class="alert alert-success">Success! Journal entered. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
            redirect('transfers/index');
        } else {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Failed! Try again later. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
            redirect('transfers/index');
        }
    }

    public function add_posting() {
        #$this->permission_check('accounts_add');
        $accountid = trim($_POST['account_id']);
        $drcr = trim($_POST['drcr']);
        $amount = trim($_POST['amount']);
        $fiscalyearid = trim($_POST['fiscal_year']);
        $other_reference = trim($_POST['reference']);
        $opening = trim($_POST['opening']);
        $transaction_date = trim($_POST['transaction_date']);

        $opening_closing_balance = null;
        if($opening == 'obyes') {
            $opening_closing_balance = 1;
            $drcr = 'dr';
        }

        date_default_timezone_set('Africa/Nairobi');
        $reference = date('YmdHis');

        if(!isset($accountid) || !isset($drcr) || !isset($amount)) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning">Bad request!. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
            redirect('transfers/index');
        }
        $acc = $this->db->where('account_id',$accountid)->get('accounts')->row();
        // var_dump($_POST); exit();
        $insert_data = array(
            "org_id"=> $_SESSION['orgid'],
            "account_id"=> $acc->account_id,
            "account_code"=> $acc->account_code,
            "account_type_id"=> $acc->account_type_id,
            "subaccount_type_id"=> $acc->subaccount_type_id,
            "fiscal_year_id"=> $fiscalyearid,
            //"student_id"=> $student_id,            
            "voucher_code"=> $reference,
            "voucher_amount"=> $amount,
            "reference"=>$other_reference,
            "voucher_type"  => $drcr,
            "opening_closing_balance" => $opening_closing_balance,
            "transaction_date"=> $transaction_date,
            "created_by"=> $_SESSION['userid'],
            "approved_by"=> '',
            "narrative"=> $_POST['narrative'],
        );
        if($this->db->insert('vouchers', $insert_data)) {
            // Log Some Trail Data
            $trail = array(
                'event_name' => "single_journal_entry",
                'operator' => $_SESSION['userid'],
                'username' => $_SESSION['username'],
                'computer' => '{"hostname" : "'.gethostname().'" , "os" : "'.php_uname().'" }',
                'source' => 'vouchers',
                'source_id' => $this->db->insert_id(),
                'narrative' => json_encode($insert_data),
                'task' => json_encode($insert_data),
                "start_time" => date('Y-m-d H:m:s')
            );
            $this->db->insert('sys_logs', $trail);

            $this->session->set_flashdata('alert', '<div class="alert alert-success">Success! Journal entered. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
            redirect('transfers/index');
        } else {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Failed! Try again later. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
            redirect('transfers/index');
        }
    }

    public function add_bulk_posting() {
        #$this->permission_check('accounts_add');

        $mainData = array();
        $arrLength = COUNT($_POST['account_id']);
        $fiscalyearid = trim($_SESSION['fiscalyearid']);

        if($arrLength > 0) {
            
            for($lp = 0; $lp < $arrLength; $lp++) {

                // date_default_timezone_set('Africa/Nairobi');
                // $reference = date('YmdHis');
                $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $reference =  substr(str_shuffle($permitted_chars), 0, 10);

                $accountid = $_POST['account_id'][$lp];
                $drcr = $_POST['drcr'][$lp];
                $amount = $_POST['amount'][$lp];

                if(!isset($accountid) || !isset($drcr) || !isset($amount)) continue;

                $opening = trim($_POST['opening'][$lp]);
                $opening_closing_balance = null;
                if($opening == 'obyes') {
                    $opening_closing_balance = 1;
                    $drcr = 'dr';
                }

                // get account
                $acc = $this->db->where('account_id',$accountid)->get('accounts')->row();

                $innArr = array(
                    "org_id"=> $_SESSION['orgid'],
                    "account_id"=> $acc->account_id,
                    "account_code"=> $acc->account_code,
                    "account_type_id"=> $acc->account_type_id,
                    "subaccount_type_id"=> $acc->subaccount_type_id,
                    "fiscal_year_id"=> $fiscalyearid,         
                    "voucher_code"=> $reference,
                    "voucher_amount"=> $_POST['amount'][$lp],
                    "reference"=>$_POST['reference'][$lp],
                    "voucher_type"  => $drcr,
                    "opening_closing_balance" => $opening_closing_balance,
                    "transaction_date"=> $_POST['transaction_date'][$lp],
                    "created_by"=> $_SESSION['userid'],
                    "approved_by"=> '',
                    "narrative"=> $_POST['narrative'][$lp]
                );
                $mainData[] = $innArr;
            }

            if($this->db->insert_batch('vouchers', $mainData)) {
                // Log Some Trail Data
                $trail = array(
                    'event_name' => "single_journal_entry",
                    'operator' => $_SESSION['userid'],
                    'username' => $_SESSION['username'],
                    'computer' => '{"hostname" : "'.gethostname().'" , "os" : "'.php_uname().'" }',
                    'source' => 'vouchers',
                    'source_id' => $this->db->insert_id(),
                    'narrative' => json_encode($mainData),
                    'task' => json_encode($mainData),
                    "start_time" => date('Y-m-d H:m:s')
                );
                $this->db->insert('sys_logs', $trail);
    
                $this->session->set_flashdata('alert', '<div class="alert alert-success">Success! Journal entered. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
                redirect('transfers/index');
            } else {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger">Failed! Try again later. <span aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">&times;</span></div>');
                redirect('transfers/index');
            }
        } else {
            // no item to post
        }
            

    }





}



