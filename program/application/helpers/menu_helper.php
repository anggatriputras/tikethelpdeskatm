<?php

if(!function_exists("get_company"))
{
    function  get_company($id)
    {
    	$CI =& get_instance();
        $CI->load->model('services_mod');

        $value = $CI->services_mod->get_services_by_id($id);
        return $value;
    }
}

// Ambil Semua Data

// if(!function_exists("get_menu_all"))
//
// {
//
//     function get_menu_all()
//
//     {
//
//     	$CI =& get_instance();
//
//         $CI->load->model('menu_mod');
//
//
//
//         $value = $CI->menu_mod->get_menu_all();
//
//         return $value;
//
//     }
//
// }
//
// if(!function_exists("get_menu_nav_komersial"))
//
// {
//
//     function get_menu_nav_komersial()
//
//     {
//
//     	$CI =& get_instance();
//
//         $CI->load->model('menu_mod');
//
//
//
//         $value = $CI->menu_mod->get_menu_nav_komersial();
//
//         return $value;
//
//     }
//
// }
//
//
// if(!function_exists("get_title_menu"))
//
// {
//
//     function get_title_menu($id)
//
//     {
//
//     	$CI =& get_instance();
//
//         $CI->load->model('menu_mod');
//
//
//
//         $value = $CI->menu_mod->get_title_menu($id);
//
//         return $value;
//
//     }
//
// }
//
// if(!function_exists("get_menu_tentang_kbp"))
//
// {
//
//     function get_menu_tentang_kbp()
//
//     {
//
//     	$CI =& get_instance();
//
//         $CI->load->model('menu_mod');
//
//
//
//         $value = $CI->menu_mod->get_menu_tentang_kbp();
//
//         return $value;
//
//     }
//
// }
//
//
//
// if(!function_exists("get_menu_hunian"))
//
// {
//
//     function get_menu_hunian()
//
//     {
//
//     	$CI =& get_instance();
//
//         $CI->load->model('menu_mod');
//
//
//
//         $value = $CI->menu_mod->get_menu_hunian();
//
//         return $value;
//
//     }
//
// }
//
//
//
// if(!function_exists("get_menu_sub_hunian"))
//
// {
//
//     function get_menu_sub_hunian($id)
//
//     {
//
//     	$CI =& get_instance();
//
//         $CI->load->model('menu_mod');
//
//
//
//         $value = $CI->menu_mod->get_menu_sub_hunian($id);
//
//         return $value;
//
//     }
//
// }
//
//
//
// if(!function_exists("get_gallery"))
// {
//     function get_gallery($id)
//     {
//     	$CI =& get_instance();
//         $CI->load->model('menu_mod');
//
//         $value = $CI->menu_mod->get_gallery($id);
//         return $value;
//     }
// }
//
// if(!function_exists("get_hunian_gallery"))
// {
//     function get_hunian_gallery($id)
//     {
//     	$CI =& get_instance();
//         $CI->load->model('menu_mod');
//
//         $value = $CI->menu_mod->get_hunian_gallery($id);
//         return $value;
//     }
// }
//
// if(!function_exists("get_menu_komersial"))
// {
//     function get_menu_komersial()
//     {
//     	$CI =& get_instance();
//         $CI->load->model('menu_mod');
//
//         $value = $CI->menu_mod->get_menu_komersial();
//         return $value;
//     }
// }
//
// if(!function_exists("get_submenu_komersial"))
// {
//     function get_submenu_komersial($id)
//     {
//     	$CI =& get_instance();
//         $CI->load->model('menu_mod');
//
//         $value = $CI->menu_mod->get_submenu_komersial($id);
//         return $value;
//     }
// }
//
// if(!function_exists("get_sub_proyek"))
// {
//
//     function get_sub_proyek($id)
//     {
//     	$CI =& get_instance();
//         $CI->load->model('menu_mod');
//
//         $value = $CI->menu_mod->get_sub_proyek($id);
//         return $value;
//     }
// }
// if(!function_exists("get_sub_proyek_slider"))
// {
//
//     function get_sub_proyek_slider($id,$limit=1)
//     {
//     	$CI =& get_instance();
//         $CI->load->model('menu_mod');
//
//         $value = $CI->menu_mod->get_sub_proyek_slider($id,$limit=1);
//         return $value;
//     }
// }
//
// if(!function_exists("get_kawasan_by_id"))
// {
//     function get_kawasan_by_id($id)
//     {
//     	$CI =& get_instance();
//         $CI->load->model('menu_mod');
//
//         $value = $CI->menu_mod->get_kawasan_by_id($id);
//         return $value;
//     }
// }
