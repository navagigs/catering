<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Costumer extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_costumer', 'COS', TRUE);
    }

	public function index()
	{
        if ($this->session->userdata('logged_in2') == TRUE){       
            redirect('costumer/','refresh');
        } else {     
		//$this->load->vars($data);
		$this->load->view('costumer/login');
		 }
	}
	
	public function ceklogin()
	{
		$costumer_username		= validasi_sql($this->input->post('costumer_username'));
		$costumer_password	= validasi_sql($this->input->post('costumer_password'));
		$do				= validasi_sql($this->input->post('masuk'));
		
		$where_login['costumer_username']	= $costumer_username;
		$where_login['costumer_password']	= do_hash($costumer_password, 'md5');
		
		
		if ($do && $this->COS->cek_login($where_login) === TRUE){
			redirect("costumer/home");
		} else {
			$this->session->set_flashdata('warning',' Username atau Password tidak cocok!');
            redirect("costumer");
		}
		
	}
	
	public function keluar()
	{
		$this->COS->remov_session();
      	session_destroy();
		redirect("costumer");
	}

	public function daftar ($filter1='', $filter2='', $filter3='')
	{
				$data['costumer_nama']			= ($this->input->post('costumer_nama'))?$this->input->post('costumer_nama'):'';				
				$data['costumer_username']		= ($this->input->post('costumer_username'))?$this->input->post('costumer_username'):'';			
				$data['costumer_password']		= ($this->input->post('costumer_password'))?$this->input->post('costumer_password'):'';	
				$data['costumer_notelp']		= ($this->input->post('costumer_notelp'))?$this->input->post('costumer_notelp'):'';		
				$data['costumer_alamat']		= ($this->input->post('costumer_alamat'))?$this->input->post('costumer_alamat'):'';										
				$data['pendaftaran_tahun']		= date("Y");
				$daftar							= $this->input->post('daftar');
				if ($daftar) {
					$insert['costumer_nama']	 	 = validasi_sql($data['costumer_nama']);
					$insert['costumer_username']	 = validasi_sql($data['costumer_username']);
					$insert['costumer_password']	 = md5($data['costumer_password']);
					$insert['costumer_notelp']	 	 = validasi_sql($data['costumer_notelp']);
					$insert['costumer_alamat']	 	 = validasi_sql($data['costumer_alamat']);
					$this->COS->insert_costumer($insert);
					$this->session->set_flashdata('success','Pendaftaran telah berhasil dilakukan!,');
					redirect("costumer/index");
			}
			$this->load->vars($data);
			$this->load->view('costumer/index');
	}

	public function home ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_costumer['costumer_username']		= $this->session->userdata('costumer_username');
			$data['costumer']				= $this->COS->get_costumer('',$where_costumer);
			$data['content']				= '/costumer/content/home';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$this->load->vars($data);
			$this->load->view('costumer/home');
		} else {
			redirect("costumer");
		}
		
	}

	public function menu ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_costumer['costumer_username']		= $this->session->userdata('costumer_username');
			$data['costumer']				= $this->COS->get_costumer('',$where_costumer);
			$data['content']				= '/costumer/content/menu';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$this->load->vars($data);
			$this->load->view('costumer/home');
		} else {
			redirect("costumer");
		}
		
	}


	public function pemesanan ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_costumer['costumer_username']		= $this->session->userdata('costumer_username');
			$data['costumer']				= $this->COS->get_costumer('',$where_costumer);
			$data['content']				= '/costumer/content/pemesanan';
			$data['action']					= (empty($filter1))?'view':$filter1;
			if($data['action'] == 'tambah' ) {
				$data['costumer_id']			=  ($this->input->post('costumer_id'))?$this->input->post('costumer_id'):'';		
				$data['pemesanan_acara']					= ($this->input->post('pemesanan_acara'))?$this->input->post('pemesanan_acara'):'';		
				$data['pemesanan_tanggal']					= ($this->input->post('pemesanan_tanggal'))?$this->input->post('pemesanan_tanggal'):'';	
				$data['pemesanan_tempat']					= ($this->input->post('pemesanan_tempat'))?$this->input->post('pemesanan_tempat'):'';			
				$data['pemesanan_status']		= 'N';		
				$simpan								= $this->input->post('simpan');
				if ($simpan) {
					$insert['costumer_id']	 	 	= validasi_sql($data['costumer_id']);
					$insert['pemesanan_acara']	 	= validasi_sql($data['pemesanan_acara']);
					$insert['pemesanan_tanggal']	= validasi_sql($data['pemesanan_tanggal']);
					$insert['pemesanan_tempat']	 	= validasi_sql($data['pemesanan_tempat']);
					$insert['pemesanan_status']		= validasi_sql($data['pemesanan_status']);
					$this->COS->insert_pemesanan($insert);
					$this->session->set_flashdata('success','Pemesanan telah berhasil dilakukan!,');
					redirect("costumer/pemesanan");
				}
			} elseif($data['action'] == 'detail' ) {
                    $data['onload']				= 'menu_nama';
				$where_menu['menu_id']	= $filter2; 
				$menu 						= $this->COS->get_menu('*', $where_menu);
                 $data['menu_id']			= ($this->input->post('menu_id'))?$this->input->post('menu_id'):$menu->menu_id;
                 $data['menu_nama']			= ($this->input->post('menu_nama'))?$this->input->post('menu_nama'):$menu->menu_nama;
                 $data['menu_harga']			= ($this->input->post('menu_harga'))?$this->input->post('menu_harga'):$menu->menu_harga;

			} elseif($data['action'] == 'detail-tambah' ) {
				$data['detail_jumlah']			= ($this->input->post('detail_jumlah'))?$this->input->post('detail_jumlah'):'';		
				$data['detail_harga']			= ($this->input->post('detail_harga'))?$this->input->post('detail_harga'):'';		
				$data['detail_total']			= ($this->input->post('detail_total'))?$this->input->post('detail_total'):'';		
				$data['menu_id']				= ($this->input->post('menu_id'))?$this->input->post('menu_id'):'';		
				$data['pemesanan_id']			= ($this->input->post('pemesanan_id'))?$this->input->post('pemesanan_id'):'';		
				$data['costumer_id']			= ($this->input->post('costumer_id'))?$this->input->post('costumer_id'):'';		
				$simpan							= $this->input->post('simpan');
				if ($simpan) {
					$insert['costumer_id']	 	= validasi_sql($data['costumer_id']);
					$insert['detail_jumlah']	= validasi_sql($data['detail_jumlah']);
					$insert['detail_harga']	 	= validasi_sql($data['detail_harga']);
					$insert['detail_total']	 	= validasi_sql($data['detail_total']);
					$insert['menu_id']	 	 	= validasi_sql($data['menu_id']);
					$insert['costumer_id']	 	= validasi_sql($data['costumer_id']);
					$insert['pemesanan_id']	 	= validasi_sql($data['pemesanan_id']);
					$this->COS->insert_pemesanan_detail($insert);
					$this->session->set_flashdata('success','Detail Menu Pemesanan telah berhasil dipesan!,');
					redirect("costumer/pemesanan_detail");
				}
			} elseif($data['action'] == 'detail-hapus' ) {
				$where_delete['detail_id']		= validasi_sql($filter2);
				$this->COS->delete_pemesanan_detail($where_delete);
				$this->session->set_flashdata('warning','Menu Pemesanan telah berhasil dihapus!,');
				redirect("costumer/pemesanan_detail");
			} elseif($data['action'] == 'hapus' ) {
				$where_delete['pemesanan_id']		= validasi_sql($filter2);
				$this->COS->delete_pemesanan($where_delete);
				$this->COS->delete_pemesanan_detail($where_delete);
				$this->session->set_flashdata('warning','Pemesanan telah berhasil dihapus!,');
				redirect("costumer/pemesanan");
			}
			$this->load->vars($data);
			$this->load->view('costumer/home');
		} else {
			redirect("costumer");
		}
		
	}



	public function pemesanan_detail ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_costumer['costumer_username']		= $this->session->userdata('costumer_username');
			$data['costumer']				= $this->COS->get_costumer('',$where_costumer);
			$data['content']				= '/costumer/content/pemesanan_detail';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$this->load->vars($data);
			$this->load->view('costumer/home');
		} else {
			redirect("costumer");
		}
		
	}

	public function pembayaran ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_costumer['costumer_username']		= $this->session->userdata('costumer_username');
			$data['costumer']				= $this->COS->get_costumer('',$where_costumer);
			$data['content']				= '/costumer/content/pembayaran';
			$data['action']					= (empty($filter1))?'view':$filter1;
			if($data['action'] == 'tambah' ) {
				$data['costumer_id']			=  ($this->input->post('costumer_id'))?$this->input->post('costumer_id'):'';
				$data['pemesanan_id']			=  ($this->input->post('pemesanan_id'))?$this->input->post('pemesanan_id'):'';		
				$data['pembayaran_tanggal']					= ($this->input->post('pembayaran_tanggal'))?$this->input->post('pembayaran_tanggal'):'';
				$data['pembayaran_jumlah']					= ($this->input->post('pembayaran_jumlah'))?$this->input->post('pembayaran_jumlah'):'';
				$data['pembayaran_status']					= ($this->input->post('pembayaran_status'))?$this->input->post('pembayaran_status'):'';
				$kirim								= $this->input->post('kirim');
				if ($kirim) {
					$insert['costumer_id']	 	 	= validasi_sql($data['costumer_id']);
					$insert['pemesanan_id']	 	 	= validasi_sql($data['pemesanan_id']);
					$insert['pembayaran_tanggal']	 	 	= validasi_sql($data['pembayaran_tanggal']);
					$insert['pembayaran_jumlah']	 	 	= validasi_sql($data['pembayaran_jumlah']);
					$insert['pembayaran_status']	 	 	= validasi_sql($data['pembayaran_status']);
					$this->COS->insert_pembayaran($insert);
					$this->session->set_flashdata('success','Pembayaran telah berhasil dilakukan!,');
					redirect("costumer/pembayaran");
				}
			}
			$this->load->vars($data);
			$this->load->view('costumer/home');
		} else {
			redirect("costumer");
		}
		
	}
}
	