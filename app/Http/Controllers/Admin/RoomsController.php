<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsPosition;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Rubric;
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

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'rooms');
    }

    public function index()
    {
        $row = Room::orderBy('id','desc')
            ->groupBy('room.id')
            ->select('room.*');


        $row = $row->paginate(20);

        return  view('admin.rooms.rooms',[
            'row' => $row,
        ]);
    }

    public function create()
    {
        $row = new Room();
        $row->image = '/img/default.png';
        $row->name = ' ';
        $row->description = ' ';
        $row->price = ' ';
        $row->is_active = 1;
        $row->display = 'rooms';

        return  view('admin.rooms.rooms-edit', [
            'title' => 'Добавить комнату',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $rooms = new Room();
        $rooms->name  = $request->name;
        $rooms->description  = $request->description;
        $rooms->price  = $request->price;
        $rooms->is_show  = $request->is_show;
        $rooms->display = $request->display;
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            if (!is_null($image)) {
                $rooms->image  = $image->getClientOriginalName();
            }
            $rooms->save();
            
            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }
        $rooms->save();
        return redirect('/admin/rooms');
    }

    public function edit($id)
    {
        $row = Room::where('id',$id)->first();

        return  view('admin.rooms.rooms-edit',[
            'title' => 'Изменить',
            'row' => $row,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $rooms = Room::find($id);
        $rooms->name  = $request->name;
        $rooms->description  = $request->description;
        $rooms->price  = $request->price;
        $rooms->is_show  = $request->is_show;
        $rooms->display = $request->display;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!is_null($image)) {
                $rooms->image  = $image->getClientOriginalName();
            }
            $rooms->save();

            if ($image != null && is_file("images/")) {
                self::delete_files("images/" . $rooms->filename . "/");
            }

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }



        $rooms->save();
        return redirect('/admin/rooms');
    }

    public function destroy($id)
    {
        $news = Room::where('id',$id)->first();
        $news->delete();
    }

    public function changeIsShow(Request $request){
        $news = News::find($request->id);
        $news->is_show = $request->is_show;
        $news->save();
    }
}
