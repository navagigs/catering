<?php
class M_costumer extends CI_Model {
	
	function __contsruct(){
		parent::Model();
	}
	
	function cek_login($where){
		$data = "";
		$this->db->select("*");
		$this->db->from("costumer");
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
					'costumer_username' 	   	=> $data->costumer_username,
					'costumer_password' 	=> $data->costumer_password,
					'costumer_nama' 		=> $data->costumer_nama,
					'logged_in2'		=> TRUE
					);
		$this->session->set_userdata($session);
	}
	
	function update_log($where){
		$where['costumer_username'] 		=	 $data->costumer_username;
		$where['mahasiswa_nama'] = $data->mahasiswa_nama;
		$data['mahasiswa_ip']	 = $_SERVER['REMOTE_ADDR'];
		$data['mahasiswa_online']= time();
		$this->db->update('costumer',$data,$where);
	}
	
	function remov_session() {
		$session = array(
					'costumer_username'  =>'',
					'costumer_nama' =>'',
					'logged_in2'	  => FALSE
					);
		$this->session->unset_userdata($session);
	}

	  //configurasi costumer
    public function insert_costumer($data){
        $this->db->insert("costumer",$data);
    }
    
    public function update_costumer($where,$data){
        $this->db->update("costumer",$data,$where);
    }
    public function delete_costumer($where){
        $this->db->delete("costumer", $where);
    }
	public function get_costumer($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("costumer");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
    public function grid_all_costumer($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("costumer");
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
    public function count_all_costumer($where="", $like=""){
        $this->db->select("*");
        $this->db->from("costumer");
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


    	  //configurasi pemesanan
    public function insert_pemesanan($data){
        $this->db->insert("pemesanan",$data);
    }
    
    public function update_pemesanan($where,$data){
        $this->db->update("pemesanan",$data,$where);
    }
    public function delete_pemesanan($where){
        $this->db->delete("pemesanan", $where);
    }
	public function get_pemesanan($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("pemesanan");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
    public function grid_all_pemesanan($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pemesanan");
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
    public function count_all_pemesanan($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pemesanan");
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


              //configurasi pemesanan_detail
    public function insert_pemesanan_detail($data){
        $this->db->insert("pemesanan_detail",$data);
    }
    
    public function update_pemesanan_detail($where,$data){
        $this->db->update("pemesanan_detail",$data,$where);
    }
    public function delete_pemesanan_detail($where){
        $this->db->delete("pemesanan_detail", $where);
    }
    public function get_pemesanan_detail($select, $where){
        $data = "";
        $this->db->select($select);
        $this->db->from("pemesanan_detail");
        $this->db->where($where);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }
    public function grid_all_pemesanan_detail($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pemesanan_detail");
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
    public function count_all_pemesanan_detail($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pemesanan_detail");
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

    	  //configurasi menu
    public function insert_menu($data){
        $this->db->insert("menu",$data);
    }
    
    public function update_menu($where,$data){
        $this->db->update("menu",$data,$where);
    }
    public function delete_menu($where){
        $this->db->delete("menu", $where);
    }
	public function get_menu($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("menu");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
    public function grid_all_menu($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("menu");
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
    public function count_all_menu($where="", $like=""){
        $this->db->select("*");
        $this->db->from("menu");
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


          //configurasi pembayaran
    public function insert_pembayaran($data){
        $this->db->insert("pembayaran",$data);
    }
    
    public function update_pembayaran($where,$data){
        $this->db->update("pembayaran",$data,$where);
    }
    public function delete_pembayaran($where){
        $this->db->delete("pembayaran", $where);
    }
    public function get_pembayaran($select, $where){
        $data = "";
        $this->db->select($select);
        $this->db->from("pembayaran");
        $this->db->where($where);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }
    public function grid_all_pembayaran($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pembayaran");
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
    public function count_all_pembayaran($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pembayaran");
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



      // CONFIGURATION COMBO BOX WITH DATABASE WITH VALIDASI
    public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
        echo "<select name='$name' id='$name' onchange='$js' required class='form-control' style='width:$width'>";
        echo "<option value=''>".$label."</option>";
        $query = $this->db->query($table);
        foreach ($query->result() as $row){
            if ($pilihan == $row->$value){
                echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
            } else {
                echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
            }
        }
        echo "</select>";
    }
    
    // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
    public function combo_box2($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
        echo "<select name='$name' id='$name' onchange='$js' class='form-control' style='width:$width'>";
        echo "<option value=''>".$label."</option>";
        $query = $this->db->query($table);
        foreach ($query->result() as $row){
            if ($pilihan == $row->$value){
                echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
            } else {
                echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
            }
        }
        echo "</select>";
    }
    
    //CONFIGURATION CHECKBOX ARRAY WITH DATABASE
    public function checkbox($table, $name, $value, $name_value, $pilihan=''){
        $query = $this->db->query($table);
        $array_tag = explode(',', $pilihan);
        $ceked = "";
        foreach ($query->result() as $row){
            $ceked = (array_search($row->tag_id, $array_tag) === false)? '' : 'checked';
            echo "<div class='radio'><label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label></div>";
        }
    }
    
    //CONFIGURATION CHECKBOX ARRAY WITH DATABASE
    public function checkbox_status($table, $name, $value, $name_value, $pilihan=''){
        $query = $this->db->query($table);
        $array_tag = explode(',', $pilihan);
        $ceked = "";
        foreach ($query->result() as $row){
            $ceked = (array_search($row->status_perkawinan_kode, $array_tag) === false)? '' : 'checked';
            echo "<input type='checkbox' name='$name' id='".$row->$value."' style='display: inline-block;' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block; margin-right: 10px;'>".$row->$name_value."</label>";
        }
    }
    
    //CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
    public function listarray($table, $name, $value, $name_value, $pilihan=''){
        $query = $this->db->query($table);
        $array_tag = explode(',', $pilihan);
        $ceked = "";
        foreach ($query->result() as $row){
            if (array_search($row->tag_id, $array_tag) === false) {
            } else {
            echo $row->$name_value.", ";
            }
        }
    }
	
 }
    