<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Goods;
use App\Http\Resources\GoodsResource;

class GoodsController extends Controller
{
    /**
     * 返回商品分页
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'catalog' => 'required|exists:catalogs,catalog',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'err' => 1,
                'msg' => $validatedData->errors(),
            ]);
        }

        $goods = new GoodsResource(Goods::where('catalog', $request->catalog)->paginate(10));
        return $goods;
    }
}
