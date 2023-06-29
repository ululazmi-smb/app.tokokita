<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function index()
	{
		header('Content-Type: application/json; charset=utf-8');
		$res = array();
		$id = $this->uri->segment(4);
		$sql = $this->db->get_where("laporan",array("type" => $id));
		foreach($sql->result() as $key => $data)
		{
			$res[$key]["tanggal"] = $data->tanggal;
			$res[$key]["deskripsi"] = $data->deskripsi;
			$res[$key]["jumlah"] = $data->jumlah;
		}
		echo json_encode($res);
	}

	public function insert()
	{
		header('Content-Type: application/json; charset=utf-8');
		$res = array();
		$tanggal = $this->input->post("tanggal");
		$deskripsi = $this->input->post("deskripsi");
		$jumlah = $this->input->post("jumlah");
		$jenis_laporan = $this->input->post("jenis_laporan");
		$db = $this->db->insert("laporan", array("deskripsi" => $deskripsi, "jumlah" => $jumlah, "tanggal" => $tanggal, "type" => $jenis_laporan));
		if($db)
		{
			$res = array("error" => "success");
		} else {
			$res = array("error" => "error");
		}
		echo json_encode($res);
	}

}
