<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Backend_Core  extends  CI_Controller {

    var $_agent;
    var $_platform;
    var $_ip_address;
    var $_user_agent;

    function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
		
	$this->_set_agent();
        $this->_is_blocked();
    }

    function _set_agent()
    {
        if ($this->agent->is_browser())
        {
            $this->_agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
            $this->_agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
            $this->_agent = $this->agent->mobile();
        }
        else
        {
            $this->_agent = 'Unidentified User Agent';
        }

        $this->_platform = $this->agent->platform();
        $this->_ip_address =  $this->input->ip_address();
        $this->_user_agent =  $this->agent->agent_string();
    }

    function _is_logged_in()
    {
        if(!is_logged_in_en())
        {
            $url = cms_url().'login?url='.uri_string();
            $url .= empty($_SERVER['QUERY_STRING']) ? '' : '?'.$_SERVER['QUERY_STRING'];
            redirect($url);
            die();
        }
    }

    function _is_login()
    {
        if(is_logged_in_en())
        {
            $this->_redirect_home();
        }
    }

    function _is_blocked()
    {
        if(!is_logged_in_en())
        {
            $this->load->model(xml('cms_url').'blocked_mod');
            $row = $this->blocked_mod->get_byip($this->_ip_address);
            if($row){
                if($row->unlock_date >= date_now(true)){
                    $this->_redirect_blocked();
                }
            }
        }
    }

    function _redirect_home()
    {
        redirect(cms_url());
    }

    function _redirect_blocked()
    {
        redirect('blocked');
    }

    function _is_developer()
    {
        if(user_role_en() != xml('role_dev')){
            $this->_redirect_home();
        }
    }

    function _is_active_module($mod='news')
    {
        if(!xml('mod_'.$mod)){
            $this->_redirect_home();
        }
    }


    function _set_pagination()
    {
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="active">';
        $config['cur_tag_close'] = '</a></li>';

        return $config;
    }

    function img_upload($name,$file='file_upload')
    {
        $config['file_name']        = $name;
        $config['upload_path']      = xml('dir_media');
        $config['allowed_types']    = 'jpg|png|gif';
        $config['max_size']         = '5000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($file))
        {
            $err = str_replace('<p>','',$this->upload->display_errors());
            $err = str_replace('</p>','',$err);

            return array('status' => false ,'msg' => $err);
        }
        else
        {
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            $file_type = $data['file_type'];
            $file_size = $data['file_size'];

            $array = array(
                'status'	=> true,
                'msg'		=> '',
                'file_name'	=> $file_name,
                'file_type'	=> $file_type,
                'file_size'	=> $file_size
            );
            return $array;
        }
    }

    function _encode_password($string)
    {
        $string .= xml('en_encryption_key');
	// Return the SHA-1 encryption
        return sha1($string);
    }
}