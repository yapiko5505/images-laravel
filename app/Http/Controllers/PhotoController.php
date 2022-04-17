<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('photo.index');
        $photos = Photo::latest()->paginate(5);
        return view('photo.index', ['photos' => $photos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            ['name' => 'required',
            'memo' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg']
        );

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath,$name);

        Photo::create([
            'name'=>request('name'),
            'memo'=>request('memo'),
            'image'=>$name
        ]);

        return redirect()->back()->with('message', 'フォトが追加されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('photo.edit', ['photo' => $photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate(
            ['name' => 'required',
            'memo' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg']
        );

        $photo = Photo::find($id);
        $name = $photo->image;
        if( $request->hasfile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath,$name);
        }
        $photo->update([
            'name'=>request('name'),
            'memo'=>request('memo'),
            'image'=>$name
        ]);
        return redirect()->route('photo.index')->with('message','フォトが更新されました。');
    }

        // update() メソッドに関してですが、編集ページなので、画像はアップロードしないで、元の画像を使うときもあるかと思います。なので、バリデーションのrequiredは消します。

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        return redirect('/photo')->with('message', 'フォトが削除されました。');
    }

    public function photoTop() {
        $photos = Photo::latest()->get();
        return view('photo.top',['photos' => $photos]);
    }
}
