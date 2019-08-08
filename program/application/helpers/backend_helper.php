<?php

/*
 * BEGIN Backend System
 * Jika root = true maka mengarah ke contoller backend / home
 */
if(!function_exists("cms_url"))
{
    function cms_url($root=true)
    {
        if($root)
            return base_url(). link_index().  xml('cms_url');
        else
            return base_url(). link_index().'en_';
    }
}

/*
 * @funtion set session
 * Untuk memasukan session, setiap key session ditambahkan "prefix"
 * Ini khusus untuk backend
 */
if(!function_exists("set_session"))
{
    function set_session($data = null)
    {
        $CI =& get_instance();
        $data_array = array();
        if(!empty ($data)){
           foreach ($data as $key=>$val){
               $data_array[xml('en_cookie_prefix').$key] = $val;
           }
        }
        $CI->session->set_userdata($data_array);
    }
}

if(!function_exists("unset_session"))
{
    function unset_session($data = null)
    {
        $CI =& get_instance();
        $data_array = array();
        if(!empty ($data)){
           foreach ($data as $key=>$val){
               $data_array[xml('en_cookie_prefix').$key] = $val;
           }
        }
        $CI->session->unset_userdata($data_array);
    }
}

/*
 * @function get session
 */
if(!function_exists("get_session"))
{
    function get_session($key = 'en_')
    {
        $CI =& get_instance();
        $val = $CI->session->userdata(xml('en_cookie_prefix').$key);

        return $v = isset($val) ? $val : false;
    }
}

if(!function_exists("is_logged_in_en"))
{
    function is_logged_in_en()
    {
        $is_logged_in = get_session('is_logged_in');

        return $v = ($is_logged_in) ? $is_logged_in : false;
    }
}

if(!function_exists("user_id_en"))
{
    function user_id_en()
    {
        $user_id = get_session('user_id');

        return $v = ($user_id) ? $user_id : 0;
    }
}

if(!function_exists("username_en"))
{
    function username_en()
    {
        $username = get_session('username');

        return $v = ($username) ? $username : "";
    }
}

if(!function_exists("lastlogin_en"))
{
    function lastlogin_en()
    {
        $lastlogin = get_session('lastlogin');

        return $v = ($lastlogin) ? format_date($lastlogin,'F d, Y H:i:s') : "";
    }
}

if(!function_exists("full_name_en"))
{
    function full_name_en()
    {
        $full = get_session('full_name');

        return $v = ($full) ? $full : "";
    }
}

if(!function_exists('user_role_en'))
{
    function user_role_en()
    {
        $role = get_session('role');

        return $v = ($role) ? $role : 0;
    }
}


/*
 * @untuk form login (variable post)
 */
if(!function_exists("form_username_en"))
{
    function form_username_en()
    {
        $CI =& get_instance();

        $ip = $CI->input->ip_address();
        $username = get_session('form_username');

        if(!$username)
        {
            $username = md5($ip . time() . '_username');
            $newdata = array('form_username'  => $username);
            set_session($newdata);
        }

        return $username;
    }
}

if(!function_exists("form_password_en"))
{
    function form_password_en()
    {
        $CI =& get_instance();

        $ip = $CI->input->ip_address();
        $password = get_session('form_password');

        if(!$password)
        {
            $password = md5($ip . time() . '_password');
            $newdata = array('form_password'  => $password);
            set_session($newdata);
        }

        return $password;
    }
}

if(!function_exists("set_src_img"))
{
    function set_src_img($val = null)
    {
        $sorce_url = base_url();
        if(!empty ($val)){
            $val = str_replace('src="../../../../../', 'src="'.$sorce_url, $val);
            $val = str_replace('src="../../../../', 'src="'.$sorce_url, $val);
            $val = str_replace('src="../../../', 'src="'.$sorce_url, $val);
            $val = str_replace('src="../../', 'src="'.$sorce_url, $val);
            $val = str_replace('src="../', 'src="'.$sorce_url, $val);
            $val = str_replace('src="clients/', 'src="'.$sorce_url."clients/", $val);
        }

        return $val;
    }
}

if(!function_exists("is_two_language"))
{
    function is_two_language()
    {
        return $val = (setting('is_two_language')) ? TRUE : FALSE;
    }
}

if(!function_exists("menu_modules"))
{
    function menu_modules()
    {
        $menu = '';
        $filename = setting('xml_modules');
        $xml = simplexml_load_string($filename);
        $p_cnt = count($xml->module);
        if($p_cnt > 0){
            $menu = '<ul class="dropdown-menu">';
            for($i = 0; $i < $p_cnt; $i++) {
                $name = $xml->module[$i]->name;
                $desc = $xml->module[$i]->desc;
                $sub = $xml->module[$i]->sub;
                $icon = $xml->module[$i]->icon;
                if($sub =='yes'){
                    $menu .= '
                            <li class="dropdown-submenu"><a href="'.cms_url(FALSE).$name.'"><span class="'.$icon.'"></span> '.$desc.'</a>
                                <ul class="dropdown-menu">
                                    <li><a href="'.cms_url(FALSE).$name.'"><span class="icon-list"></span> List '.strtolower($desc).'</a></li>
                                    <li><a href="'.cms_url(FALSE).$name.'/add"><span class="icon-plus"></span> Add '.strtolower($desc).'</a></li>
                                </ul>
                            </li>';
                }else{
                    $menu .='<li><a href="'.cms_url(FALSE).$name.'"><span class="'.$icon.'"></span> '.$desc.'</a></li>';
                }
            }
            $menu .= '</ul>';
        }
        return $menu;
    }
}

if(!function_exists("create_folder"))
{
    function create_folder($path=false,$path_thumbs=false)
    {
        $oldumask = umask(0); 
        if ($path && !file_exists($path))
                mkdir($path, 0777); // or even 01777 so you get the sticky bit set 
        if($path_thumbs && !file_exists($path_thumbs)) 
                mkdir($path_thumbs, 0777); // or even 01777 so you get the sticky bit set 
        umask($oldumask);
    }
}

if(!function_exists("create_folder_upload"))
{
    function create_folder_upload($path=false)
    {
        $dir_client = xml('dir_client');
        if($path && !file_exists($path)){
            create_folder($dir_client,  $path);
            copy($dir_client."index.html", $path."index.html");
            copy($dir_client."index.php", $path."index.php");
        }
    }
}
/*
 * END Backend System
 */