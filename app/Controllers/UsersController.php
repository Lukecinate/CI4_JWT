<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class UsersController extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        $res = $this->model->getUsers();
        if($res){
            echo json_encode($res, JSON_PRETTY_PRINT);
        }
        else{
            $this->respond(['error' => 'Token has expired', ResponseInterface::HTTP_CLIENT_CLOSED_REQUEST]);
        }
    }

}
