<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Machine_atm_mod extends CI_Model {

    function machine_atm_mod()
    {
        parent::__construct();
    }

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('ds_machine_atm',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }

    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('ds_machine_atm', $data);
    }

    function get_machine_atm($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        // $this->db->select("ds_machine_atm.*, ds_users.full_name,ds_users.username");
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
        // $this->db->join('ds_users', 'ds_machine_atm.created_by = ds_users.id','left');
        if(user_role_en() == xml('role_com')){
          $this->db->where_in('id_company', user_id_en());
        }

        $this->db->join('ds_users', 'ds_machine_atm.id_company = ds_users.id','left');
        $i = $this->db->get('ds_machine_atm');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }


    function get_machine($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        // $this->db->select("ds_machine_atm.*, ds_users.full_name,ds_users.username");
        // $this->db->select("ds_machine_atm.*, ds_users.full_name as name_company");
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
        // $this->db->join('ds_users', 'ds_machine_atm.created_by = ds_users.id','left');
        // $this->db->where_in('is_active', 0);
        // $this->db->join('ds_users', 'ds_machine_atm.id_company = ds_users.id','left');
        $i = $this->db->get('ds_machine_atm');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }


    function get_company($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
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
        $this->db->where_in('role', 2);
        $i = $this->db->get('ds_users');

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
        $i = $this->db->get('ds_machine_atm', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function delete($id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->delete('ds_machine_atm');
    }

    function get_categories_machine_atm()
    {
        $this->db->order_by('created','desc');

        $i = $this->db->get('ds_categories_machine_atm');

        return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;

    }

    function get_categories_by_id($id=0)
    {
        $this->db->select('*');
        $this->db->where('id', mysql_real_escape_string($id));
        $i = $this->db->get('ds_categories_machine_atm', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }
}
