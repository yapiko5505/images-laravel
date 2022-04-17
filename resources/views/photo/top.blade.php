<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フォト紹介</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
 @foreach($photos as $photo)  

    <div class="container mt-5">

        <!-- <h3 class="text-danger font-weight-bold">{{$photo->name}}</h3> -->
        <!-- <hr class="bg-danger"> -->
            <div class="row row-cols-3 md-5">
                @foreach(App\Models\Photo::where('id', $photo->id)->get() as $photo)
         
                <div class="card">
                    <img style="width:100%; height:15vw; object-fit: cover;" src="{{ asset('images') }}/{{ $photo->image }}" class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold" style="display:inline;">{{ $photo->name }}</h5>
                        <hr />
                        <p class="card-text">{{ $photo->memo}}</p>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
  @endforeach 


</body>
</html>