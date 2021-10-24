<link rel="stylesheet" href="/css/app.css">
@extends('layouts.app')
@section('content')
    <h2 style="margin-top: 50px">連絡我們</h2>
    <form action="" method="POST">
        訂購人：<input type="text"><br>
        消費時間：<input type="date"><br>
        消費種類：
        <select name="" id="">
            <option value="album">專輯</option>
            <option value="book">寫真</option>
        </select><br>
        <button>確定</button>
    </form>
@endsection
