<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;

class CatalogController extends Controller
{
    /**
     * 返回所有分类
     *
     * @return Response
     */
    public function index()
    {
        $catalogs = Catalog::all();
        return $catalogs;
    }

    /**
     * 添加一个分类
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'catalog' => 'required|unique:catalogs',
        ]);

        Catalog::create([
            'catalog' => $request->catalog,
        ]);

        return redirect()->back();
    }

    /**
     * 更新一个分类
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'catalog' => 'required|unique:catalogs',
        ]);
        
        $catalog = Catalog::find($id);
        $catalog->catalog = $request->catalog;
        $catalog->save();

        return redirect()->back();
    }

    /**
     * 删除一个分类
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Catalog::destroy($id);

        return redirect()->back();
    }
}
