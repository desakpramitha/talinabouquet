<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();  
        $this->load->model('auth_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'This email is invalid']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title']  = 'Talina Bouquet - Login';
            $this->load->view('auth/templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('auth/templates/auth_footer');
        } else {
            // validation success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if ($this->auth_model->login_user($email, $password)) {
                    if ($user['role_id'] == 1) {
                        redirect('admin/admin_controller/index');
                    } else if ($user['role_id'] == 2) {
                        redirect('user/pelanggan_controller');
                        // redirect('dashboard_controller');
                        // echo $user['name'];
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth_controller');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This Email has not been activated!</div>');
                redirect('auth_controller');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This Email has not been registered!</div>');
            redirect('auth_controller');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[repeatPassword]', ['required' => 'Please fill password!', 'matches' => 'Password dont match!', 'min_length' => 'Password too short!']);
        $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'required|trim|matches[password]', ['required' => 'Please fill repeat password!', 'matches' => 'Password dont match!']);

        if ($this->form_validation->run() == false) {
            $data['title']  = "Talina Bouquet - User Register";
            $this->load->view('auth/templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('auth/templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => 'default.svg',
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // TOKEN
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->auth_model->insertUser($data, 'user');
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Congratulation! your account has been created. Check your email to Activated your account!</div>');
            redirect('auth_controller/index');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'talinabouquet@gmail.com',
            'smtp_pass' => 'bouquettalina123',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('talinabouquet@gmail.com', 'Talina Bouquet');
        $this->email->to($this->input->post('email'));

        // cek type parameter send email
        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account: <a class="btn btn-primary" href="' . base_url() . 'auth_controller/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your account password: <a class="btn btn-primary" href="' . base_url() . 'auth_controller/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    // verifikasi account
    public function verify()
    {
        //ambil data email dan token
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        //cek data user dengan email pada table user
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //cek data user dengan email pada table user
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    // cek apakah token belum expired

                    $this->db->set('is_active', 1); //update is_active
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Account has been activated! Please login!</div>');
                    redirect('auth_controller/index');
                } else {
                    // cek apakah token sudah expired data user dan token akan dihapus
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account Activation failed! Token expired </div>');
                    redirect('auth_controller/index');
                }
            } else {
                // cek token pada url typo
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account Activation failed wrong token</div>');
                redirect('auth_controller/index');
            }
        } else {
            // cek email pada url typo
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account Activation failed wrong email</div>');
            redirect('auth_controller/index');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {

            $data['title']  = 'Forgot Password';
            $this->load->view('auth/templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('auth/templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            // cek user ada
            if ($user) {
                $token = base64_encode(random_bytes(32));

                // data yang mau dimasukan ke dalam table user_token
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);

                //kirim email
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please chheck your email to reset your password!</div>');
                redirect('auth_controller/index');
            } else {
                //user tidak ada & tidak aktif
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not register or activate !</div>');
                redirect('auth_controller/forgotPassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                # memberi session ketika ingin reset password
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                # token di url typo
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed ! Wrong token</div>');
                redirect('auth_controller/index');
            }
        } else {
            // email di url typo
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed ! Wrong Email</div>');
            redirect('auth_controller/index');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth_controller');
        } else {
            # ada session reset_email

            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[repeatPassword]');
            $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'trim|required|min_length[3]|matches[password]');

            if ($this->form_validation->run() == false) {
                # code...
                $data['title']  = 'Change Password';
                $this->load->view('auth/templates/auth_header', $data);
                $this->load->view('auth/change-password');
                $this->load->view('auth/templates/auth_footer');
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $email = $this->session->userdata('reset_email');

                $this->db->set('password', $password);
                $this->db->where('email', $email);
                $this->db->update('user');

                // hapus session reset_email
                $this->session->unset_userdata('reset_email');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been change! Please login</div>');
                redirect('auth_controller/index');
            }
        }
    }

    public function logout()
    {
        $this->cart->destroy();
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('is_login');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out</div>');
        redirect('dashboard_controller/index');
    }

    public function blocked()
    {
        $data['title']  = 'Access Denied !';
        $this->load->view('auth/blocked', $data);
    }
}
