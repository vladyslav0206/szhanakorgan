<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsPosition;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Rubric;
use App\Models\Specialist;
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

class SpecialistsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'specialists');
    }

    public function index()
    {
        $row = Specialist::orderBy('id','desc')
            ->groupBy('specialists.id')
            ->select('specialists.*');


        $row = $row->paginate(20);

        return  view('admin.specialists.specialists',[
            'row' => $row,
        ]);
    }

    public function create()
    {
        $row = new Specialist();
        $row->image = '/img/default.png';
        $row->name = ' ';
        $row->spec= ' ';
        $row->description = ' ';

        return  view('admin.specialists.specialists-edit', [
            'title' => 'Добавить',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $specialist = new Specialist();
        $specialist->name  = $request->name;
        $specialist->spec  = $request->spec;
        $specialist->description  = $request->description;
        //$image = $request->file('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!is_null($image)) {
                $specialist->image  = $image->getClientOriginalName();
            }
            if ($image != null && is_file("images/")) {
                self::delete_files("images/" . $specialist->filename . "/");
            }

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }
        $specialist->save();
        return redirect('/admin/specialists');
    }

    public function edit($id)
    {
        $row = Specialist::where('id',$id)->first();

        return  view('admin.specialists.specialists-edit',[
            'title' => 'Изменить',
            'row' => $row,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $specialist = Specialist::find($id);
        $specialist->name  = $request->name;
        $specialist->spec = $request->spec;
        $specialist->description  = $request->description;

        $specialist->image = $request->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!is_null($image)) {
                $specialist->image  = $image->getClientOriginalName();
            }
            if ($image != null && is_file("images/")) {
                self::delete_files("images/" . $specialist->filename . "/");
            }

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }
        $specialist->save();
        return redirect('/admin/specialists');
    }

    public function destroy($id)
    {
        $specialist = Specialist::where('id',$id)->first();
        $specialist->delete();
    }

}
