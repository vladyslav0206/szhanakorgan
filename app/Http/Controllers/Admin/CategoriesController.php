<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsPosition;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Rubric;
use App\Models\Category;
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

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'categories');
    }

    public function index()
    {
        $row = Category::orderBy('id','desc')
            ->groupBy('categories.id')
            ->select('categories.*');


        $row = $row->paginate(20);

        return  view('admin.categories.categories',[
            'row' => $row,
        ]);
    }

    public function create()
    {
        $row = new Category();
        $row->name = ' ';
        $row->type = ' ';

        return  view('admin.categories.categories-edit', [
            'title' => 'Добавить',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name  = $request->name;
        $category->type  = $request->type;
        $category->save();
        return redirect('/admin/categories');
    }

    public function edit($id)
    {
        $row = Category::where('id',$id)->first();

        return  view('admin.categories.categories-edit',[
            'title' => 'Изменить',
            'row' => $row,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $category->name  = $request->name;
        $category->type  = $request->type;
        $category->save();
        return redirect('/admin/categories');
    }

    public function destroy($id)
    {
        $category = Category::where('id',$id)->first();
        $category->delete();
    }

}
