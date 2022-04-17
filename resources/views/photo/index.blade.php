@extends('layouts.app')

@section('content')
<div class="container-fluid my-2">
  <div class="row m-2">
    <div class="col">
      <h3 class="font-weight-bold">フォトボード</h3>
    </div>
    <div class="col text-right">
      <a type="button" href="{{ url('/photo/create/') }}" class="btn btn-primary text-right" role="button"><i class="fas fa-plus"></i> 新規追加</a>
    </div>
  </div>

  @if(session('message'))
    <div class="alert alert-success" role="alert">{{ session('message')}}</div>
  @endif

  <table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th scope="col">
            id
            </th>
            <th scope="col">
            画像
            </th>
            <th scope="col">
            タイトル
            </th>
            <th scope="col">
              詳細
            </th>
            <th scope="col">
              編集
            </th>
            <th scope="col">
              削除
            </th>
        </tr>
    </thead>
    <tbody>
        @if(count($photos) > 0)
        @foreach($photos as $key=>$photo)
        <tr>
            <th scope="row">
                {{ $key+1}}
            </th>
            <td style="max-width: 200px;">
                <img src="{{asset('images')}}/{{$photo->image}}" class="img-fluid" />
            </td>
            <td>
                {{$photo->name}}
            </td>
            <td style="max-width: 300px;">
                {{$photo->memo}}
            </td>
            <td>
                <a href="{{route('photo.edit',[$photo->id])}}">
                    <button type="button" class="btn btn-outline-primary"> 編集</button>
                </a>
            </td>
            <td>
                <form method="post" action="{{route('photo.destroy', $photo)}}" class="float-right">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onClick="return confirm('削除しますか？');">削除</button>
                </form> 
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6">追加されたフォトはありません。</td>
        </tr>
        @endif
    </tbody>
  </table>

  <div class="d-flex">
    <div class="mx-auto">
      {{$photos->links("pagination::bootstrap-4")}}
    </div>
  </div>

</div>
@endsection

