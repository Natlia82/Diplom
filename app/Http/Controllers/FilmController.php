<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *Отобразите список ресурсов.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
     //
    }

  
    
    /**
     * Show the form for creating a new resource.
     * Отобразите форму для создания нового ресурса.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * Сохраните вновь созданный ресурс в хранилище.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = DB::table('films')->insertGetId($request->validate([
            'country' => 'required|string|max:200',
            'description' => 'required|string',
            'duration' => 'required|numeric',
            'name' => 'required|string',
        ]));
       
        $film = DB::table('films')->where('id', $id)->get();
        return $film;
    }

    /**
     * Display the specified resource.
     * Отобразить указанный ресурс.
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Отобразите форму для редактирования указанного ресурса.
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Обновите указанный ресурс в хранилище.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * Удалите указанный ресурс из хранилища.
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film, $id)
    {
        $flight = Film::find($id)->delete();
        return "ok";
    }
}
