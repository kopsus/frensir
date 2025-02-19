<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthenticationCTL extends BaseController
{
    public function __construct(){
        $this->session = session();
        $this->users = new UserModel();
        $this->password = password_hash('user_password_here', PASSWORD_DEFAULT);
    }

    public function index(){
        helper(['form']);
        return view('auth/loginPage');
    }

    public function login(){
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $this->users->getUserByEmail($username);

        if ($user) {
            if (password_verify($password, $user['Password'])) {
                $sessionData = [
                    'id' => $user['User_id'],
                    'username' => $user['Username'],
                    'email' => $user['Email'],
                    'roles' => $user['Role'],
                    'isLoggedIn' => true
                ];
                $this->session->set($sessionData);
                if($user['Role'] === 'Admin'){
                    return redirect()->to('admin/dashboard');
                }else{
                    return redirect()->to('kasir');
                }
            } else {
                $this->session->setFlashdata('error', 'Invalid username or password.');
                return redirect()->to('/login');
            }
        } else {
            $this->session->setFlashdata('error', 'User not found.');
            return redirect()->to('/login');
        }
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
