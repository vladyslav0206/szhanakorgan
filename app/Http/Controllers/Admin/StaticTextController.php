<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsPosition;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Rubric;
use App\Models\StaticText;
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

class StaticTextController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'statictext');
    }

    public function index()
    {
        $row = StaticText::orderBy('id','desc')
            ->groupBy('static_text.id')
            ->select('static_text.*');


        $row = $row->paginate(20);

        return  view('admin.statictext.statictext',[
            'row' => $row,
        ]);
    }

    public function create()
    {
        $row = new StaticText();
        $row->name = ' ';
        $row->description = ' ';

        return  view('admin.statictext.statictext-edit', [
            'title' => 'Добавить',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $statictext = new StaticText();
        $statictext->name  = $request->name;
        $statictext->description  = $request->description;
        $statictext->save();
        return redirect('/admin/statictext');
    }

    public function edit($id)
    {
        $row = StaticText::where('id',$id)->first();
        return  view('admin.statictext.statictext-edit',[
            'title' => 'Изменить',
            'row' => $row,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $statictext = StaticText::find($id);
        $statictext->name  = $request->name;
        $statictext->description  = $request->description;
        $statictext->save();
        return redirect('/admin/statictext');
    }

    public function destroy($id)
    {
        $statictext = StaticText::where('id',$id)->first();
        $statictext->delete();
    }

}
