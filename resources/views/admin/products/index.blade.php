@extends('layouts.admin_app')
@section('content')

<h2>後台--我的產品</h2>
<span>產品總數:{{ $ProductCount }}</span>
<div>
    <input type="button" class="import" value="匯入 Excel ">
</div>
@if ($errors -> any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    </div>
    
@endif
<table>
    <thead>
        <tr>
            <td>編號</td>
            <td>標題</td>
            <td>內容</td>
            <td>價格</td>
            <td>數量</td>
            <td>圖片</td>
            <td>功能</td>

        </tr>
    </thead>
    <tbody>
        @foreach ($Products as $Product)
            <tr>
                <td>{{$Product -> id}}</td>
                <td>{{$Product -> title}}</td>
                <td>{{$Product -> content}}</td>
                <td>{{$Product -> price}}</td>
                <td>{{$Product -> quantity}}</td>
                <td><img src="{{ $Product -> image_url}}" alt=""></td>
                <td>
                    <input type="button" class="upload_img" data-id={{$Product -> id}} value = "上傳圖片">
                </td>
                
            </tr>
        @endforeach

    </tbody>
</table>

{{-- 分頁 --}}
<div>
    @for ($i = 1; $i <= $ProductPages; $i++)
        <a href = "/admin/products?page={{$i}}">第 {{$i}} 頁</a> &nbsp;
    @endfor
</div>
{{-- {{dd(DB::getQueryLog())}} --}}

<script>
    $('.upload_img').click(function(){
        $('#product_id').val($(this).data('id'))
        $('#upload_img').modal()
    })

    $('.import').click(function(){
        $('#import').modal()
    })

</script>
@endsection