<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsPosition;
use App\Models\NewsRubric;
use App\Models\Position;
use App\Models\Rubric;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'news');

        $rubric = Rubric::where('is_show',1)->get();
        View::share('rubric', $rubric);

        $position = Position::where('is_show',1)->get();
        View::share('position', $position);
    }

    public function index(Request $request)
    {
        $row = News::orderBy('news_id','desc')
            ->groupBy('news.news_id')
            ->where('is_audio','0')
            ->select('news.*',
                DB::raw('DATE_FORMAT(news.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('news.is_show',$request->active);
        else $row->where('news.is_show','1');

        if(isset($request->news_name) && $request->news_name != ''){
            $row->where(function($query) use ($request){
                $query->where('news_name_ru','like','%' .$request->news_name .'%');
            });
        }

        if(isset($request->news_name_kz) && $request->news_name_kz != ''){
            $row->where(function($query) use ($request){
                $query->where('news_name_kz','like','%' .$request->news_name_kz .'%');
            });
        }

        if(isset($request->rubric_name) && $request->rubric_name != ''){
            $row->leftJoin('news_rubric','news_rubric.news_id','=','news.news_id')
                ->leftJoin('rubric','rubric.rubric_id','=','news_rubric.rubric_id')
                ->where(function($query) use ($request){
                $query->where('rubric_name_ru','like','%' .$request->rubric_name .'%')
                    ->orWhere('rubric_name_kz','like','%' .$request->rubric_name .'%')
                    ->orWhere('rubric_name_en','like','%' .$request->rubric_name .'%');
            });
        }

        if(isset($request->position_name) && $request->position_name != ''){
            $row->leftJoin('news_position','news_position.news_id','=','news.news_id')
                ->leftJoin('position','position.position_id','=','news_position.position_id')
                ->where(function($query) use ($request){
                $query->where('position.position_name_ru','like','%' .$request->position_name .'%');
            });
        }

        $row = $row->paginate(20);

        return  view('admin.news.news',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new News();
        $row->news_image = '/img/default.png';
        $row->news_date = date("d.m.Y H:i");
        $row->news_meta_keywords_ru = 'turkistantoday.kz, информационное агентство';
        $row->news_meta_keywords_kz = 'turkistantoday.kz, ақпараттық агенттік';
        $row->news_meta_keywords_en = 'turkistantoday.kz, news of Kazakhstan';

        return  view('admin.news.news-edit', [
            'title' => 'Добавить новости',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        if ($request->news_name_ru == '' && $request->news_name_kz == '' && $request->news_name_en == '') {
            $error = "Укажите необходимые данные";
            return  view('admin.news.news-edit', [
                'title' => 'Добавить новости',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $news = new News();
        
        $news->news_name_ru  = $request->news_name_ru;
        $news->news_text_ru  = $request->news_text_ru;
        $news->news_desc_ru  = $request->news_desc_ru;
        $news->news_meta_description_ru  = $request->news_meta_description_ru;
        $news->news_meta_keywords_ru  = $request->news_meta_keywords_ru;
        $news->tag_ru  = $request->tag_ru;
        $news->author_ru  = $request->author_ru;

        $news->news_name_kz  = $request->news_name_kz;
        $news->news_text_kz  = $request->news_text_kz;
        $news->news_desc_kz  = $request->news_desc_kz;
        $news->news_meta_description_kz  = $request->news_meta_description_kz;
        $news->news_meta_keywords_kz  = $request->news_meta_keywords_kz;
        $news->tag_kz  = $request->tag_kz;
        $news->author_kz  = $request->author_kz;

        $news->news_name_en  = $request->news_name_en;
        $news->news_text_en  = $request->news_text_en;
        $news->news_desc_en  = $request->news_desc_en;
        $news->news_meta_description_en  = $request->news_meta_description_en;
        $news->news_meta_keywords_en  = $request->news_meta_keywords_en;
        $news->tag_en  = $request->tag_en;
        $news->author_en  = $request->author_en;

        $news->news_image  = $request->news_image;
        $news->user_id  = Auth::user()->user_id;
        
        $news->news_icon  = $request->news_icon;
        $news->is_watermark  = $request->is_watermark;
        
        $timestamp = strtotime($request->news_date);
        $news->news_date = date("Y-m-d H:i", $timestamp);
        $news->is_show  = 1;

        $lang = '';

        if ($request->news_name_ru != '') $lang = 'ru_';
        if ($request->news_name_kz != '') $lang .= 'kz_';
        if ($request->news_name_en != '') $lang .= 'en';

        $news->news_lang = $lang;

        $news->save();

        if(isset($request->rubric_list)){
            foreach($request->rubric_list as $val){
                $news_rubric = new NewsRubric();
                $news_rubric->news_id = $news->news_id;
                $news_rubric->rubric_id = $val;
                $news_rubric->save();
            }
        }

        if(isset($request->position_list)){
            foreach($request->position_list as $val){
                $news_position = new NewsPosition();
                $news_position->news_id = $news->news_id;
                $news_position->position_id = $val;
                $news_position->save();
            }
        }

        return redirect('/admin/news');
    }

    public function edit($id)
    {
        $row = News::where('news_id',$id)->select('*',DB::raw('DATE_FORMAT(news.news_date,"%d.%m.%Y %H:%i") as news_date'))->first();

        return  view('admin.news.news-edit', [
            'title' => 'Изменить новости',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        if ($request->news_name_ru == '' && $request->news_name_kz == '' && $request->news_name_en == '') {
            $error = "Укажите необходимые данные";
            return  view('admin.news.news-edit', [
                'title' => 'Добавить новости',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $news = News::find($id);

        $news->news_name_ru  = $request->news_name_ru;
        $news->news_text_ru  = $request->news_text_ru;
        $news->news_desc_ru  = $request->news_desc_ru;
        $news->news_meta_description_ru  = $request->news_meta_description_ru;
        $news->news_meta_keywords_ru  = $request->news_meta_keywords_ru;
        $news->tag_ru  = $request->tag_ru;
        $news->author_ru  = $request->author_ru;

        $news->news_name_kz  = $request->news_name_kz;
        $news->news_text_kz  = $request->news_text_kz;
        $news->news_desc_kz  = $request->news_desc_kz;
        $news->news_meta_description_kz  = $request->news_meta_description_kz;
        $news->news_meta_keywords_kz  = $request->news_meta_keywords_kz;
        $news->tag_kz  = $request->tag_kz;
        $news->author_kz  = $request->author_kz;

        $news->news_name_en  = $request->news_name_en;
        $news->news_text_en  = $request->news_text_en;
        $news->news_desc_en  = $request->news_desc_en;
        $news->news_meta_description_en  = $request->news_meta_description_en;
        $news->news_meta_keywords_en  = $request->news_meta_keywords_en;
        $news->tag_en  = $request->tag_en;
        $news->author_en  = $request->author_en;
        
        $news->news_image  = $request->news_image;
        $news->user_id  = Auth::user()->user_id;
        
        $news->news_icon  = $request->news_icon;
        $news->is_watermark  = $request->is_watermark;

        $timestamp = strtotime($request->news_date);
        $news->news_date = date("Y-m-d H:i", $timestamp);

        $lang = '';
        if ($request->news_name_ru != '') $lang = 'ru_';
        if ($request->news_name_kz != '') $lang .= 'kz_';
        if ($request->news_name_en != '') $lang .= 'en';

        $news->news_lang = $lang;
        
        $news->save();

        $news_rubric = NewsRubric::where('news_id','=',$news->news_id)->delete();

        if(isset($request->rubric_list)){
            foreach($request->rubric_list as $val){
                $news_rubric = new NewsRubric();
                $news_rubric->news_id = $news->news_id;
                $news_rubric->rubric_id = $val;
                $news_rubric->save();
            }
        }

        $news_position = NewsPosition::where('news_id','=',$news->news_id)->delete();

        if(isset($request->position_list)){
            foreach($request->position_list as $val){
                $news_position = new NewsPosition();
                $news_position->news_id = $news->news_id;
                $news_position->position_id = $val;
                $news_position->save();
            }
        }

        return redirect('/admin/news');
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
    }

    public function changeIsShow(Request $request){
        $news = News::find($request->id);
        $news->is_show = $request->is_show;
        $news->save();
    }
}
