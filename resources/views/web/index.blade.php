@extends('layouts.app')
@section('content')
{{-- css --}}
    <style>
        .special-text{
            text-align: center;
            color: lightblue;
            background-color: rgb(187, 153, 111);
        }
    </style>
{{-- html --}}

{{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="http://code.z01.com/img/2016instbg_01.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
        <img src="http://code.z01.com/img/2016instbg_02.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
        <img src="http://code.z01.com/img/2016instbg_03.jpg" class="d-block w-100" alt="...">
    </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div> --}}
    <h2>商品列表</h2>
    <img src="https://pgw.udn.com.tw/gw/photo.php?u=https://uc.udn.com.tw/photo/2020/03/07/realtime/7564959.jpeg&x=0&y=0&sw=0&sh=0&sl=W&fw=1050" class="img-thumbnail" alt="Twice">
    <table border="1" class="table table-hover">
        <thead>
            <tr>
                <td>標題</td>
                <td>價格</td>
                <td>內容</td>
                <td>數量</td>
                <td></td>
            </tr>
        </thead>
        @foreach ($products as $product)
            <tr>
                @if ($product -> id == 1)
                    <td class="special-text">{{$product -> title}}</td>
                @else
                    <td>{{$product -> title}}</td>
                @endif
                <td style="{{$product -> price < 700 ? 'color: rgb(189, 111, 77); font-size: 22px' : ''}}">{{$product -> price}}</td>
                <td>{{$product -> content}}</td>
                <td>{{$product -> quantity}}</td>
                <td>
                    <input class="check_product" type="button" value="確認商品數量" data-id="{{$product -> id}}">
                    <input class="check_share_url" type="button" value="分享網址" data-id="{{$product -> id}}">
                </td>
            </tr>
        
        @endforeach

    </table>

{{-- javescript --}}
    <script>
        $('.check_product').on('click',function(){
            $.ajax({
                url: '/products/check-product',
                method: 'POST',
                data:{id: $(this).data('id')}
            })
            .done(function(response){
                if (response) {
                    alert('商品數量足夠')
                } else {
                    alert('商品數量不足')
                }
            })
        })

        $('.check_share_url').on('click',function(){
            var id = $(this).data('id');
            $.ajax({
                url: `/products/${id}/share-url`,
                method: 'GET',
                data:{id: $(this).data('id')}
            })
            .done(function(msg){
                alert('請分享縮網址' + msg.url); 
            })
        })
    </script>
@endsection
