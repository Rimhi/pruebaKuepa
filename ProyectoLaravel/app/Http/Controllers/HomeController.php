<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $surname = $request->get('surname');

        $users = User::orderBy('id','DESC')->name($name)->email($email)->phone($phone)->surname($surname)->get();
        
        return view('home',compact('users'));
    }

    public function calls($id){
       
        DB::table('users')->where('id',$id)->update(["calls"=>"si"]);
        return redirect()->route('home');
    }
}
