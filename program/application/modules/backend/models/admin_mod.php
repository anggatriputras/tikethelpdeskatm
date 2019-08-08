<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_mod extends CI_Model {

    function admin_mod()
    {
        parent::__construct();
    }

    function get_byuid($user_id = 0)
    {
        $this->db->select('*');
        $this->db->where('id', mysql_real_escape_string($user_id));
        
        $i = $this->db->get('ds_users', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function get_byusername($username = 0)
    {
        $this->db->select('*');
        $this->db->where('username', mysql_real_escape_string($username));

        $i = $this->db->get('ds_users', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('ds_users',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }

    function get_bylogin($username = null,$pass = null)
    {
        $this->db->select('*');
        $this->db->where('username', mysql_real_escape_string($username));
        $this->db->where('password', mysql_real_escape_string($pass));
        $i = $this->db->get('ds_users', 1, 0);

        $var = ($i->num_rows() > 0) ? $i->row() : false;
        if($var){
            $data = array(
                'last_loggedin_date' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $var->id);
            $this->db->update('ds_users', $data);
        }

        return $var;
    }

    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('ds_users', $data);
    }

    function get_admins($rows=false,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("*");
        $this->db->order_by('id','asc');

        if($limit) {
            $this->db->limit($take,$skip);
        }

        $i = $this->db->get('ds_users');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
    
    function delete($id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->delete('ds_users');
    }
}