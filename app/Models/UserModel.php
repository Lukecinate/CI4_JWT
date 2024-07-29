<?php

namespace App\Models;

use CodeIgniter\Model;
use Dibi;

class UserModel extends Model
{
    protected $db;
    function __construct()
    {
        $this->db = new Dibi\Connection([
            'driver'   => 'mysqli',
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'ci4_jwt',
        ]);
    }

    public function getUsers(){
        $res = $this->db->query("SELECT * FROM users")->fetchAll();
        
        return $res ? $res : null;
    }
    
    public function login($email, $password){
        $res = $this->db->query("SELECT * FROM users WHERE %and", [
            'email' => $email,
            'password' => $password
            ])->fetchAll();

            return $res ? $res : null;
        }
    }
