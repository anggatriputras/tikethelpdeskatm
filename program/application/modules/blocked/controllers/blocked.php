<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocked extends CI_Controller {

    function Blocked()
    {
        parent::__construct();
        
        $this->load->model(xml('cms_url').'blocked_mod');
    }
    
    function index()
    {
        $row = $this->blocked_mod->get_byip($this->input->ip_address());
        if($row){
            if($row->unlock_date <= date_now(true)){
                redirect(cms_url());
            }
            show_error('Anda bisa login kembali '. xml('en_hours') .' jam kemudian.!');
        }
        else{
            redirect(base_url());
        }
    }
}