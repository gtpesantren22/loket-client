<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('welcome');
        }
        $this->load->view('login');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $user = $this->Modeldata->get_user($username);

            if ($user && password_verify($password, $user->password) && $user->aktif == 'Y') {
                $session = [
                    'user_id' => $user->user_id,
                    'username' => $user->username,
                    'nama' => $user->nama,
                    'role' => $user->level,
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session);
                $arah = $user->level == 'admin' ? 'welcome' : 'meja';
                echo json_encode(['status' => 'success', 'rdrc' => $arah]);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }



    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
