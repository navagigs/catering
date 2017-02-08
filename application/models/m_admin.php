<?php
class M_admin extends CI_Model {
	
	function __contsruct(){
		parent::Model();
	}
	
	function cek_login($where){
		$data = "";
		$this->db->select("*");
		$this->db->from("admin");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0) {
			$data = $Q->row();
			$this->set_session($data);
			return true;
		}
		return false;
	}
	
	function set_session(&$data){
		$session = array(
					'admin_id' 	   => $data->admin_id,
					'admin_username' 	=> $data->admin_username,
					'admin_password' 	=> $data->admin_password,
					'admin_nama' 	=> $data->admin_nama,
					'logged_in'		=> TRUE
					);
		$this->session->set_userdata($session);
	}
	
	function update_log($where){
		$where['admin_id'] = $data->admin_id;
		$where['admin_user'] = $data->admin_user;
		$where['admin_nama'] = $data->admin_nama;
		$data['admin_ip']	 = $_SERVER['REMOTE_ADDR'];
		$data['admin_online']= time();
		$this->db->update('admin',$data,$where);
	}
	
	function remov_session() {
		$session = array(
					'admin_id'  =>'',
					'admin_user'  =>'',
					'admin_nama' =>'',
					'logged_in'	  => FALSE
					);
		$this->session->unset_userdata($session);
	}
    
    
    
    //configurasi admin
    public function insert_admin($data){
        $this->db->insert("admin",$data);
    }
    
    public function update_admin($where,$data){
        $this->db->update("admin",$data,$where);
    }
    public function delete_admin($where){
        $this->db->delete("admin", $where);
    }
	public function get_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("admin");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
    public function grid_all_admin($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }
    public function count_all_admin($where="", $like=""){
        $this->db->select("*");
        $this->db->from("admin");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
}