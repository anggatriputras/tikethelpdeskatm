<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  MY_Controller  extends  CI_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    function _set_pagination()
    {
        if(lang_flex()=='') {
        $config['next_link'] = 'Selanjutnya &raquo;';
        } else {
        $config['next_link'] = 'Next &raquo;';    
        }
        if(lang_flex()=='') {
        $config['prev_link'] = '&laquo; Sebelumnya';
        } else {
        $config['prev_link'] = '&laquo; Prev';    
        }
        $config['next_tag_open'] = '<div>';
        $config['next_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div>';
        $config['prev_tag_close'] = '</div>';
        $config['full_tag_open'] = '<ul class="cd-pagination no-space custom-buttons">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<div>';
        $config['num_tag_close'] = '</div>';
        $config['first_tag_open'] = '<div>';
        $config['first_tag_close'] = '</div>';
        $config['last_tag_open'] = '<div>';
        $config['last_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<div class="button2"><a>';
        $config['cur_tag_close'] = '</a></div>';

        return $config;
    }

}