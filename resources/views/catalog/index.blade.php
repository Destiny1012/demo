<div class="catalog-box">
    <form action="" method="post">
        @csrf
        <div class="form_group">
            <label for="catalog">目录名称</label>
            <input class="form_control" type="text" name="catalog" id="catalog">
        </div>
        <button type="submit">添加</button>
    </form>
</div>