<?php

namespace App\Http\Controllers\Index;

use App\Models\Banner;


use DB;
use Auth;
use Cookie;
use App\Http\Helpers;
use App\Models\Room;
use App\Models\Specialist;
use App\Models\StaticText;
use App\Models\FeedBack;
use App\Models\Service;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Models\Users;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    public $lang = 'ru';

    public function __construct()
    {
        $this->lang = App::getLocale();
        if($this->lang == 'qz') $this->lang = 'qz';
    }

    public function index(Request $request)
    {
        $page = Menu::where('url', 'about')->first();
        $rooms = Room::where('display', 'rooms')->get();
        $specialists = Specialist::all();
        $feedback = FeedBack::all();
        $info1head = StaticText::where('name', 'info1head')->first();
        $info1text = StaticText::where('name', 'info1text')->first();
        $info2head = StaticText::where('name', 'info2head')->first();
        $info2text = StaticText::where('name', 'info2text')->first();
        $info3head = StaticText::where('name', 'info3head')->first();
        $info3text = StaticText::where('name', 'info3text')->first();
        $info_about_head = StaticText::where('name', 'info_about_head')->first();
        $info_about1 = StaticText::where('name', ' info_about1')->first();
        $info_about2 = StaticText::where('name', ' info_about2')->first();
        $info_about3 = StaticText::where('name', ' info_about3')->first();
        $info_about4 = StaticText::where('name', ' info_about4')->first();
        $a = StaticText::all();
        $row = Images::where('menu_id', 15)->get();
        $booked_status = DB::table('role')->where('role_id', 1)->first()->booked_status;
        //dd($info_about1, $info_about2, $info_about3, $info_about4);

        return  view('index.index.index',
            [
                'rooms' => $rooms,
                'page' => $page,
                'feedback' => $feedback,
                'specialists' => $specialists,
                'menu' => 'home',
                'row' => $request,
                'info1head' => $info1head,
                'info1text' => $info1text,
                'info2head' => $info2head,
                'info2text' => $info2text,
                'info3head' => $info3head,
                'info3text' => $info3text,
                'info_about_head' => $info_about_head,
                'info_about1' => $info_about1,
                'info_about2' => $info_about2,
                'info_about3' => $info_about3,
                'info_about4' => $info_about4,
                'row' => $row,
                'booked_status' => $booked_status,
            ]);
    }


    public function getGallery(Request $request)
    {
        $row = Images::where('menu_id', 0)->get();
        //dd($row);
        return  view('index.index.gallery',
            [
                'menu' => 'home',
                'row' => $row,
            ]);
    }
    public function getRooms(Request $request)
    {
        $rooms = Room::where('display', 'rooms')->get();
        $room_rules = StaticText::where('name', 'room_rules')->first();
        $images = Images::where('menu_id', 18)->get();
        //dd($room_rules);
        return  view('index.index.rooms',
            [
                'menu' => 'home',
                'row' => $request,
                'rooms' => $rooms,
                'room_rules' => $room_rules,
                'images' => $images,
            ]);
    }
    public function getPage(Request $request, $url,Menu $id)
    {
        $page = $id;
        $images = $page->images()->get();
        return  view('index.index.page',
            [
                'menu' => 'home',
                'row' => $request,
                'page' => $page,
                'images' => $images,
            ]);
    }
    public function getServices(Request $request)
    {
        $categories = Category::where('type','Услуга')->get();
        return  view('index.index.services',
            [
                'menu' => 'home',
                'row' => $request,
                'categories' => $categories,
            ]);
    }
    public function getService(Request $request, $id)
    {
        $service = Service::where('id',$id)->first();
        //dd($service);
        return  view('index.index.service',
            [
                'menu' => 'home',
                'row' => $request,
                'service' => $service,
            ]);
    }
    public function getSpecialist(Request $request, $id)
    {
        $specialist = Specialist::where('id',$id)->first();
        //dd($specialist);
        return  view('index.index.specialist',
            [
                'menu' => 'home',
                'row' => $request,
                'specialist' => $specialist,
            ]);
    }
    public function getLeisure(Request $request)
    {
        $categories = Category::where('type','Досуг')->get();
        return  view('index.index.leisure',
            [
                'menu' => 'home',
                'row' => $request,
                'categories' => $categories,
            ]);
    }
    public function getContacts(Request $request)
    {
        $contact = DB::table('contact_page')->first();
        
        return  view('index.index.contacts',
            [
                'menu' => 'home',
                'row' => $request,
                'contact' => $contact,
            ]);
    }
    public function getTreatment(Request $request)
    {
        $text1 = StaticText::where('name', 'about_treatment1')->first();
        $text2 = StaticText::where('name', 'about_treatment2')->first();
        $text3 = StaticText::where('name', 'about_treatment3')->first();
        $text4 = StaticText::where('name', 'about_treatment4ijn ')->first();
        //dd($text1, $text2, $text3, $text4);
        return  view('index.index.treatment',
            [
                'menu' => 'home',
                'row' => $request,
                'text1' => $text1,
                'text2' => $text2,
                'text3' => $text3,
                'text4' => $text4,
            ]);
    }
    
    public function getPitanie(Request $request)
    {
        $text = Menu::where('url', '/pitanie')->first();
        $row_img = Images::where('menu_id', 23)->get();
        return  view('index.index.pitanie',
            [
                'menu' => 'home',
                'row' => $request,
                'row_img' => $row_img,
                'text' => $text,
            ]);
    }
    
    public function getToktamys(Request $request)
    {
        $rooms = Room::where('display', 'toktamys')->get();
        $room_rules = StaticText::where('name', 'room_rules')->first();
        $images = Images::where('menu_id', 21)->get();
        //dd($room_rules);
        return  view('index.index.toktamys',
            [
                'menu' => 'home',
                'row' => $request,
                'rooms' => $rooms,
                'room_rules' => $room_rules,
                'images' => $images,
            ]);
    }

    public function sitemap() 
    {
        return view('index.index.sitemap');
    }
    

}
