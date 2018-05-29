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
                <div class="col-md-5 offset-md-1">
                    <form action="{{ route('goods.create') }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">商品图片：</label>
                            <div class="image-box">
                                <input type="file" name="image" id="image" title="上传图片" accept="image/*">
                                <img class="image image-ctrl" src="">
                                <div class="image-bg">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">456</div>
            </div>
        </div>
    </div>
</div>
@endsection