<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'moderator');
    }

    public function index(Request $request)
    {
        $row = Users::where(function($query) use ($request){
                            $query->where('users.name','like','%' .$request->search .'%')
                                ->orWhere('users.phone','like','%' .$request->search .'%')
                                ->orWhere('users.email','like','%' .$request->search .'%');
                      })
                      ->where('role_id',2)
                      ->orderBy('user_id','desc')
                      ->select('users.*');

        if(isset($request->is_ban))
            $row->where('is_ban',$request->is_ban);
        else $row->where('is_ban','0');

        $row = $row->paginate(10);

        return  view('admin.moderator.moderator',[
            'row' => $row,
            'title' => 'модератор',
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Users();
        $row->avatar = '/media/default-user.png';

        return  view('admin.moderator.moderator-edit', [
                'title' => 'Новый модератор',
                'row' => $row
            ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,user_id,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.moderator.moderator-edit', [
                'title' => 'Новый модератор',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = 2;
        $user->avatar = $request->avatar;
        $user->password = Hash::make('12345');
        $user->save();
        return redirect('/admin/moderator');
    }

    public function edit($id)
    {
        $row = Users::find($id);
        return  view('admin.moderator.moderator-edit', [
            'title' => 'Изменить пользователя',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',user_id,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.moderator.moderator-edit', [
                'title' => 'Изменить',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $user = Users::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->avatar = $request->avatar;
        $user->role_id = 2;
        $user->save();

        return redirect('/admin/moderator');

    }

    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    
    public function changeIsBan(Request $request){
        $review = Users::find($request->id);
        $review->is_ban = $request->is_show;
        $review->save();
    }
}
