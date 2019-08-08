<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class backend extends Backend_Core {

    function backend()
    {
        parent::__construct();

        $this->_is_logged_in();
    }

    function index()
    {

      $this->load->view('dashboard');
    }
}
