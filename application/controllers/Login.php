<?php
defined('BASEPATH') or exit('No direct script access allowe');

class Login extends CI_Controller{
    public function index()
    {
        $this->load->view('login_view.php');
    }

    public function auth(){
        $parsing = array(
            'username'=>$this->input->post('username'),
            'password'=>$this->input->post('password')
            
        );
        // var_dump($parsing);
        $sql = $this->db->where($parsing)->get('m_user')->num_rows();
        // var_dump($sql);
        if($sql > 0){
            $this->session->set_userdata(array('username'=>$parsing['username']));
				echo "<script language=javascript>
				alert('Anda Berhasil Masuk');
				window.location='" . base_url('buku') . "';
				</script>";  
        }else{
            echo "<script language=javascript>
            alert('Akun yang anda masukkan tidak tersedia, Periksa kembali!');
            window.location='" . base_url('login') . "';
            </script>";
        }
    
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
