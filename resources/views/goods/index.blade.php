@extends('layouts.app') 
@section('title', '商品管理') 
@section('style')
<link rel="stylesheet" href="{{ asset('css/goods.css') }}">
@endsection
 
@section('page', '商品列表') 
@section('container')
<div class="row">
    <div class="col">
        <div class="card card-default goods-card">
            <div class="card-header">标题</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="40px">序号</th>
                                <th scope="col" width="100px">图片</th>
                                <th scope="col" width="60px">名称</th>
                                <th scope="col" width="60px">价格</th>
                                <th scope="col" width="60px">特价</th>
                                <th scope="col">描述</th>
                                <th scope="col" width="50px">总量</th>
                                <th scope="col" width="50px">已售</th>
                                <th scope="col" width="60px">目录</th>
                                <th scope="col" width="40px">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($goods as $good)
                            <tr>
                                <th scope="row">
                                    <p>{{ $good->id }}</p>
                                </th>
                                <td><img class="goods-image" src="{{ $good->image }}" alt="{{ $good->name }}" /></td>
                                <td>
                                    <p>{{ $good->name }}</p>
                                </td>
                                <td>
                                    <p>{{ $good->price }}</p>
                                </td>
                                <td>
                                    <p>{{ $good->sale }}</p>
                                </td>
                                <td>
                                    <p>{{ $good->description }}</p>
                                </td>
                                <td>
                                    <p>{{ $good->surplus }}</p>
                                </td>
                                <td>
                                    <p>{{ $good->sold }}</p>
                                </td>
                                <td>
                                    <p>{{ $good->catalog }}</p>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $goods->links() }}
            </div>
        </div>
    </div>
</div>
@endsection