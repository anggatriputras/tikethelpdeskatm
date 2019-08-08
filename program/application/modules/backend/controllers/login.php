<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class Login extends Backend_Core {

    function Login()
    {
        parent::__construct();
        
        $this->_is_login();
        $this->load->model('admin_mod');
    }
	
    function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules(form_username_en(), 'username', 'trim|required');
        $this->form_validation->set_rules(form_password_en(), 'password', 'required');
        $data["msg"] = "";

        if ($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post(form_username_en());
            $pass = $this->input->post(form_password_en());

            $user = $this->admin_mod->get_bylogin($username,$this->_encode_password($pass));

            if($user)
            {
                if($user->is_lock == 0)
                {
                    $data_session = array(
                            'username' => $user->username,
                            'user_id' => $user->id,
                            'full_name' => $user->full_name,
                            'lastlogin' => $user->last_loggedin_date,
                            'role' => $user->role,
                            'is_logged_in' => true
                    );
                    set_session($data_session);

                    $url = $this->input->get("url");
                    if(!empty ($url)){
                        redirect($url);
                    }
                    else{
                        $this->_redirect_home();
                    }
                }
                $data["msg"] = "Akun anda saat ini sedang dalam masalah.";
            }else{
                $data["msg"] = "Username atau password anda salah";
            }

            $count_login = get_session('blocked_sessions') + 1;
            if($count_login >= xml('max_login'))
            {
                $this->load->model(xml('cms_url').'blocked_mod');

                $seconds = 60*60* xml('en_hours');
                $unlock_date = date('Y-m-d H:i:s', time() + $seconds);

                $post_data = array(
                    "username" => $username,
                    "password" => $pass
                );
                $add_data = array(
                    'ip_address' => $this->_ip_address,
                    'user_agent' => $this->_user_agent,
                    'post_data' => json_encode($post_data),
                    'agent' => $this->_agent,
                    'created' => date_now(true),
                    'platform' => $this->_platform,
                    'unlock_date' => $unlock_date,
                    'is_deleted' => 0
                );

                $is_id = $this->blocked_mod->add($add_data);
                if($is_id){
                    $en_session = array(
                        'blocked_sessions' => 0
                    );
                    set_session($en_session);
                    redirect($this->_redirect_blocked());
                }
            }
            else{
                $en_session = array(
                    'blocked_sessions' => $count_login
                );
                set_session($en_session);
            }
        }

        $this->load->view('login',$data);
    }
}