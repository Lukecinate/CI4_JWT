<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    use ResponseTrait;
    
    protected $db;
    
    function __construct()
    {
        $this->db = new UserModel;
    }

    public function login(){
        $email = htmlspecialchars($this->request->getPost('email'));
        $password = htmlspecialchars($this->request->getPost('password'));

        $res = $this->db->login($email, $password);

        if($res){

            // I will add session, this is just an optional
            $ses_data = [
                'email' => $email,
                'name' => 'Test J',
                'Roles' => 'Admin'
            ];
            session()->set($ses_data);
            $rows["session"] = session()->get();

            $key = getenv('SECRET_KEY');
            $iat = time();
            $exp = $iat + 120; // expired will be resolve after 2 minutes
            // on payload u could change based on requirement
            //except iss, sub, iat, exp, and uid
            //on uid u could change based on urs needed
            $payload = [
                'iss' => 'ci4_jwt',
                'sub' => 'login',
                'iat' => $iat,
                'exp' => $exp,
                'uid' => $email,
                'email' => $email,
                'name' => 'Test J',
                'Roles' => 'Admin'
            ];

            $token = JWT::encode($payload, $key, 'HS256');

            // this is the main thing, u should set the cookies
            $this->response->setCookie([
                'name'          => 'token',
                'value'         => $token,
                'expire'        => 120, // expired in 2 minutes
                'domain'        => '', // set yours domian e.g. google 
                'path'          => '/',
                'secure'        => false, // Set true if you use HTTPS
                'httponly'      => true,
                'samesite'      => 'Lax'
            ]);

            return $this->respond(['status' => 200, 'token' => $token, 'data' => $rows]);
        }
    }
}
