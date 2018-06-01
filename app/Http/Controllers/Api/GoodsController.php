<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goods;
use App\Http\Resources\GoodsResource;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $goods = Goods::where('catalog', $request->catalog)->get();
        $goods = new GoodsResource(Goods::where('catalog', $request->catalog)->paginate(10));
        return $goods;
    }
}
