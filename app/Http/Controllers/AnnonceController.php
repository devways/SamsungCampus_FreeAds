<?php

namespace freeads\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use freeads\User;
use freeads\Annonce;

class AnnonceController extends Controller
{

     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'max:255',
            'after_price' => 'numeric|regex:/^[0-9]+$/',
            'before_price' => 'numeric|regex:/^[0-9]+$/',
            'after_date' => 'nullable|date',
            'before_date' => 'nullable|date',
            'name_author' => 'max:255',
            'word' => 'max:255',
            'title' => 'require|max:255',
            'description' => 'require|max:955',
            'price' => 'require|numeric|regex:/^[0-9]+$/',
        ]);
    }

    public function index(Request $request) {
        $name = $request->name;
        $after_price = $request->after_price;
        $before_price = $request->before_price;
        $after_date = $request->after_date;
        $before_date = $request->before_date;
        $name_author = $request->name_author;
        $word = $request->word;
        $annonce = DB::table("users")
            ->leftJoin('annonces', 'users.id', '=', 'annonces.author_id')
            ->where('annonces.author_id', '!=', 'null')
            ->orderBy('annonces.created_at', 'asc')
            ->when($name, function ($query) use ($name) {
                    return $query->where('title', 'like', '%'.$name.'%');
                })
            ->when($after_price, function ($query) use ($after_price) {
                return $query->where('price', '>', $after_price);
                })
            ->when($before_price, function ($query) use ($before_price) {
                return $query->where('price', '<', $before_price);
                })
            ->when($after_date, function ($query) use ($after_date) {
                return $query->where('annonces.created_at', '>', $after_date. ' 00:00:00');
                })
            ->when($before_date, function ($query) use ($before_date) {
                return $query->where('annonces.created_at', '<', $before_date. ' 00:00:00');
                })
            ->when($name_author, function ($query) use ($name_author) {
                    return $query->where('name', 'like', '%'.$name_author.'%');
                })
            ->when($word, function ($query) use ($word) {
                    return $query->where('description', 'like', '%'.$word.'%');
                })
            ->get();
        return view('annonces/index', ['annonce' => $annonce]);
    }

    public function search(Request $request) {
        return view('annonces/search');
    }

    public function showNews() {
        return view('annonces/news');
    }

    public function news(Request $request, Annonce $annonce) {
        $annonce->title = $request->title;
        $annonce->description = $request->description;
        $annonce->price = $request->price;
        $annonce->author_id = Auth::user()->id;
        $annonce->photo = $request->file;
        $annonce->save();
        return redirect('annonce/new');
    }

    public function showEdit(Request $request, $id) {
        $annonce = DB::table("annonces")
            ->where('id', $id)
            ->get();
        if(isset($annonce[0])) {
            if(Auth::user()->id === $annonce[0]->author_id) {
                return view('annonces/edit', ['annonce' => $annonce[0], 'id' => $id]);
            }
            return redirect('annonce/new')->with('danger', 'WOOOOOOT TRANKIL LA');
        }
        return redirect('annonce/new')->with('danger', 'WOOOOOOT TRANKIL LA');
    }

    public function edit(Request $request, $id) {
        $annonce = DB::table("annonces")
            ->where('id', $id)
            ->get();
        if(isset($annonce[0])) {
            if(Auth::user()->id === $annonce[0]->author_id) {
                $annonce = DB::table("annonces")
                    ->where('id', $id)
                    ->update(
                        ['title' => $request->title,
                        'description' => $request->description,
                        'price' => $request->price]
                    );
                return redirect('annonce/index');
            }
            return redirect('annonce/new')->with('danger', 'WOOOOOOT TRANKIL LA');
        }
        return redirect('annonce/new')->with('danger', 'WOOOOOOT TRANKIL LA');
    }

    public function delete(Request $request, $id) {
        $annonce = DB::table("annonces")
            ->where('id', $id)
            ->get();
        if($annonce) {
            if(Auth::user()->id === $annonce[0]->author_id) {
                $annonce = DB::table("annonces")
                ->where('id', $id)
                ->delete();
            }
            return redirect('annonce/new')->with('danger', 'WOOOOOOT TRANKIL LA');
        }
        return redirect('annonce/new')->with('danger', 'WOOOOOOT TRANKIL LA');
    }

}
