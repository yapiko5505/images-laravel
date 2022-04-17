@extends('layouts.app')

@section('content')
<div class="container mt-3" style="max-width: 720px;">
    <div class="text-right">
        <a href="{{ url('/photo') }}"> ＜戻る</a>
    </div>

    @if( session('message'))
        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
    @endif

    <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-top: 30px; margin-bottom: 30px">
            <label for="name" class="font-weight-bold">タイトル</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" />
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group" style="margin-top: 30px; margin-bottom: 30px">
            <label for="name" class="font-weight-bold">詳細</label>
            <textarea class="form-control @error('memo') is-invalid @enderror" id="textarea" rows="5" name="memo"></textarea>
            @error('memo')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group" style="margin-bottom: 30px">
            <label for="image" class="font-weight-bold">画像アップロード</label><br>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" />
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary my-3">送信</button>
    </form>
</div>
@endsection