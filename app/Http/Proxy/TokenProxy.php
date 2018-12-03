<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/25
 * Time: 13:31
 */

namespace App\Http\Proxy;

use GuzzleHttp\Client;

class TokenProxy
{

    public function __construct(  )
    {
    }

    public function login($grantType, array $data = [])
    {
        //oauth/token

        $form_params = array_merge($data, [
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'grant_type'    => $grantType
        ]);


        $http = new Client;
        $response = $http->post(env('APP_URL', 'http://127.0.0:8080') . '/oauth/token', [
            'form_params' => $form_params,
        ]);

        $token = json_decode((string) $response->getBody(), true);

        return response()->json([
            'token'         => $token['access_token'],
            'expires_in'    => $token['expires_in'],
            'refreshToken'  => $token['refresh_token']
        ])->cookie('refreshToken', $token['refresh_token'], 14400, null, null, false, true);
    }
}
