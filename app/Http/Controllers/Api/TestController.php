<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Model\TokenModel;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
        public function sendB(){
            $data='天王盖地虎';
            $key=openssl_get_publickey(file_get_contents(storage_path('keys/b_pub.key')));
            openssl_public_encrypt($data,$enc_data,$key);
            $base64_data=base64_encode($enc_data);

            $url='http://api.1910.com/sendA?data='.urlencode($base64_data);

            //接受响应
            $response=file_get_contents($url);
           // echo $response;
            $json_arr=json_decode($response,true);
            $enc_data=base64_decode($json_arr['data']);
            $key=openssl_get_privatekey(file_get_contents(storage_path('keys/a_priv.key')));
            openssl_private_decrypt($enc_data,$dec_data,$key);
            echo $dec_data;
        }

    public function sign(){
        $data='massss';
        $key=openssl_get_privatekey(file_get_contents(storage_path('keys/a_priv.key')));
        openssl_sign($data,$sign_data,$key,OPENSSL_ALGO_SHA1);
        $data=urlencode($data);
        $sign_data=urlencode(base64_encode($sign_data));
        $url='http://api.1910.com/sign?data='.$sign_data."&name=".$data;
        $response=file_get_contents($url);
        echo $response;
    }
}
