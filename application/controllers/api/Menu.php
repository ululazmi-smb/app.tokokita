<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function read()
	{
		header('Content-Type: application/json; charset=utf-8');
		$id = $this->uri->segment(4);
		$res = array();
		$sql = $this->db->get_where("menu", array("type" => $id));
		foreach($sql->result() as $key => $a)
		{
			$res[$key]["id"] = $a->id;
			$res[$key]["nama"] = $a->nama;
			$res[$key]["stok"] = $a->stok;
			$res[$key]["harga"] = $a->harga;
			$res[$key]["type"] = $a->type;
		}
		echo json_encode($res);
	}

	public function delete_makanan()
	{
		header('Content-Type: application/json; charset=utf-8');
		$id = $this->uri->segment(4);
		$res = array("error" => "success");
		$sql = $this->db->delete("menu", array("id" => $id));
		echo json_encode($res);
	}

	public function edit()
	{
		header('Content-Type: application/json; charset=utf-8');
		$id = $this->uri->segment(4);
		$nama = $this->input->post('nama');
		$stok = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$type = $this->input->post('type');
		$sql = $this->db->where(array("id" => $id));
		$sql = $this->db->update("menu", array("nama" => $nama, "stok" => $stok, "harga" => $harga, "type" => $type));
		
		if($sql)
		{
			$res = array("error" => "success");
		} else {
			$res = array("error" => "error");
		}
		echo json_encode($res);
	}

	public function insert()
	{
		header('Content-Type: application/json; charset=utf-8');
		$nama = $this->input->post('nama');
		$stok = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$type = $this->input->post('type');
		$sql = $this->db->insert("menu", array("type" => $type, "nama" => $nama, "stok" => $stok, "harga" => $harga));
		if($sql)
		{
			$res = array("error" => "success");
		} else {
			$res = array("error" => "error");
		}
		echo json_encode($res);
	}

}
