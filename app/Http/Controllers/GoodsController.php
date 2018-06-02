<?php

namespace App\Http\Controllers;

// use Validator;
use Illuminate\Validation\Rule;
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
     * 返回商品分页
     *
     * @return Response
     */
    public function index()
    {
        $goods = Goods::paginate(10);
        return view('goods.index', compact('goods'));
    }

    /**
     * 返回添加商品页面
     *
     * @return Response
     */
    public function create()
    {
        $catalogs = Catalog::all();
        return view('goods.create', compact('catalogs'));
    }

    /**
     * 添加一个新商品
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image',
            'name' => 'required|unique:goods',
            'price' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value <= 0.01 || $value >= 999) {
                        return $fail($attribute . '必须在 0.01 到 1000 之间。');
                    }
                }
            ],
            'sale' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value < 0 || $value >= 10) {
                        return $fail($attribute . '必须在 0 到 10 之间。');
                    }
                }
            ],
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
     * 返回商品编辑页面
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $goods = Goods::find($id);
        $catalogs = Catalog::all();
        return view('goods.edit', compact('goods', 'catalogs'));
    }

    /**
     * 更新一个商品
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'image',
            'name' => [
                'required',
                Rule::unique('goods')->ignore($id),
            ],
            'price' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value <= 0.01 || $value >= 999) {
                        return $fail($attribute . '必须在 0.01 到 1000 之间。');
                    }
                }
            ],
            'sale' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value < 0 || $value >= 10) {
                        return $fail($attribute . '必须在 0= 到 10 之间。');
                    }
                }
            ],
            'surplus' => 'required|integer',
            'catalog' => 'required|exists:catalogs,catalog',
            'description' => 'nullable',
        ]);

        $goods = Goods::find($id);
        $goods->name = $validatedData['name'];
        $goods->price = $validatedData['price'];
        $goods->sale = $validatedData['sale'];
        $goods->surplus = $validatedData['surplus'];
        $goods->catalog = $validatedData['catalog'];
        $goods->description = $validatedData['description'];

        if (!empty($validatedData['image'])) {
            Storage::delete($goods->image);
            $path = Storage::putFile('/goods', $validatedData['image']);
            $goods->image = $path;
        }

        $goods->save();
        return redirect()->route('goods.index');
    }

    /**
     * 删除一个商品
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goods = Goods::find($id);
        Storage::delete($goods->image);
        $goods->delete();
    }
}
