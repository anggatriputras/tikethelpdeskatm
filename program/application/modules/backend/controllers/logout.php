<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class Logout extends Backend_Core {

    function Logout()
    {
        parent::__construct();
    }

    function index()
    {
        $this->_is_logged_in();

        $data_session = array(
            'username' => '',
            'user_id' => 0,
            'full_name' => '',
            'lastlogin' => '',
            'role' => '',
            'is_logged_in' => false
        );
        unset_session($data_session); //Unset SESSION DATA
        redirect(cms_url());
    }
}