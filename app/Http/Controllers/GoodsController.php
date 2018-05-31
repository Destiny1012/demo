<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Goods;
use App\Catalog;

class GoodsController extends Controller
{
    /**
     * 控制器构造器
     *
     * 未登录认证用户仅可使用登录功能
     */
    public function __construct()
    {
        $this->middleware('guest')->only('login');
        $this->middleware('auth')->except('login');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Goods::paginate(10);
        return view('goods.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogs = Catalog::all();
        return view('goods.create', compact('catalogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image',
            'name' => 'required|unique:goods',
            'price' => 'required|digits_between:0.01,999',
            'sale' => 'nullable|digits_between:0,10',
            'surplus' => 'required|integer',
            'catalog' => 'required|exists:catalogs,catalog',
            'description' => 'nullable',
        ]);

        if (empty($validatedData['image'])) {
            $path = 'goods/none.jpg';
        } else {
            $path = Storage::putFile('/goods', $validatedData['image']);
        }

        Goods::create([
            'image' => $path,
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'sale' => $validatedData['sale'],
            'surplus' => $validatedData['surplus'],
            'sold' => 0,
            'catalog' => $validatedData['catalog'],
            'description' => $validatedData['description'],
        ]);

        session()->flash('success', $path);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'image',
            'name' => 'required|unique:goods',
            'price' => 'required|digits_between:0.01,999',
            'sale' => 'nullable|digits_between:0,10',
            'surplus' => 'required|integer',
            'catalog' => 'required|exists:catalogs,catalog',
            'description' => 'nullable',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goods = Goods::find($id);
        Storage::delete($goods->image);
    }

    public function test()
    {
        $goods = Goods::all();
        $catalogs = Catalog::all();
        return compact($goods, $catalogs);
    }
}
