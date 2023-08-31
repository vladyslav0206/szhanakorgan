<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use Auth;
use View;
use DB;



class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Request $request)
    {
        $booked_status = DB::table('role')->first();
        return  view('admin.index.index', compact('booked_status'));
    }

    public function getUrl(Request $request){
        $result['result'] = \App\Http\Helpers::getTranslatedSlugRu($request->word);
        return response()->json($result);
    }

    public function getOrderCount(){
        $result['status'] = true;
        $result['comment_count'] = Comment::where('is_view','=','0')->count();
        $result['contact_count'] =  Contact::where('is_show','=','0')->count();
        return response()->json($result);
    }
    
    public function indexContact(Request $request)
    {
        $contact = DB::table('contact_page')->first();
        return  view('admin.index.contact', compact('contact'));
    }
    
    public function indexUpdateContact(Request $request)
    {
        $contact = DB::table('contact_page')->update([
                        'address' => $request->address,
                        'reg' => $request->reg,
                        'tel_time' => $request->tel_time,
                        'email' => $request->email,
                        'beneficiar' => $request->beneficiar
                        ]);
        return  back();
    }
    
}
