<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_mod extends CI_Model {

    function reports_mod()
    {
        parent::__construct();
    }

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('ds_workstations',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }

    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('ds_workstations', $data);
    }

    function get_reports($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        // $this->db->select("ds_workstations.*, ds_users.full_name,ds_users.username");
        $this->db->select("ds_workstations.*, ds_machine_atm.id_atm as machines_id, ds_machine_atm.id_company as id_company");
        $this->db->select("ds_workstations.*, ds_users.full_name as full_name, ds_users.username as nik");
        $this->db->order_by('created','desc');

        if($limit) {
            $this->db->limit($take,$skip);
        }

        if(!empty ($where)){
            if(count($where)){
                foreach ($where as $key=>$val){
                    if(!empty ($val)){
                        $this->db->where($key, mysql_real_escape_string($val));
                    }else{
                        $this->db->where($key, NULL, FALSE);
                    }
                }
            }
        }
        // $this->db->join('ds_users', 'ds_workstations.created_by = ds_users.id','left');
        // $this->db->where_in('is_reports', 1);
        $this->db->join('ds_machine_atm', 'ds_workstations.id_machine_atm = ds_machine_atm.id','left');
        $this->db->join('ds_users', 'ds_workstations.id_enginer = ds_users.id','left');
        $i = $this->db->get('ds_workstations');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }

    function get_enginers($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        // $this->db->select("ds_workstations.*, ds_users.full_name,ds_users.username");
        // $this->db->select("ds_workstations.*, ds_categories_services.slug as categories");
        $this->db->order_by('created','desc');

        if($limit) {
            $this->db->limit($take,$skip);
        }

        if(!empty ($where)){
            if(count($where)){
                foreach ($where as $key=>$val){
                    if(!empty ($val)){
                        $this->db->where($key, mysql_real_escape_string($val));
                    }else{
                        $this->db->where($key, NULL, FALSE);
                    }
                }
            }
        }
        // $this->db->join('ds_users', 'ds_workstations.created_by = ds_users.id','left');
        $this->db->where_in('role', 3); //get eginer
        // $this->db->join('ds_categories_services', 'ds_workstations.categories = ds_categories_services.id','left');
        $i = $this->db->get('ds_users');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }



    function get_machine_atm($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("ds_machine_atm.*, ds_users.full_name as name_company");
        $this->db->order_by('created','desc');

        if($limit) {
            $this->db->limit($take,$skip);
        }

        if(!empty ($where)){
            if(count($where)){
                foreach ($where as $key=>$val){
                    if(!empty ($val)){
                        $this->db->where($key, mysql_real_escape_string($val));
                    }else{
                        $this->db->where($key, NULL, FALSE);
                    }
                }
            }
        }
        $this->db->join('ds_users', 'ds_machine_atm.id_company = ds_users.id','left');
        $i = $this->db->get('ds_machine_atm');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }

    function get($id=0)
    {
        $this->db->select('*');
        $this->db->where('id', mysql_real_escape_string($id));
        $i = $this->db->get('ds_workstations', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function delete($id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->delete('ds_workstations');
    }
    function get_categories_services()
    {
        $this->db->order_by('created','desc');

        $i = $this->db->get('ds_categories_services');

        return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;

    }

    function get_company_by_id($id=0)
    {
        $this->db->select('*');
        $this->db->where('id', mysql_real_escape_string($id));
        // $this->db->where('role', 3);
        $i = $this->db->get('ds_users', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }
}
