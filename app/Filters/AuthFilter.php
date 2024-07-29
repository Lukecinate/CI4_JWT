<?php

namespace App\Filters;

use CodeIgniter\Config\Services;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    use ResponseTrait;
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // initiallize
        $response = service('response'); 
        $cookies = $request->getCookie('token');
        $key = getenv('SECRET_KEY');
        $token = $cookies;

        // Logic
        // checking the cookies
        if(!$cookies) 
            return $response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);

        // checking the token
        if(!$token) 
            return Services::response()->setJSON(['error' => 'Needed token'])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);

        try {
            // decoded the token
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            // set the result of decoded token
            $data = [
                'token' => $token,
                'email' => $decoded->email,
                'name' => $decoded->name,
                'Roles' => $decoded->Roles
            ];
            echo json_encode($data, JSON_PRETTY_PRINT);
        }catch(\Firebase\JWT\ExpiredException $exp){
            return Services::response()->setJson(['error' => 'Token has expired'])->setStatusCode(ResponseInterface::HTTP_CLIENT_CLOSED_REQUEST);
        }catch(\Exception $e){
            return Services::response()->setJson(['error' => 'Token invalid'])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
