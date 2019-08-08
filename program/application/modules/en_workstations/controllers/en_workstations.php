<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class En_workstations extends Backend_Core {

    function En_workstations()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->config('workstations');
        $this->load->model('workstations_mod');
    }

    function index()
    {
        $where = null;
        $id = $this->input->get('per_page');
        $url = '?';

        $code = $this->input->get('code');

        if($code){
          $where = array("code_tiket" => $code);
          $url.="code_tiket=".$code;
        }

        $this->load->library('pagination');

        $config['base_url'] = cms_url(FALSE).'workstations?';
        $config['total_rows'] = $this->workstations_mod->get_workstations(true,$where);
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
        $data['rows'] = $this->workstations_mod->get_workstations(false,$where,true,$skip,$take);
        $data['page'] = 'module';

        $this->load->view('index',$data);
    }

    function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('id_enginer', 'ID company', 'required');
        $this->form_validation->set_rules('id_machine_atm', 'ID Machine atm', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $id_enginer = $this->input->post("id_enginer");
            $id_machnine_atm = $this->input->post('id_machine_atm');
            $keluhan = $this->input->post('keluhan');
            $code_tiket = "CM".format_date(date_now(true),'Ymdhis');

            $add_data = array(
                'code_tiket' => $code_tiket,
                'id_enginer' => $id_enginer,
                'id_machine_atm' => $id_machnine_atm,
                'status' => "pending",
                'keluhan' => $keluhan,
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
            $this->workstations_mod->add($add_data);
            redirect(cms_url(FALSE).'workstations');
        }
        $data['page'] = 'module';
        $data['enginers'] = $this->workstations_mod->get_enginers();
        $data['machines'] = $this->workstations_mod->get_machine_atm();
        $this->load->view('new',$data);
    }

    function edit($id=0)
    {
        $row = $this->workstations_mod->get($id);
        if(!$row){
            redirect(cms_url(FALSE).'workstations');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');


        if ($this->form_validation->run() == TRUE)
        {
          $keterangan = $this->input->post("keterangan");
          $id_machine_atm = $this->input->post("id_machine_atm");
          $id_enginer = $this->input->post("id_enginer");
          // $content = $this->input->post("content");
          // // $demo = $this->input->post("demo");
          // $sort = $this->input->post('sort');
          // $is_active = $this->input->post("is_active");
          // $is_active = ($is_active == 'on') ? 1 : 0;

            $update_data = array(
              'id_machine_atm' => $id_machine_atm,
              'id_enginer' => $id_enginer,
              'keterangan' => $keterangan,
              'status' => "completed",
              'end_date' => date_now(true),
              // 'created_by' => user_id_en()
            );

            $is_upload = true;
            $status_upload = false;
            if(!empty($_FILES["file_upload"]["tmp_name"]))
            {
                $file = $this->upload();
                if($file['status'])
                {
                    $update_data['image'] = $file['file_name'];

                    //$is_upload = true;
                }
                $is_upload = $file['status'];
                $status_upload = $file['status'];
                $data['error'] = $file['msg'];
            }

            if(!empty($_FILES["file_upload2"]["tmp_name"]))
            {
                $file2 = $this->upload2();
                if($file2['status'])
                {
                    $update_data['thumbnail'] = $file2['file_name'];

                    //$is_upload = true;
                }
                $is_upload = $file2['status'];
                $status_upload = $file2['status'];
                $data['error'] = $file2['msg'];
            }


            if(!empty($_FILES["file_upload3"]["tmp_name"]))
            {
                $file3 = $this->upload3();
                if($file3['status'])
                {
                    $update_data['banner'] = $file3['file_name'];

                }
                $is_upload = $file3['status'];
                $status_upload = $file3['status'];
                $data['error'] = $file3['msg'];
            }

            // if($is_upload)
            // {
            //
            //     $this->workstations_mod->update($update_data,$row->id);
            //     redirect(cms_url(FALSE).'workstations');
            // }

            $this->workstations_mod->update($update_data,$row->id);
            redirect(cms_url(FALSE).'workstations');

            // if($status)
            // {
            //     $this->workstations_mod->update($update_data,$row->id);
            //     if($is_upload){
            //         if(!empty ($row->file_name)){
            //             $path = xml('dir_workstations').$row->file_name;
            //             unlink($path);
            //         }
            //     }
            //     redirect(cms_url(FALSE).'workstations');
            // }
        }
        $data['row'] = $row;
        $data['page'] = 'module';
        $data['enginers'] = $this->workstations_mod->get_enginers();
        $data['machines'] = $this->workstations_mod->get_machine_atm();
        $this->load->view('edit',$data);
    }

    function delete()
    {
        $id = $this->input->get('id');
        if($id){
            $rows = $this->workstations_mod->get_workstations(false,array('ds_workstations.id in ('.$id.')' => NULL));
            if($rows){
                foreach ($rows as $r)
                {
                    if(!empty ($r['image'])){
                        $path = xml('dir_workstations').$r['image'];
                        if(file_exists($path))
                            unlink($path);
                    }
                    $this->workstations_mod->delete($r['id']);
                }
            }
        }
        redirect(cms_url(FALSE).'workstations');
    }


    function working($id)
    {
      $row = $this->workstations_mod->get($id);
      if(!$row){
          redirect(cms_url(FALSE).'workstations');
      }

      $update_data = array(
        'status' => "in progress",
        'start_date' => date_now(true),
        'date_proses' => date_now(true),
      );

      $this->workstations_mod->update($update_data,$row->id);
      redirect(cms_url(FALSE).'workstations');
    }

    function done($id)
    {
      $row = $this->workstations_mod->get($id);
      if(!$row){
          redirect(cms_url(FALSE).'workstations');
      }

      $update_data = array(
        'status' => "completed",
        'end_date' => date_now(true),
      );

      $this->workstations_mod->update($update_data,$row->id);
      redirect(cms_url(FALSE).'workstations');
    }

    private function upload()
    {
        $path =  xml('dir_workstations');
        create_folder_upload($path);//Create folder jika belum ada

        $config['file_name']          = 'icon_'.time();
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
        $path =  xml('dir_workstations');
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
        $path =  xml('dir_workstations');
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
