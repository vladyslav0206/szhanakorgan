<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;
use Session;

use Illuminate\Support\Facades\Response;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'menu');
    }

    public function index()
    {
        
        $row = Menu::orderBy('id','desc')
            ->groupBy('menu.id')
            ->select('menu.*');
        $booked_status = DB::table('role')->where('role_id', 1)->first()->booked_status;
        $row = $row->paginate(20);

        return  view('admin.menu.menu',[
            'row' => $row,
            'booked_status' => $booked_status,
        ]);
    }

    public function create()
    {
        $row = new Menu();
        $row->name = '';
        $row->url = '';
        $row->position = '';
        $row->description = ' ';
        $row->is_show = 1;

        return  view('admin.menu.menu-edit', [
            'title' => 'Добавить',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->name  = $request->name;
        $menu->url  = $request->url;
        $menu->is_show  = $request->is_show;
        $menu->description  = $request->description;
        $menu->position  = $request->position;
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            if (!is_null($image)) {
                $menu->image  = $image->getClientOriginalName();
            }
            $menu->save();

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }
        //dd($menu);

        $menu->save();
        return redirect('/admin/menu');
    }

    public function edit($id)
    {
        $row = Menu::where('id',$id)->first();

        return  view('admin.menu.menu-edit',[
            'title' => 'Изменить',
            'row' => $row,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $menu = Menu::find($id);
        $menu->name  = $request->name;
        $menu->url  = $request->url;
        $menu->is_show  = $request->is_show;
        $menu->description  = $request->description;
        $menu->position  = $request->position;
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            if (!is_null($image)) {
                $menu->image  = $image->getClientOriginalName();
            }
            $menu->save();

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }

        $menu->save();
        return redirect('/admin/menu');
    }

    public function destroy($id)
    {
        $menu = Menu::where('id',$id)->first();
        $menu->delete();
    }
    
    public function getResult(Request $request)
    {
        DB::table('role')
            ->where('role_id', 1)
            ->update(['booked_status' => $request->booked]);
        return back();
    }

}
