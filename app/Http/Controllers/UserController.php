<?php

namespace freeads\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use freeads\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'min:6|confirmed',
        ]);
    }

    public function index()
    {
        $user = User::all();
        return view('index', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = DB::table("users")->where("id", Auth::user()->id);
        if($user)
        {
            if($request->password !== null && $request->password === $request->password_confirmation)
            {   
                $user = DB::table("users")
                ->where("id", Auth::user()->id)
                ->update(array("name" => $request->name, "password" => bcrypt($request->password), "email" => $request->email));
                return redirect('home')->with('success', 'PA PAPAPAPAPA PAWWWWWWW !!!!!!!!!!!!!!!!');
            }
            else if($request->password === null && $request->password === $request->password_confirmation)
            {   
                $user = DB::table("users")
                ->where("id", Auth::user()->id)
                ->update(array("name" => $request->name, "email" => $request->email));
                return redirect('home')->with('success', 'PA PAPAPAPAPA PAWWWWWWW !!!!!!!!!!!!!!!!');
            }
            return redirect('home')->with('danger', 'WHAT THE FOX SAYSSSSSS ??????');
        }
        return redirect('home')->with('success', 'WOOOOOOOOT');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return view('show', ['user' => $user]);
        }
        return redirect('index')->with('danger', 'WOOOOOOOOOOOOOOOOOW TU FAIT QUOI LA !! RESTE TRANQUILLLLLLLLE !!! AH OUAI !!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = DB::table("users")
            ->where("id", Auth::user()->id)
            ->delete();
    }


}
