<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class En_machine_atm extends Backend_Core {

    function En_machine_atm()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->config('machine_atm');
        $this->load->model('machine_atm_mod');
    }

    function index()
    {
        $where = null;
        $id = $this->input->get('per_page');
        $url = '?';



        $id_atm = $this->input->get('id_atm');
        if($id_atm){
          $where = array("id_atm" => $id_atm);
          $url.="id_atm=".$id_atm;
        }

        $this->load->library('pagination');

        $config['base_url'] = cms_url(FALSE).'machine_atm?';
        $config['total_rows'] = $this->machine_atm_mod->get_machine_atm(true,$where);
        $config['per_page'] = 10;
        $config['cur_page'] = empty($id) ? 0 : $id;
        $config['page_query_string'] = TRUE;
        foreach ($this->_set_pagination() as $key=>$val){
            $config[$key] = $val;
        }
        $this->pagination->initialize($config);

        $skip = $config['cur_page'];
        $take = $config['per_page'];

        $data['pagination'] = $this->pagination->create_links();
        $data['rows'] = $this->machine_atm_mod->get_machine_atm(false,$where,true,$skip,$take);
        $data['page'] = 'module';
        $data['id_atm'] = $id_atm;

        $this->load->view('index',$data);
    }

    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('id_atm', 'ID ATM', 'required');


        if ($this->form_validation->run() == TRUE)
        {
            $id_atm = $this->input->post("id_atm");
            $sn_atm = $this->input->post("sn_atm");
            $jam_operational = $this->input->post("jam_operational");
            $type_atm = $this->input->post("type_atm");
            $lokasi = $this->input->post("lokasi");
            $id_company = $this->input->post("id_company");
            $kota = $this->input->post("kota");

            $is_active = $this->input->post("is_active");
            $is_active = ($is_active == 'on') ? 1 : 0;

            $add_data = array(
                'id_atm' => $id_atm,
                'sn_atm' => $sn_atm,
                'jam_operational' => $jam_operational,
                'type_atm' => $type_atm,
                'lokasi' => $lokasi,
                'kota' => $kota,
                'is_active' => $is_active,
                'id_company' => $id_company,
                'created' => date_now(true),
            );

            $file = $this->upload();
            if($file['status'])
            {
              $add_data['icon'] = $file['file_name'];
            }
            $data['error'] = $file['msg'];

            if(!empty($_FILES["file_upload2"]["tmp_name"]))
            {
                $file2 = $this->upload2();
                if($file2['status'])
                {
                  $add_data['thumbnail'] = $file2['file_name'];
                }
                $data['error'] = $file2['msg'];
            }

            if(!empty($_FILES["file_upload3"]["tmp_name"]))
            {
                $file3 = $this->upload3();
                if($file3['status'])
                {
                  $add_data['banner'] = $file3['file_name'];
                }
                $data['error'] = $file3['msg'];
            }

            // print_r($add_data);
            $this->machine_atm_mod->add($add_data);
            redirect(cms_url(FALSE).'machine_atm');
        }
        $data['page'] = 'module';
        $data['company'] = $this->machine_atm_mod->get_company();
        // $tmp_arr = $this->machine_atm_mod->get_machine_atm();
        // $data['length'] = count($tmp_arr) + 1;
        $this->load->view('new',$data);
    }

    function edit($id=0)
    {
        $row = $this->machine_atm_mod->get($id);
        if(!$row){
            redirect(cms_url(FALSE).'machine_atm');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('id_atm', 'ID ATM', 'required');

        if ($this->form_validation->run() == TRUE)
        {
          $id_atm = $this->input->post("id_atm");
          $sn_atm = $this->input->post("sn_atm");
          $jam_operational = $this->input->post("jam_operational");
          $type_atm = $this->input->post("type_atm");
          $lokasi = $this->input->post("lokasi");
          $id_company = $this->input->post("id_company");
          $kota = $this->input->post("kota");

          $is_active = $this->input->post("is_active");
          $is_active = ($is_active == 'on') ? 1 : 0;


            $update_data = array(
              'id_atm' => $id_atm,
              'sn_atm' => $sn_atm,
              'jam_operational' => $jam_operational,
              'type_atm' => $type_atm,
              'lokasi' => $lokasi,
              'kota' => $kota,
              'is_active' => $is_active,
              'id_company' => $id_company,
              'created' => date_now(true),
            );

            $is_upload = true;
            $status_upload = false;


            $this->machine_atm_mod->update($update_data,$row->id);
            redirect(cms_url(FALSE).'machine_atm');

        }
        $data['row'] = $row;
        $data['page'] = 'module';
        $data['company'] = $this->machine_atm_mod->get_company();
        $this->load->view('edit',$data);
    }

    function delete()
    {
        $id = $this->input->get('id');
        if($id){
            $rows = $this->machine_atm_mod->get_machine_atm(false,array('ds_machine_atm.id in ('.$id.')' => NULL));
            if($rows){
                foreach ($rows as $r)
                {
                    if(!empty ($r['icon'])){
                        $path = xml('dir_machine_atm').$r['icon'];
                        if(file_exists($path))
                            unlink($path);
                    }

                    if(!empty ($r['thumbnail'])){
                        $path = xml('dir_machine_atm').$r['thumbnail'];
                        if(file_exists($path))
                            unlink($path);
                    }

                    if(!empty ($r['banner'])){
                        $path = xml('dir_machine_atm').$r['banner'];
                        if(file_exists($path))
                            unlink($path);
                    }
                    $this->machine_atm_mod->delete($r['id']);
                }
            }
        }
        redirect(cms_url(FALSE).'machine_atm');
    }


    function publish($id)
    {
      $row = $this->machine_atm_mod->get($id);
      if(!$row){
          redirect(cms_url(FALSE).'machine_atm');
      }

      $update_data = array(
        'is_active' => 1,
      );

      $this->machine_atm_mod->update($update_data,$row->id);
      redirect(cms_url(FALSE).'machine_atm');
    }

    private function upload()
    {
        $path =  xml('dir_machine_atm');
        create_folder_upload($path);//Create folder jika belum ada

        $config['file_name']          = 'machine_atm_'.time();
        $config['upload_path']       = $path;
        $config['allowed_types']    = 'jpg|png|gif';
        $config['max_size']            = '2500';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_upload'))
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

    private function upload2()
    {
        $path =  xml('dir_machine_atm');
        create_folder_upload($path);//Create folder jika belum ada

        $config['file_name']          = 'thumbnail_'.time();
        $config['upload_path']       = $path;
        $config['allowed_types']    = 'jpg|png|gif';
        $config['max_size']            = '2500';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_upload2'))
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

    private function upload3()
    {
        $path =  xml('dir_machine_atm');
        create_folder_upload($path);//Create folder jika belum ada

        $config['file_name']          = 'banner_'.time();
        $config['upload_path']       = $path;
        $config['allowed_types']    = 'jpg|png|gif';
        $config['max_size']            = '2500';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_upload3'))
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
}
