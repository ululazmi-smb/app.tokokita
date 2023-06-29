<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $db = $this->db->get_where("user", array("username" => $username, "password" => $password));

        if ($db->num_rows() > 0) {
            // Login berhasil
            $response = [
                'success' => true,
                'message' => 'Login berhasil'
            ];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            // Login gagal
            $response = [
                'success' => false,
                'message' => 'Username atau password salah'
            ];
            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function register()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $userData = array(
            'username' => $name,
            'email' => $email,
            'password' => $password,
        );
        $this->db->insert('user', $userData);
        $response = array(
            'success' => true,
            'message' => 'Pendaftaran berhasil',
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

}
