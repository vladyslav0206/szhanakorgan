<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsPosition;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Rubric;
use App\Models\FeedBack;
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

class FeedBackController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'feedback');
    }

    public function index()
    {
        $row = FeedBack::orderBy('id','desc')
            ->groupBy('feedback.id')
            ->select('feedback.*');


        $row = $row->paginate(20);

        return  view('admin.feedback.feedback',[
            'row' => $row,
        ]);
    }

    public function create()
    {
        $row = new FeedBack();
        $row->name = ' ';
        $row->description = ' ';

        return  view('admin.feedback.feedback-edit', [
            'title' => 'Добавить',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $feedback = new FeedBack();
        $feedback->name  = $request->name;
        $feedback->description  = $request->description;
        $feedback->save();
        return redirect('/admin/feedback');
    }

    public function edit($id)
    {
        $row = FeedBack::where('id',$id)->first();
        return  view('admin.feedback.feedback-edit',[
            'title' => 'Изменить',
            'row' => $row,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $feedback = FeedBack::find($id);
        $feedback->name  = $request->name;
        $feedback->description  = $request->description;
        $feedback->save();
        return redirect('/admin/feedback');
    }

    public function destroy($id)
    {
        $feedback = FeedBack::where('id',$id)->first();
        $feedback->delete();
    }

}
