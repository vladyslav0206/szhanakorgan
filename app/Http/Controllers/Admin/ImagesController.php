<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\Images;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Menu;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

use Illuminate\Support\Facades\Response;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'images');
    }

    public function index()
    {
        $row = Menu::all();
        $gallery = Images::where('menu_id', 0)->get();

        return  view('admin.images.images',[
            'row' => $row,
            'gallery' => $gallery,
        ]);
    }

    public function create()
    {
        $menus = Menu::all();
        $row = new Images();
        return  view('admin.images.images-edit', [
            'title' => 'Добавить',
            'row' => $row,
            'menus' => $menus,
        ]);
    }

    public function store(Request $request)
    {
        $images = $request->file('image');
        if ($request->hasFile('image')) {
            foreach ($images as $img){
                if (!is_null($img)) {
                    $image = new Images();
                    $image->menu_id = $request->menu_id;
                    $image->image  = $img->getClientOriginalName();
                    $image->save();
//                    if ($img != null && is_file("images/")) {
//                        self::delete_files("images/" . $img->image . "/");
//                    }
                    file_put_contents('images/'. $img->getClientOriginalName(), file_get_contents($img->getRealPath()));
                }
            }
        }
        return redirect('/admin/images');
    }

    public function edit($id)
    {
            if($id >0){
                $row = Menu::where('id',$id)->first();
            }else{
                $row = null;
            }

            $gallery = Images::where('menu_id', $id)->get();
        // dd($gallery);
        return  view('admin.images.images-edit',[
            'title' => 'Изменить',
            'row' => $row,
            'gallery' =>$gallery
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
    }

    public function destroy($id)
    {
        $img = Images::where('id',$id)->first();
        $img->delete();
        self::delete_files("images/" . $img->image . "/");
    }
}
