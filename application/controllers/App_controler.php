<?php 
/**
* 
*/
class App_controler extends CI_Controller
{
	public function __construct() {

    parent::__construct();

    // load base_url
    $this->load->helper('url');
    
    

  	}
	
	public function Index()
	{
		$this->load->view('menuAwal');
	}

	public function CProsesLogin(){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$ambilData = [
			'username' => $username,
			'password' => $password
		];

		$user = $this->db->get_where('tb_user',$ambilData)->row_array();
		if ($user) {
			$data = [							
					'username' => $user['username'],
					'nm_user' => $user['nm_user'],
					'id_user' => $user['id_user'],
					'id_outlet' => $user['id_outlet'],
					'password' =>$user['password'],
					'role' => $user['role']
					];
		$this->session->set_userdata($data);
			if ($user['role'] == 'admin') {
				$this->session->set_flashdata('status', 'Selamat Datang : Admin');
				redirect('App_controler/AdminCTampilOutlet');
			}elseif ($user['role'] == 'kasir') {
				$this->session->set_flashdata('status', 'Selamat Datang : ' .$data['nm_user']);
				redirect('App_controler/CTampilMember');
			}elseif ($user['role'] == 'owner') {
				$this->session->set_flashdata('status', 'Selamat Datang Boss');
				redirect('App_controler/CTampilOwner');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger "role="alert">Username Atau Password Salah</div> ');
			redirect();
		}
		
		
		//$this->session->set_userdata('id_outlet', $hasil2['id_outlet']);

		
	}

	public function CTampilMember()
	{
		$id_user = $this->session->userdata('id_user');
		$data = $this->App_model->MTampilMember($id_user);
		$this->load->view('VHome', ['data' => $data]);
	}

	public function CTambahMember()
	{
		$this->load->view('VTambahMember');
	}

	public function CProsesTambahMember()
	{
		$id_user = $this->session->userdata('id_user');
		$nm_member = $this->input->post('nm_member');
		$tlp_member = $this->input->post('tlp_member');
		$alamat_member = $this->input->post('alamat_member');

		$hasil = $this->App_model->MProsesTambahMember($nm_member, $tlp_member, $alamat_member, $id_user);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Menambahkan Member ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Menambahkan Member');
		}
		redirect('App_controler/CTampilMember');
	}

	public function Clogout()
	{
		$this->session->unset_userdata('username');
		redirect('');
	}

	public function CHapusMember($id)
	{
		$this->App_model->MHapusMember($id);
		redirect('App_controler/CTampilMember');
	}

	public function CEditMember($id)
	{
		$data = $this->App_model->MEditMember($id);
		$this->load->view('VEditMember', ['data' => $data]);
	}

	public function CProsesEditMember($id_member)
	{
		$id = $id_member;
		$nm_member = $this->input->post('nm_member');
		$tlp_member = $this->input->post('tlp_member');
		$alamat_member = $this->input->post('alamat_member');

		$hasil = $this->App_model->MProsesEditMember($nm_member, $tlp_member, $alamat_member, $id);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Merubah Member ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Merubah Member');
		}
		redirect('App_controler/CTampilMember');
	}

	public function CTampilService()
	{

		$ambil_jenis = $this->App_model->MAmbilJenis();
		$id_outlet = $this->session->userdata('id_outlet');


		foreach ($ambil_jenis as $j) {
			if ($j['jenis_paket'] == 'paketan') {
				$paketan = $this->App_model->MTampilPaket('paketan', $id_outlet);
				$paketan2 = $this->load->view('VServicePaket', ['data' => $paketan], true);
			} elseif ($j['jenis_paket'] == 'standar' ) {
				$standar = $this->App_model->MTampilPaket('standar', $id_outlet);
				$standar2 = $this->load->view('VServiceStandar', ['data' => $standar], true);
			}
		}

		$this->load->view('VService', ['standar' => $standar2, 'paketan' => $paketan2]);

	}

	public function CMasukKeranjang($id)
	{
		
		$id_paket = $id;
		$id_user = $this->session->userdata('id_user');
		$qty = $this->input->post('kuantitas');


		$hasil = $this->App_model->MMasukKeranjang($qty, $id_paket, $id_user);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Masuk Keranjang ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Masuk Keranjang');
		}
		redirect('App_controler/CTampilService');
	}

	public function CTampilKeranjang()
	{
		$data = $this->App_model->MTampilKeranjang($this->session->userdata('id_user'));
		$this->load->view('VKeranjang', ['data' => $data]);
	}

	// public function CHapusKeranjang($id_detail_transaksi)
	// {
	// 	$this->App_model->MHapusKeranjang($id_detail_transaksi);
	// 	redirect('App_controler/CTampilKeranjang');
	// }

	public function CProsesKeranjang()
	{
		$total_harga = $this->input->post('total_bayar');
		$id_member = $this->input->post('id_member');
		$biaya_tambahan = $this->input->post('biaya_tambahan');
		$pajak = $this->input->post('pajak');
		$diskon = $this->input->post('diskon');
		$keterangan = $this->input->post('keterangan');
		$batas_waktu = $this->input->post('batas_waktu');

		$id_user = $this->session->userdata('id_user');
		$id_outlet = $this->session->userdata('id_outlet');
		
		$hasil = $this->App_model->MProsesKeranjang($id_member, $biaya_tambahan, $pajak, $diskon, $id_user, $id_outlet, $batas_waktu, $total_harga);
		$hasil2 = $this->App_model->MUpdateKeranjang($id_user, $keterangan, $id_member);
		
		$invoice = $this->App_model->MAmbilDataTransaksi($id_member);
		$invoice2 = array(
			'kode_invoice' => $invoice['kode_invoice']
			);

		$updateStatus = $this->App_model->MUpdateStatus($invoice2['kode_invoice']);

		//mengecek klo berhasil checkout atau tidak
		if ($hasil == true) {
			$this->session->set_userdata($invoice2);
			$this->session->set_flashdata('status', 'Berhasil Checkout, dengan Kode Invoice : '.$invoice2['kode_invoice']);

		}else {
			$this->session->set_flashdata('status', 'Gagal Checkout');
		}
		redirect('App_controler/CTampilKeranjang');
	}


	public function CTampilPembayaran()
	{
		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MTampilPembayaran($id_user);
		$this->load->view('VPembayaran', ['data' => $data]);
	}

	public function CProsesTampilPembayaran($id_transaksi)
	{
		$data = $this->App_model->MProsesTampilBayar($id_transaksi);
		$this->load->view('VProsesPembayaran', ['data' => $data]);
	}

	public function CHapusPembayaran($id_transaksi)
	{
		$data = $this->App_model->MHapusPembayaran($id_transaksi);
		redirect('App_controler/CTampilPembayaran');
	}

	public function CProsesBayar($id_transaksi)
	{
		// $sql = $this->App_model->MProsesTampilBayar($id_transaksi);

		// $ambil_total_harga = $sql['total_harga'];
		// $ambil_bayar_transaksi = $sql['bayar_transaksi'];

		$bayar = $this->input->post('bayar');
		$ambil_total_harga = $this->App_model->MAmbilTotal($id_transaksi);
		$total_harga = $ambil_total_harga['total_harga'];
		

		$hasil = $this->App_model->MProsesBayar($id_transaksi, $bayar, $total_harga);




		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Pembayaran Berhasil ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembayaran');
		}

		redirect('App_controler/CProsesTampilPembayaran/'.$id_transaksi);
	}

	public function CTampilSelesai($id_transaksi)
	{
		$hasil = $this->App_model->MTampilSelesai($id_transaksi);

		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Data Berhasil Diperbaharui ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembaharuan');
		}

		redirect('App_controler/CTampilPembayaran/');
	}

	public function CProsesTampilPengambilan($id_transaksi)
	{
		$data = $this->App_model->MProsesTampilBayar($id_transaksi);
		$this->load->view('VProsesPengambilan', ['data' => $data]);
	}

	public function CProsesPengambilan($id_transaksi)
	{
		$hasil = $this->App_model->MProsesPengambilan($id_transaksi);

		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Data Berhasil Diperbaharui ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembaharuan');
		}

		redirect('App_controler/CTampilPembayaran/');
	}

	public function CTampilLaporan()
	{
		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MTampilPembayaran($id_user);
		$this->load->view('VLaporan', ['data' => $data]);
	}

	public function CCariRange()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MCariRange($id_user, $tgl_awal, $tgl_akhir);
		$this->load->view('VLaporan', ['data' => $data]);
	}



	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	//KERANJANG
	

	//LAPORAN
	 public function AdminCTampilLaporan()
	{


		$data = $this->App_model->AdminMTampilPembayaran();
		$this->load->view('AdminVLaporan', ['data' => $data]);
	}

	public function AdminCCariRange()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MCariRange($id_user, $tgl_awal, $tgl_akhir);
		$this->load->view('AdminVLaporan', ['data' => $data]);
	}


	//MEMBER
	public function AdminCTampilMember()
	{
		
		$data = $this->App_model->AdminMTampilMember();
		$this->load->view('AdminVMember', ['data' => $data]);
	}

	public function AdminCTambahMember()
	{
		$this->load->view('AdminVMemberTambah');
	}

	public function AdminCProsesTambahMember()
	{
		$id_user = $this->session->userdata('id_user');
		$nm_member = $this->input->post('nm_member');
		$tlp_member = $this->input->post('tlp_member');
		$alamat_member = $this->input->post('alamat_member');

		$hasil = $this->App_model->AdminMProsesTambahMember($nm_member, $tlp_member, $alamat_member, $id_user);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Menambahkan Member ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Menambahkan Member');
		}
		redirect('App_controler/AdminCTampilMember');
	}

	public function AdminCHapusMember($id)
	{
		$this->App_model->MHapusMember($id);
		redirect('App_controler/AdminCTampilMember');
	}

	public function AdminCEditMember($id)
	{
		$data = $this->App_model->AdminMEditMember($id);
		$this->load->view('AdminVMemberEdit', ['data' => $data]);
	}

	public function AdminCProsesEditMember($id_member)
	{
		$id = $id_member;
		$nm_member = $this->input->post('nm_member');
		$alamat_member = $this->input->post('alamat_member');
		$jk_member = $this->input->post('jk_member');
		$tlp_member = $this->input->post('tlp_member');
		$id_user = $this->input->post('id_user');

		$hasil = $this->App_model->AdminMProsesEditMember($nm_member, $tlp_member, $alamat_member, $id, $id_user, $jk_member);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Merubah Member ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Merubah Member');
		}
		redirect('App_controler/AdminCTampilMember');
	}




	//OUTLET
	public function AdminCTampilOutlet()
	{		
		$data = $this->App_model->AdminMTampilOutlet();
		$this->load->view('AdminVHome', ['data' => $data]);
	}
	public function AdminCTambahOutlet()
	{
		$this->load->view('AdminVOutletTambah');
	}
	public function AdminCHapusOutlet($id)
	{
		$this->App_model->AdminMHapusOutlet($id);
		redirect('App_controler/AdminCTampilOutlet');
	}
	public function AdminCEditOutlet($id)
	{
		$data = $this->App_model->AdminMEditOutlet($id);
		$this->load->view('AdminVOutletEdit', ['data' => $data]);
	}
	public function AdminCProsesTambahOutlet()
	{
		$id_outlet = $this->session->userdata('id_outlet');
		$nm_outlet = $this->input->post('nm_outlet');
		$alamat_outlet = $this->input->post('alamat_outlet');
		$tlp_outlet = $this->input->post('tlp_outlet');
		

		$hasil = $this->App_model->AdminMProsesTambahOutlet($nm_outlet, $tlp_outlet, $alamat_outlet, $id_user);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Menambahkan Outlet');

		}else {
			$this->session->set_flashdata('status', 'Gagal Menambahkan Outlet');
		}
		redirect('App_controler/AdminCTampilOutlet');
	}

	public function AdminCProsesEditOutlet($id_outlet)
	{
		$id = $id_outlet;
		$nm_outlet = $this->input->post('nm_outlet');
		$alamat_outlet = $this->input->post('alamat_outlet');
		$tlp_outlet = $this->input->post('tlp_outlet');
		
		$hasil = $this->App_model->AdminMProsesEditOutlet($nm_outlet, $id, $alamat_outlet, $tlp_outlet);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Merubah Pengguna ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Merubah Pengguna');
		}
		redirect('App_controler/AdminCTampilOutlet');
	}




	//PEMBAYARAN
	public function AdminCTampilPembayaran()
	{
		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->AdminMTampilPembayaran($id_user);
		$this->load->view('AdminVPembayaran', ['data' => $data]);
	}

	public function AdminCProsesTampilPembayaran($id_transaksi)
	{
		$data = $this->App_model->AdminMProsesTampilBayar($id_transaksi);
		$this->load->view('AdminVProsesPembayaran', ['data' => $data]);
	}

	public function AdminCHapusPembayaran($id_transaksi)
	{
		$data = $this->App_model->AdminMHapusPembayaran($id_transaksi);
		redirect('App_controler/AdminCTampilPembayaran');
	}

	public function AdminCProsesBayar($id_transaksi)
	{
		// $sql = $this->App_model->MProsesTampilBayar($id_transaksi);

		// $ambil_total_harga = $sql['total_harga'];
		// $ambil_bayar_transaksi = $sql['bayar_transaksi'];

		$bayar = $this->input->post('bayar');
		$ambil_total_harga = $this->App_model->AdminMAmbilTotal($id_transaksi);
		$total_harga = $ambil_total_harga['total_harga'];
		

		$hasil = $this->App_model->AdminMProsesBayar($id_transaksi, $bayar, $total_harga);




		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Pembayaran Berhasil ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembayaran');
		}

		redirect('App_controler/AdminCProsesTampilPembayaran/'.$id_transaksi);
	}

	public function AdminCTampilSelesai($id_transaksi)
	{
		$hasil = $this->App_model->AdminMTampilSelesai($id_transaksi);

		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Data Berhasil Diperbaharui ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembaharuan');
		}

		redirect('App_controler/AdminCTampilPembayaran/');
	}

	public function AdminCProsesTampilPengambilan($id_transaksi)
	{
		$data = $this->App_model->MProsesTampilBayar($id_transaksi);
		$this->load->view('AdminVProsesPengambilan', ['data' => $data]);
	}

	public function AdminCProsesPengambilan($id_transaksi)
	{
		$hasil = $this->App_model->AdminMProsesPengambilan($id_transaksi);

		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Data Berhasil Diperbaharui ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembaharuan');
		}

		redirect('App_controler/AdminCTampilPembayaran/');
		}




	//PENGGUNA
	public function AdminCTampilPengguna()
	{		
		$data = $this->App_model->AdminMTampilPengguna();
		$this->load->view('AdminVPengguna', ['data' => $data]);
	}
	public function AdminCTambahPengguna()
	{		
		$data = $this->App_model->AdminMTampilPengguna();
		$this->load->view('AdminVPenggunaTambah', ['data' => $data]);
	}
	public function AdminCEditPengguna($id)
	{
		$data = $this->App_model->AdminMEditPengguna($id);
		$this->load->view('AdminVPenggunaEdit', ['data' => $data]);
	}
	public function AdminCHapusPengguna($id)
	{
		$this->App_model->AdminMHapusPengguna($id);
		redirect('App_controler/AdminCTampilPengguna');
	}
	public function AdminCProsesTambahPengguna()
	{
		
		$nm_user = $this->input->post('nm_user');
		$username = $this->input->post('username');
		$password = md5($_POST['password']);
		$id_outlet = $this->input->post('id_outlet');
		$role = $this->input->post('role');
		

		$hasil = $this->App_model->AdminMProsesTambahPengguna( $nm_user, $username, $password, $id_outlet, $role);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Menambahkan Pengguna');

		}else {
			$this->session->set_flashdata('status', 'Gagal Menambahkan Pengguna');
		}
		redirect('App_controler/AdminCTampilPengguna');
	}
	public function AdminCProsesEditPengguna($id_user)
	{
		$id = $id_user;
		$nm_user = $this->input->post('nm_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$id_outlet = $this->input->post('id_outlet');
		$role = $this->input->post('role');

		$hasil = $this->App_model->AdminMProsesEditPengguna($nm_user, $username, $password, $id, $id_outlet, $role);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Merubah Pengguna ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Merubah Pengguna');
		}
		redirect('App_controler/AdminCTampilPengguna');
	}



	//SERVICE & Keranjang

	public function AdminCTampilService()
	{
		$ambil_jenis = $this->App_model->AdminMAmbilJenis();
		


		foreach ($ambil_jenis as $j) {
			if ($j['jenis_paket'] == 'paketan') {
				$paketan = $this->App_model->AdminMTampilPaket('paketan');
				$paketan2 = $this->load->view('AdminVServicePaket', ['data' => $paketan], true);
			} elseif ($j['jenis_paket'] == 'standar' ) {
				$standar = $this->App_model->AdminMTampilPaket('standar');
				$standar2 = $this->load->view('AdminVServiceStandar', ['data' => $standar], true);
			}
		}

		$this->load->view('AdminVService', ['standar' => $standar2, 'paketan' => $paketan2]);

	}

	public function AdminCMasukKeranjang($id)
	{
		
		$id_paket = $id;
		$id_user = $this->session->userdata('id_user');
		$qty = $this->input->post('kuantitas');


		$hasil = $this->App_model->MMasukKeranjang($qty, $id_paket, $id_user);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Masuk Keranjang ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Masuk Keranjang');
		}
		redirect('App_controler/AdminCTampilService');
	}

	public function AdminCTampilKeranjang()
	{
		$data = $this->App_model->MTampilKeranjang($this->session->userdata('id_user'));
		$this->load->view('AdminVKeranjang', ['data' => $data]);
	}

	public function AdminCHapusKeranjang($id_detail_transaksi)
	{
		$this->App_model->AdminMHapusKeranjang($id_detail_transaksi);
		redirect('App_controler/AdminCTampilKeranjang');
	}
	public function CHapusKeranjang($id_detail_transaksi)
	{
		$this->App_model->MHapusKeranjang($id_detail_transaksi);
		redirect('App_controler/CTampilKeranjang');
	}
	public function AdminCProsesKeranjang()
	{
		$total_harga = $this->input->post('total_bayar');
		$id_member = $this->input->post('id_member');
		$biaya_tambahan = $this->input->post('biaya_tambahan');
		$pajak = $this->input->post('pajak');
		$diskon = $this->input->post('diskon');
		$keterangan = $this->input->post('keterangan');
		$batas_waktu = $this->input->post('batas_waktu');

		$id_user = $this->session->userdata('id_user');
		$id_outlet = $this->session->userdata('id_outlet');
		
		$hasil = $this->App_model->MProsesKeranjang($id_member, $biaya_tambahan, $pajak, $diskon, $id_user, $id_outlet, $batas_waktu, $total_harga);
		$hasil2 = $this->App_model->MUpdateKeranjang($id_user, $keterangan, $id_member);
		
		$invoice = $this->App_model->MAmbilDataTransaksi($id_member);
		$invoice2 = array(
			'kode_invoice' => $invoice['kode_invoice']
			);

		$updateStatus = $this->App_model->MUpdateStatus($invoice2['kode_invoice']);

		//mengecek klo berhasil checkout atau tidak
		if ($hasil == true) {
			$this->session->set_userdata($invoice2);
			$this->session->set_flashdata('status', 'Berhasil Checkout, dengan Kode Invoice : '.$invoice2['kode_invoice']);

		}else {
			$this->session->set_flashdata('status', 'Gagal Checkout');
		}
		redirect('App_controler/AdminCTampilKeranjang');
	}
	
	

	public function pdf(){
		$this->load->library('dompdf_gen');

		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MTampilPembayaran($id_user);
		$this->load->view('laporan_pdf', ['data' => $data]);

		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan_Laundry.pdf",array('Attachment' => 0));

	}

	public function Adminpdf(){
		$this->load->library('dompdf_gen');


		$data = $this->App_model->AdminMTampilPembayaran();
		$this->load->view('laporan_pdf', ['data' => $data]);

		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan_Laundry.pdf",array('Attachment' => 0));

	}
	public function CTampilOwner()
	{

		$data = $this->App_model->MTampilOwner();
		$this->load->view('Owner', ['data' => $data]);
	}
	
}

?>