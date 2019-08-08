<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class Ip extends Backend_Core {

    function Ip()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->model('blocked_mod');
    }

    function index($id=0)
    {
        $this->_is_developer();

        $this->load->library('pagination');

        $config['base_url'] = cms_url().'ip/index/';
        $config['total_rows'] = $this->blocked_mod->get_blocked(true);
        $config['per_page'] = 10;
        $config['cur_page'] = empty($id) ? 0 : $id;
		
        foreach ($this->_set_pagination() as $key=>$val){
            $config[$key] = $val;
        }

        $this->pagination->initialize($config);

        $skip = $config['cur_page'];
        $take = $config['per_page'];

        $data['pagination'] = $this->pagination->create_links();
        $data['rows'] = $this->blocked_mod->get_blocked(false,true,$skip,$take);
        $data['page'] = 'admin';

        $this->load->view('ip',$data);
    }

    function delete($id =0)
    {
        $this->_is_developer();

        $data_update = array('is_deleted' => 1);
        $this->blocked_mod->update($data_update,$id);

        redirect($this->input->get('url'));
    }

    function add()
    {
        $this->_is_developer();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
        $this->form_validation->set_rules('ip_address', 'ip address', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $ip_address = $this->input->post("ip_address");
            $seconds = 60*60* xml('en_hours');
            $unlock_date = date('Y-m-d H:i:s', time() + $seconds);

            $add_data = array(
                'ip_address' => $ip_address,
                'user_agent' => $this->_user_agent,
                'post_data' => 'backend post',
                'agent' => $this->_agent,
                'created' => date_now(true),
                'platform' => $this->_platform,
                'unlock_date' => $unlock_date,
                'is_deleted' => 0
            );

            $is_id = $this->blocked_mod->add($add_data);
            if($is_id){
                redirect(cms_url().'ip');
            }
        }
        $data['page'] = 'admin';
        $this->load->view('ip_add',$data);
    }

}