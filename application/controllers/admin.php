<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_costumer', 'COS', TRUE);
    }

	public function index()
	{
        if ($this->session->userdata('logged_in') == TRUE){       
            redirect('admin/', 'refresh');
        } else {     
		//$this->load->vars($data);
		$this->load->view('admin/login');
		 }
	}
	
	public function ceklogin()
	{
		$username		= validasi_sql($this->input->post('username'));
		$password		= validasi_sql($this->input->post('password'));
		$do				= validasi_sql($this->input->post('masuk'));
		
		$where_login['admin_username']	= $username;
		$where_login['admin_password']	= do_hash($password, 'md5');
		
		
		if ($do && $this->ADM->cek_login($where_login) === TRUE){
			redirect("admin/home");
		} else {
			$this->session->set_flashdata('warning',' Username atau Password tidak cocok!');
            redirect("admin");
		}
		
	}
	
	public function keluar()
	{
		$this->ADM->remov_session();
       session_destroy();
		redirect("admin");
	}

	public function home ()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['content']			= '/admin/content/home';
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("admin");
		}
		
	}
    
    //menu
    public function menu ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['content']			= '/admin/content/menu';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'tambah') {
				$data['onload']			= 'menu_nama';
				$data['menu_nama']		= ($this->input->post('menu_nama'))?$this->input->post('menu_nama'):'';
				$data['menu_harga']		= ($this->input->post('menu_harga'))?$this->input->post('menu_harga'):'';
				$data['menu_deskripsi'] = ($this->input->post('menu_deskripsi'))?$this->input->post('menu_deskripsi'):'';
				$data['menu_foto']		= ($this->input->post('menu_foto'))?$this->input->post('menu_foto'):'';
				$simpan					= $this->input->post('simpan');
				if ($simpan) {
					$foto = upload_image("menu_foto", "./assets/images/");
					$data['menu_foto']	= $foto;
					$insert['menu_nama']		 = validasi_sql($data['menu_nama']);
					$insert['menu_harga']		 = validasi_sql($data['menu_harga']);
					$insert['menu_deskripsi']	 = validasi_sql($data['menu_deskripsi']);
					if ($data['menu_foto']) { $insert['menu_foto'] = validasi_sql($data['menu_foto']); }
					$this->COS->insert_menu($insert);
					$this->session->set_flashdata('success','Menu Catering telah berhasil ditambahkan!,');
					redirect("admin/menu");
				}
			} elseif ($data['action'] == 'edit') {	
				$where['menu_id'] 			= $filter2;
				$data['onload']			 	= 'menu_nama';
				$where_menu['menu_id']	= validasi_sql($filter2);
				$menu						= $this->COS->get_menu('*', $where_menu);
				$data['menu_id']			= ($this->input->post('menu_id'))?$this->input->post('menu_id'):$menu->menu_id;	
				$data['menu_nama']			= ($this->input->post('menu_nama'))?$this->input->post('menu_nama'):$menu->menu_nama;	
				$data['menu_foto']		= ($this->input->post('menu_foto'))?$this->input->post('menu_foto'):$menu->menu_foto;	
				$data['menu_harga']			= ($this->input->post('menu_harga'))?$this->input->post('menu_harga'):$menu->menu_harga;
				$data['menu_deskripsi']			= ($this->input->post('menu_deskripsi'))?$this->input->post('menu_deskripsi'):$menu->menu_deskripsi;	
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$foto = upload_image("menu_foto", "./assets/images/");
					$data['menu_foto']		= $foto;
					$where_edit['menu_id']		= validasi_sql($data['menu_id']);
					$edit['menu_nama']			= validasi_sql($data['menu_nama']);
					$edit['menu_harga']			= validasi_sql($data['menu_harga']);
					$edit['menu_deskripsi']		= validasi_sql($data['menu_deskripsi']);
					if ($data['menu_foto']) {
						$row = $this->COS->get_menu('*', $where_edit);
						@unlink('./assets/images/'.$row->menu_foto);
						$edit['menu_foto']	= $data['menu_foto']; 
					}
					$this->COS->update_menu($where_edit, $edit);
					$this->session->set_flashdata('success','Menu Catering telah berhasil diedit!,');
					redirect("admin/menu");	
				}				
            } elseif ($data['action']	== 'hapus') {
			 $where['menu_id']	= validasi_sql($filter2);
			 $row = $this->COS->get_menu('*', $where);
			 @unlink ('./assets/images/'.$row->menu_foto);
			 $this->COS->delete_menu($where);
			 $this->session->set_flashdata('warning','Menu Catering telah berhasil dihapus!,');
			 redirect("admin/menu");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("admin");
		}
		
    }


    //costumer
    public function costumer ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['content']			= '/admin/content/costumer';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'tambah') {
				$data['onload']			= 'costumer_username';
				$data['costumer_nama']		= ($this->input->post('costumer_nama'))?$this->input->post('costumer_nama'):'';
				$data['costumer_username']		= ($this->input->post('costumer_username'))?$this->input->post('costumer_username'):'';
				$data['costumer_password']		= ($this->input->post('costumer_password'))?$this->input->post('costumer_password'):'';
				$data['costumer_notelp'] = ($this->input->post('costumer_notelp'))?$this->input->post('costumer_notelp'):'';
				$data['costumer_alamat']		= ($this->input->post('costumer_alamat'))?$this->input->post('costumer_alamat'):'';
				$simpan					= $this->input->post('simpan');
				if ($simpan) {
					$insert['costumer_nama']		 	 = validasi_sql($data['costumer_nama']);
					$insert['costumer_username']		 = validasi_sql($data['costumer_username']);
					$insert['costumer_password']		 = md5($data['costumer_password']);
					$insert['costumer_notelp']	 		 = validasi_sql($data['costumer_notelp']);
					$insert['costumer_alamat']	 		 = validasi_sql($data['costumer_alamat']);
					$this->COS->insert_costumer($insert);
					$this->session->set_flashdata('success','Costumer telah berhasil ditambahkan!,');
					redirect("admin/costumer");
				}
			} elseif ($data['action'] == 'edit') {	
				$where['costumer_id'] 			= $filter2;
				$data['onload']			 	= 'costumer_username';
				$where_costumer['costumer_id']	= validasi_sql($filter2);
				$costumer						= $this->COS->get_costumer('*', $where_costumer);
				$data['costumer_id']			= ($this->input->post('costumer_id'))?$this->input->post('costumer_id'):$costumer->costumer_id;	
				$data['costumer_nama']			= ($this->input->post('costumer_nama'))?$this->input->post('costumer_nama'):$costumer->costumer_nama;	
				$data['costumer_username']			= ($this->input->post('costumer_username'))?$this->input->post('costumer_username'):$costumer->costumer_username;	
				$data['costumer_notelp']		= ($this->input->post('costumer_notelp'))?$this->input->post('costumer_notelp'):$costumer->costumer_notelp;	
				$data['costumer_password']			= ($this->input->post('costumer_password'))?$this->input->post('costumer_password'):$costumer->costumer_password;
				$data['costumer_notelp']			= ($this->input->post('costumer_notelp'))?$this->input->post('costumer_notelp'):$costumer->costumer_notelp;
				$data['costumer_alamat']			= ($this->input->post('costumer_alamat'))?$this->input->post('costumer_alamat'):$costumer->costumer_alamat;		
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$where_edit['costumer_id']		= validasi_sql($data['costumer_id']);
					$edit['costumer_nama']			= validasi_sql($data['costumer_nama']);
					$edit['costumer_username']			= validasi_sql($data['costumer_username']);
					if($data['costumer_password'] == $data['costumer_password']) {
					$where_edit['costumer_id']	= validasi_sql($data['costumer_id']);
						if($data['costumer_password'] <> '') {
							$edit['costumer_password']		= validasi_sql(do_hash(($data['costumer_password']), 'md5')); 
						}
					}	
					$edit['costumer_notelp']		= validasi_sql($data['costumer_notelp']);
					$edit['costumer_alamat']		= validasi_sql($data['costumer_alamat']);
					$this->COS->update_costumer($where_edit, $edit);
					$this->session->set_flashdata('success','Costumer telah berhasil diedit!,');
					redirect("admin/costumer");	
				}				
            } elseif ($data['action']	== 'hapus') {
			 $where['costumer_id']	= validasi_sql($filter2);
			 $this->COS->delete_costumer($where);
			 $this->session->set_flashdata('warning','Costumer telah berhasil dihapus!,');
			 redirect("admin/costumer");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("admin");
		}
        
    }


    public function pemesanan ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['content']			= '/admin/content/pemesanan';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action'] == 'detail') {
				$where_detail['pemesanan_id']	= validasi_sql($filter2);
				$detail						= $this->COS->get_pemesanan_detail('*', $where_detail);
				error_reporting(0);
				$data['pemesanan_id']			= ($this->input->post('pemesanan_id'))?$this->input->post('pemesanan_id'):$detail->pemesanan_id;
			} elseif ($data['action'] == 'status'){
				$where_edit['pemesanan_id'] 		= $filter2;
				if ($filter3 == 'Y') {
					$edit['pemesanan_id'] = validasi_sql($filter2);
					$edit['pemesanan_status'] = 'N';
				} else {
 					$edit['pemesanan_status']= 'Y';
				}
				$this->COS->update_pemesanan($where_edit, $edit);
				$this->session->set_flashdata('success','Status Pembayaran telah berhasil diedit!,');
				redirect("admin/pemesanan");
			} elseif($data['action'] == 'hapus' ) {
				$where_delete['pemesanan_id']		= validasi_sql($filter2);
				$this->COS->delete_pemesanan($where_delete);
				$this->COS->delete_pemesanan_detail($where_delete);
				$this->session->set_flashdata('warning','Pemesanan telah berhasil dihapus!,');
			 redirect("admin/pemesanan");
			}	
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("admin");
		}
		
	}


	public function pembayaran ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['content']			= '/admin/content/pembayaran';
			$data['action']				= (empty($filter1))?'view':$filter1;
			if ($data['action']	== 'hapus') {
			 $where['pembayaran_id']	= validasi_sql($filter2);
			 $this->COS->delete_pembayaran($where);
			 $this->session->set_flashdata('warning','Pembayaran telah berhasil dihapus!,');
			 redirect("admin/pembayaran");
			}elseif ($data['action']	== 'report') {
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("admin");
		}
		
	}

		//EXPORT KE EXCEL
	public function laporanexcel($filter1='', $filter2='', $filter3='')

    {
		if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['action']				= (empty($filter1))?'view':$filter1;
				        header("Pragma: public");
				        header("Expires: 0");
				        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
				        header("Content-Type: application/force-download");
				        header("Content-Type: application/octet-stream");
				        header("Content-Type: application/download");
				        header("Content-Disposition: attachment;filename=Laporan-Transaksi.xls");
				        header("Content-Transfer-Encoding: binary ");
		$this->load->vars($data);
			$this->load->view('admin/content/export_excel');
	  } else {
			redirect("admin");
	  }
	}
    
}