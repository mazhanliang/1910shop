<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use App\Model\GoodsModel;
use App\Model\UserModel;
use Illuminate\Http\Request;
class GoodsController extends Controller
{
        public function reg(){
            return view('goods.reg');
        }
        public function regad(){
            $model=new UserModel();
            $name=request()->post('name');
            $names=$model->where('user_name',$name)->first();
            if($names){
                return[
                    'code'=>00000,
                    'message'=>'名称已存在'
                ];
            }
            $email=request()->post('email');
            $emails=$model->where('email',$email)->first();
            if($emails){
                return[
                    'code'=>00000,
                    'message'=>'邮箱已存在'
                ];
            }
            $pwd=request()->post('pwd');
            if(strlen($pwd)<6){
                return[
                    'code'=>00000,
                    'message'=>'密码不能小于6位'
                ];
            }
            $time=time();
            $model->user_name=$name;
            $model->email=$email;
            $model->password=$pwd;
            $model->reg_time=$time;
            $add=$model->save();
            if($add){
                return[
                    'code'=>00000,
                    'message'=>'注册成功'
                ];
            }else{
                return[
                    'code'=>00001,
                    'message'=>'注册失败'
                ];
            }
        }
}
