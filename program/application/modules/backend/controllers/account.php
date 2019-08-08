<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class Account extends Backend_Core {

    function Account()
    {
        parent::__construct();
        $this->load->model('admin_mod');
    }

    public function index($id = 0)
    {
        $this->_is_logged_in();
        $this->_is_developer();

        $this->load->library('pagination');

        $config['base_url'] = cms_url().'account/index/';
        $config['total_rows'] = $this->admin_mod->get_admins(true);
        $config['per_page'] = 10;
        $config['cur_page'] = empty($id) ? 0 : $id;
        foreach ($this->_set_pagination() as $key=>$val){
            $config[$key] = $val;
        }
        $this->pagination->initialize($config);

        $skip = $config['cur_page'];
        $take = $config['per_page'];

        $data['pagination'] = $this->pagination->create_links();
        $data['rows'] = $this->admin_mod->get_admins(false,true,$skip,$take);
        $data['page'] = 'admin';
        $this->load->view('account',$data);
    }

    function add()
    {
        $this->_is_logged_in();
        $this->_is_developer();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[4]');
        $this->form_validation->set_rules('full_name', 'full name', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        $data["status"] = "";
        if ($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $full_name = $this->input->post("full_name");
            $role = $this->input->post("role");
            $address = $this->input->post("address");
            $birthday = $this->input->post("birthday");
            $phone = $this->input->post("phone");
            $email = $this->input->post("email");
            $kota = $this->input->post("kota");

            $is_user  = $this->admin_mod->get_byusername($username);

            //Jika email belum ada di database
            if(!$is_user)
            {
                $data_post = array (
                    'username' => $username,
                    'password' => $this->_encode_password($password),
                    'full_name' => $full_name,
                    'role' => $role,
                    'created' => date_now(true),
                    'is_lock' => 0,
                    'birthday' => $birthday,
                    'address' => $address,
                    'email' => $email,
                    'phone' => $phone,
                    'kota' => $kota,
                );

                $this->admin_mod->add($data_post);

                redirect(cms_url().'account');
            }
            else
            {
                $data["status"] = "username";
            }
        }
        $data['page'] = 'admin';
        $this->load->view('account_add',$data);
    }

    function edit($id=0)
    {
        $this->_is_logged_in();
        $this->_is_developer();

        $row = $this->admin_mod->get_byuid($id);
        if(!$row){
            redirect(cms_url().'account');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('full_name', 'full name', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        $data["status"] = "";
        if ($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $full_name = $this->input->post("full_name");
            $role = $this->input->post("role");
            $is_lock = $this->input->post("is_lock");
            $is_lock = ($is_lock == 'on') ? 1 : 0;
            $address = $this->input->post("address");
            $birthday = $this->input->post("birthday");
            $phone = $this->input->post("phone");
            $email = $this->input->post("email");
            $kota = $this->input->post("kota");

            $is_user = false;
            if($row->username != $username){
                $is_user  = $this->admin_mod->get_byusername($username);
            }

            //Jika email belum ada di database
            if(!$is_user)
            {
                $data_post = array (
                    'username' => $username,
                    'full_name' => $full_name,
                    'role' => $role,
                    'is_lock' => $is_lock,
                    'birthday' => $birthday,
                    'address' => $address,
                    'email' => $email,
                    'phone' => $phone,
                    'kota' => $kota,
                );

                if(!empty ($password)){
                    $data_post['password'] = $this->_encode_password($password);
                }

                $this->admin_mod->update($data_post, $row->id);

                redirect(cms_url().'account');
            }
            else
            {
                $data["status"] = "username";
            }
        }
        $data['row'] = $row;
        $data['page'] = 'admin';

        $this->load->view('account_edit',$data);
    }

    function delete($id=0)
    {
        $rows = $this->admin_mod->get_byuid($id);
        if($rows){
            $this->admin_mod->delete($id);
        }
        redirect(cms_url().'account');
    }

    function profile()
    {
        $this->_is_logged_in();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('full_name', 'full name', 'required');

        $data["status"] = "";
        if ($this->form_validation->run() == TRUE)
        {
            $password = $this->input->post("password");
            $full_name = $this->input->post("full_name");

            $address = $this->input->post("address");
            $birthday = $this->input->post("birthday");
            $phone = $this->input->post("phone");
            $email = $this->input->post("email");
            $kota = $this->input->post("kota");

            $data_post = array (
                'full_name' => $full_name,
                'address' => $address,
                'phone' => $phone,
                'email' => $email,
                'kota' => $kota,
                'birthday' => $birthday,
            );

            if(!empty ($password)){
                $data_post['password'] = $this->_encode_password($password);
            }

            $this->admin_mod->update($data_post, user_id_en());

            $data["status"] = "success";
        }
        $data['row'] = $this->admin_mod->get_byuid(user_id_en());

        $this->load->view('account_profile',$data);
    }
}
