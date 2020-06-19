<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use App\Model\GoodsModel;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index(){
        $goods_id=$_GET['id'];
        $model=new GoodsModel();
       $aaa= $model->where('goods_id',$goods_id)->first()->toArray();
        print_r($aaa);
    }
}
