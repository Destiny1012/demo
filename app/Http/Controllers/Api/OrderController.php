<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * 返回订单分页
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orders = new OrderResource(Order::where('user', $request->user)->paginate(10));
        return $orders;
    }

    /**
     * 创建一个商品
     * Ps.小程序支付在前台进行，支付成功后再进行订单创建
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $user)
    {
        if (!User::where('name', $user)->first()) {
            $msg = '用户不存在';
            return $this->err(1, $msg);
        }
        if ($request->user <> $user) {
            $msg = '用户不统一！';
            return $this->err(1, $msg);
        }
        $goods = json_decode($request->goods, true);
        if (!$this->jsonUnique($goods)) {
            $msg = '商品重复';
            return $this->err(1, $msg);
        }
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 支付模块
     *
     * @param Request $request
     * @return Response
     */
    public function pay(Request $request)
    {
        //支付预留函数
    }

    public function jsonUnique(array $goods)
    {
        $id = '[';
        foreach ($goods as $good) {
            $id .= $good['id'] . ',';
        }
        $id = substr($id, 0, -1) . ']';
        $tre = array_unique(json_decode($id));
        $tre = json_encode($tre);
        if (strlen($id) <> strlen($tre)) {
            return false;
        } else {
            return true;
        }
    }

    public function err(Int $err, String $msg)
    {
        return [
            'err' => $err,
            'msg' => $msg,
        ];
    }
}
