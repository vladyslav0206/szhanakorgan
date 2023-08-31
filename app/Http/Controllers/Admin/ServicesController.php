<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsPosition;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Rubric;
use App\Models\Service;
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

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'services');
    }

    public function index()
    {

        $row = Service::orderBy('id','desc')
            ->groupBy('services.id')
            ->select('services.*')
            ->paginate(20);
        //dd($row);
        return  view('admin.services.services',[
            'row' => $row,
        ]);
    }

    public function create()
    {
        $row = new Service();
        $row->name = ' ';
        $row->description = ' ';
        $row->image = '/img/default.png';
        $row->category_id = 0;
        $categories = Category::all();
        return  view('admin.services.services-edit', [
            'title' => 'Добавить',
            'row' => $row,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $service= new Service();
        $service->name  = $request->name;
        $service->description  = $request->description;
        $service->category_id  = $request->category_id;
        //$image = $request->file('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!is_null($image)) {
                $service->image  = $image->getClientOriginalName();
            }
            if ($image != null && is_file("images/")) {
                self::delete_files("images/" . $service->filename . "/");
            }

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }
        $service->save();
        return redirect('/admin/services');
    }

    public function edit($id)
    {
        $row = Service::where('id',$id)->first();
        $categories = Category::all();

        return  view('admin.services.services-edit',[
            'title' => 'Изменить',
            'row' => $row,
            'categories' => $categories,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $service = Service::find($id);
        $service->name  = $request->name;
        $service->description  = $request->description;
        $service->category_id  = $request->category_id;

        $service->image = $request->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!is_null($image)) {
                $service->image  = $image->getClientOriginalName();
            }
            if ($image != null && is_file("images/")) {
                self::delete_files("images/" . $service->filename . "/");
            }

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }
        $service->save();
        return redirect('/admin/services');
    }

    public function destroy($id)
    {
        $service = Service::where('id',$id)->first();
        $service->delete();
    }

}
