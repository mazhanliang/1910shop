<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Model\TokenModel;
use Illuminate\Support\Facades\Redis;

class SignController extends Controller
{
        public function sign1(){
            $key='1910';
            $url='http://api.1910.com/api/sign';
            $data='hellow';
            $sign=sha1($data.$key);
            $url=$url.'?data='.$data.'&sign='.$sign;
            $response=file_get_contents($url);
            var_dump($response);
//            $key='1910mzl';
//            $data='hellow';
//            $sign=md5($key.$data);
//            echo '要发送的数据'.$data;
//            echo '发送前生成的签名'.$sign;
//            $url='http://www.1910.com/api/signadd?data='.$data.'&sign='.$sign;
//            echo $url;
        }

    public function sign2(){
        echo print_r($_POST);
//        $key='1910mzl';
//        $data=$_GET['data'];
//        $sign=$_GET['sign'];
//        $sign2=md5($key.$data);
//        echo '生成的签名'.$sign2;
//       if($sign==$sign2){
//           echo '通过';
//       }else{
//           echo 'no';
//       }
    }


    //对称加密
    public function encrypt1(){
         $data='马刷刷阿三发发试试水';
        $method='AES-256-CBC';
        $key='1910api';
        $iv='hellwohellwosjsj';
        $url='http://api.1910.com/enctypt';
        $enc_data=openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        $sign=sha1($enc_data,$key);
        $datas=[
            'data'=>$enc_data,
            'sign'=>$sign
        ];

        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
        //curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_exec($ch);
        $errno=curl_errno($ch);
        $errmsg=curl_error($ch);
        if($errno){
            echo '错误码：'.$errno;echo '</br>';
            var_dump($errmsg);
            die;
        }
        curl_close($ch);
    }
    //非对称加密
    public function encrypt2(){
        $data='哈市哈说法是开放';

        //公钥加密,
        $key_content=file_get_contents(storage_path('keys/pub.key'));
        $pub_key=openssl_get_publickey($key_content);
        openssl_public_encrypt($data,$enc_data,$pub_key);
        $datas=[
            'data'=>$enc_data,
        ];
        $url='http://api.1910.com/enctypt2';
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
        //curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_exec($ch);
        $errno=curl_errno($ch);
        $errmsg=curl_error($ch);
        if($errno){
            echo '错误码：'.$errno;echo '</br>';
            var_dump($errmsg);
            die;
        }
        curl_close($ch);
    }
}
