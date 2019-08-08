<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH.'libraries/Backend_Core'.EXT);

class En_reports extends Backend_Core {

    function En_reports()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->config('reports');
        $this->load->model('reports_mod');
    }

    function index()
    {
        $where = null;
        $id = $this->input->get('per_page');
        $url = '?';


        // $dari = $this->input->get('dari');
        //     if($dari){
        //         $where = array('date' => date($dari));
        //         $url .="dari=".$dari;
        //     }
        //
        // $sampai = $this->input->get('sampai');
        //     if($sampai){
        //         $where = array('date' => $sampai);
        //         $url .="sampai=".$sampai;
        //     }
        $dari = $this->input->get('dari');
        $sampai = $this->input->get('sampai');
        $code = $this->input->get('code');
        $id_machine_atm = $this->input->get('id_machine_atm');
        $id_enginer = $this->input->get('id_enginer');
        $status = $this->input->get('status');

        if($code){
          $where = array("code_tiket" => $code);
          $url.="code_tiket=".$code;
        }

        if($status){
          $where = array("status" => $status);
          $url.="status=".$status;
        }

        if($id_machine_atm){
          $where = array("id_machine_atm" => $id_machine_atm);
          $url.="id_machine_atm=".$id_machine_atm;
        }

        if($id_enginer){
          $where = array("id_enginer" => $id_enginer);
          $url.="id_enginer=".$id_enginer;
        }

        if($status AND $id_machine_atm){
          $where = array("status" => $status, 'id_machine_atm' => $id_machine_atm);
          $url .="status=".$status.="id_machine_atm=".$id_machine_atm;
        }

        if($status AND $id_machine_atm AND $id_enginer){
          $where = array("status" => $status, 'id_machine_atm' => $id_machine_atm, 'id_enginer' => $id_enginer);
          $url .="status=".$status.="id_machine_atm=".$id_machine_atm.="id_enginer=".$id_enginer;
        }

        // if($dari OR $sampai OR $code OR $id_machine_atm OR $id_enginer OR $status ){
        //   $where = array("code_tiket" => $code, "id_machine_atm" => $id_machine_atm, "id_enginer" => $id_enginer, "status" => $status, 'date_proses >=' => $dari, 'date_proses <=' => $sampai);
        //   $url .="code=".$code.="machine_atm=".$id_machine_atm.="enginer=".$id_enginer.="status=".$status.="dari=".$dari."&sampai=".$sampai;
        // }

        $this->load->library('pagination');

        $config['base_url'] = cms_url(FALSE).'reports?';
        $config['total_rows'] = $this->reports_mod->get_reports(true,$where);
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
        $data['rows'] = $this->reports_mod->get_reports(false,$where,true,$skip,$take);
        $data['page'] = 'module';
        $data['enginers'] = $this->reports_mod->get_enginers();
        $data['machines'] = $this->reports_mod->get_machine_atm();
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $data['status'] = $this->input->get('status');
        $data['code'] = $this->input->get('code');
        $data['id_enginer'] = $this->input->get('id_enginer');
        $data['id_machine_atm'] = $this->input->get('id_machine_atm');
        $this->load->view('index',$data);
    }


}
