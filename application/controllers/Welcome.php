<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Welcome extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->cekRole('admin');
		$this->load->model('Modeldata', 'model');
		$this->url = 'https://loket.ppdwk.com/';
		$this->apiKey = $this->model->getBy('setting', 'kunci', 'apiKey')->row('isi');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function santri()
	{
		$apiUrl = "https://data.ppdwk.com/api/datatables?data=pendaftar&page=1&per_page=500&q=&sortby=created_at&sortbydesc=ASC&status=1";

		$token = $this->model->getBy('setting', 'kunci', 'token')->row('isi');

		$headers = [
			"Authorization: Bearer $token",
			"Content-Type: application/json",
		];

		$ch = curl_init($apiUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HTTPGET, true); // GET request

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			echo "cURL error: " . curl_error($ch);
		} else {
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			// echo "HTTP Code: $httpCode\n";

			// Decode JSON response
			$result = json_decode($response, true); // true = associative array

		}
		echo json_encode($result);
	}

	public function nowQueu()
	{
		$url = $this->url . 'api/antrian/nowQueu';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // ✅ Penting agar dapat isi response
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->apiKey
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response ke array
		$result = json_decode($response, true);

		$data['meja'] = $result['data'];
		$this->load->view('antrian_now', $data);
	}

	public function nextQueu()
	{
		$url = $this->url . 'api/antrian/nextQueu';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // ✅ Penting agar dapat isi response
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->apiKey
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response ke array
		$result = json_decode($response, true);

		$data['antrian'] = $result['data'];
		$this->load->view('antrian_next', $data);
	}
	public function allQueu()
	{
		$url = $this->url . 'api/antrian/allQueu';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // ✅ Penting agar dapat isi response
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->apiKey
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response ke array
		$result = json_decode($response, true);

		$data['antrianAll'] = $result['data'];
		$this->load->view('antrian_all', $data);
	}
	public function lastQueu()
	{
		$url = $this->url . 'api/antrian/lastQueu';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // ✅ Penting agar dapat isi response
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->apiKey
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		echo $response;
	}
	public function add()
	{
		$url = $this->url . 'api/antrian/add';

		$postData = [
			'nama' => $this->input->post('nama', true),
			'jenis' => $this->input->post('jenis', true)
		];

		// Setup CURL
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->apiKey
		]);

		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		$result = json_decode($response, true);

		if ($result['status'] == 'success') {
			$noantri = $result['data']['jenis'] . convNol($result['data']['nomor']);
			$nama = $result['data']['nama'];
			$this->cetak($noantri, $nama);
			redirect('welcome');
		}
	}
	public function batal($id)
	{
		$url = $this->url . 'api/antrian/batal/' . $id;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // 🔥 method DELETE
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->apiKey
		]);

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		echo $response;
	}

	public function cetak($no, $nama)
	{
		$nm_printer = $this->model->getBy('setting', 'kunci', 'printer')->row('isi');
		try {
			$nomor_antrian = $no;
			// Nama printer seperti yang terlihat di Windows
			$connector = new WindowsPrintConnector($nm_printer);

			$printer = new Printer($connector);

			// Mendapatkan tanggal dan waktu saat ini
			$tanggal = date('d M Y');
			$waktu = date('H:i');

			// Menyiapkan teks yang akan dicetak
			$printer->setJustification(Printer::JUSTIFY_CENTER);
			$printer->setFont(Printer::FONT_B);
			$printer->setTextSize(2, 2);
			$printer->text("PSB PPDWK 2025/2026\n");
			$printer->setTextSize(1, 1);
			$printer->text("Panitia Penerimaan Santri Baru\n");
			$printer->text("Ponpes Darul Lughah Wal Karomah\n");
			$printer->feed();
			$printer->setTextSize(2, 2);
			$printer->text("No. Antrian\n");
			$printer->feed();
			$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT);
			$printer->setTextSize(4, 4);
			// $printer->text("$nomor_antrian\n");
			$printer->text("$nomor_antrian\n");
			$printer->feed();
			$printer->setTextSize(1, 1);
			$printer->text("$nama\n");
			$printer->feed();
			$printer->text("$tanggal $waktu\n");
			$printer->feed();
			$printer->text("Harap menunggu panggilan\n");
			$printer->text("TERIMAKASIH\n");

			// Memotong kertas
			$printer->cut();

			// Menutup koneksi printer
			$printer->close();
		} catch (Exception $e) {
			echo "Tidak dapat mencetak ke printer: " . $e->getMessage() . "\n";
		}
	}
}
