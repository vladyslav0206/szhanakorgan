<?php

namespace App\Http\Controllers;

use App;
use App\Http\Helpers;
use App\Models\Room;
use App\Models\Book;
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

class BookController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin');
//        View::share('menu', 'rooms');
        $this->lang = 'ru';
        if($this->lang == 'qz') $this->lang = 'qz';
    }

    public function getBook()
    {
        $categories = Room::where('display', 'rooms')->get();
        $booked_status = DB::table('role')->where('role_id', 1)->first()->booked_status;

        return  view('index.index.book',[
            'categories' => $categories,
            'booked_status' => $booked_status,
        ]);
    }

    public function postBook(Request $request)
    {
        $room = Room::find($request->room_id);

        $rooms = new Book();
        $rooms->date_in  = $request->date_in;
        $rooms->date_out  = $request->date_out;
        $rooms->guest_num  = $request->guest_num;
        $rooms->room_id  = $request->room_id;
        $rooms->status  = 'Заявка';
        $rooms->price  = $request->price;
        $rooms->name  = $request->name;
        $rooms->lastname  = $request->lastname;
        $rooms->phone  = $request->phone;
        $rooms->email  = $request->email;
        $rooms->save();
        //dd($rooms->date_out);

        $to      = 'bron.sanatoriya@bk.ru';
        $subject = 'Бронирование';
        $message = 'Добрый день!'. "\r\n" .
                  'Я, '. $request->lastname.' '. $request->name .' , хотел бы забронировать комнату для '. $request->guest_num .' чел.'. "\r\n" .
                  'C '. $request->date_in .' по '. $request->date_out .'. Категории '. $room->name . "\r\n" .
                  'Контакты: '. $request->phone .', Email: '. $request->email;

        $headers ='From: '. $request->email . "\r\n" .
                  'Reply-To: bron.sanatoriya@bk.ru' . "\r\n";

        mail($to, $subject, $message, $headers);

        return redirect()->back()->withErrors(['Ваша заявка принята!!!']);
    }

    public function showBook()
    {
        $row = Book::select('book.*')->paginate(20);

        return  view('admin.book.book',[
            'title' => 'Изменить',
            'row' => $row,
        ]);
    }

    public function checkBook(Request $request,$id)
    {
        $rooms = Room::find($id);
        $rooms->name  = $request->name;
        $rooms->description  = $request->description;
        $rooms->price  = $request->price;
        $rooms->is_show  = 1;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!is_null($image)) {
                $rooms->image  = $image->getClientOriginalName();
            }
            $rooms->save();

            if ($image != null && is_file("images/")) {
                self::delete_files("images/" . $rooms->filename . "/");
            }

            if (!is_null($image)) {
                file_put_contents('images/'. $image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            }
        }



        $rooms->save();
        return redirect('/admin/rooms');
    }

    public function destroy($id)
    {
        //dd($id);
        $book = Book::where('id',$id)->first();
        $book->delete();
    }

    public function changeIsShow(Request $request){
        $news = News::find($request->id);
        $news->is_show = $request->is_show;
        $news->save();
    }
}
