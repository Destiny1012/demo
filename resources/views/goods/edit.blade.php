@extends('layouts.app') 
@section('title', '商品管理') 
@section('style')
<link rel="stylesheet" href="{{ asset('css/goods.css') }}">
@endsection
 
@section('page', '添加商品') 
@section('container')
<div class="row">
    <div class="col">
        <div class="card card-default goods-card">
            <div class="card-header">添加商品</div>
            <div class="card-body row">
                <div class="col-lg-5 offset-lg-1 col-10 offset-1 goods-store">
                    <form action="{{ route('goods.update', $goods->id) }}" method="post" enctype="multipart/form-data">
                        @csrf {{ method_field('PATCH') }}
                        <div class="form-row col-lg-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="image">图片：</label>
                                </div>
                                <div class="image-box">
                                    <input type="file" name="image" id="image" title="上传图片" accept="image/*">
                                    <img class="image" src="{{ asset('storage/' . $goods->image) }}">
                                    <div class="image-bg">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="name">名称：</label>
                                </div>
                                <input class="form-control" type="text" name="name" id="name" value="{{ $goods->name }}" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="price">价格：</label>
                                </div>
                                <input class="form-control" type="number" step="0.01" name="price" id="price" value="{{ $goods->price }}" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="sale">折扣：</label>
                                </div>
                                <input class="form-control" type="number" step="1" name="sale" id="sale" value="{{ $goods->sale }}">
                                <div class="input-group-append">
                                    <label class="input-group-text" for="sale">折</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="surplus">总数：</label>
                                </div>
                                <input class="form-control" type="number" step="1" name="surplus" id="surplus" value="{{ $goods->surplus }}">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="catalog">分类：</label>
                                </div>
                                <select class="custom-select" name="catalog" id="catalog">
                                    <option value="请选择分类">请选择分类</option>
                                    @foreach($catalogs as $catalog)
                                    @if ($catalog->catalog == $goods->catalog)
                                    <option value="{{ $catalog->catalog }}" selected>{{ $catalog->catalog }}</option>
                                    @else
                                    <option value="{{ $catalog->catalog }}">{{ $catalog->catalog }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="description">描述：</label>
                                </div>
                                <textarea class="form-control" name="description" id="description" rows="4">{{ $goods->description }}</textarea>
                            </div>
                            <div class="input-group">
                                <input class="btn btn-block btn-secondary" type="submit" value="上传商品">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 offset-lg-1 col-10 offset-1 goods-catalog">
                    <div class="col-lg-8">
    @include('shared.errors')
                        <button class="btn btn-link" id="catalog-control" type="button">添加分类？</button>
                        <div class="catalog-box" hidden>
                            <div class="row">
                                @foreach($catalogs as $catalog)
                                <form class="col-9" action="{{ route('catalog.update', $catalog->id) }}" method="post">
                                    @csrf {{ method_field('PATCH') }}
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="catalog" value="{{ $catalog->catalog }}">
                                        <button class="btn btn-success" type="submit">修改</button>
                                    </div>
                                </form>
                                <form class="col-3" action="{{ route('catalog.destroy', $catalog->id) }}" method="post">
                                    @csrf {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" type="submit">删除</button>
                                </form>
                                @endforeach
                                <form action="{{ route('catalog.store') }}" method="post">
                                    @csrf
                                    <div class="input-group ">
                                        <input class="form-control" type="text" name="catalog">
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="submit">添加</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection