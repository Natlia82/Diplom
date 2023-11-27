<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Film;
use App\Models\Cinema;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $film = Film::get();
    /*  $film = DB::table('films')
                ->join('sessions', 'sessions.film_id', '=', 'films.id')
                ->where('sessions.sale', '>', 0)
                ->select('films.id','films.name','films.country','films.duration','films.description')
                ->groupBy('films.id')
                ->get();*/
        $countZal = Cinema::get();
        $session = Session::where('sessions.sale', '>', 0)->get(); 
       //$session = Session::get(); 
        return view('welcome', [
            'film' => $film,
            'countZal' => $countZal,
            'session' => $session
        ]);
    }

    public function datIndex($dat)
    {
        $film = DB::table('sessions')->join('films', function ($join) use ($dat) {
            $join->on('films.id', '=', 'sessions.film_id')
               ->where('sessions.datSession', '=', $dat);
         })
         ->select('films.name', 'films.img', 'films.country', 'films.duration', 'films.description', 'films.id')
         ->get();
        
         $countZal = DB::table('sessions')->join('cinemas', function ($join) use ($dat) {
            $join->on('cinemas.id', '=', 'sessions.cinema_id')
               ->where('sessions.datSession', '=', $dat);
         })
         ->select('cinemas.name', 'cinemas.id')
         ->orderByRaw('cinemas.name')
         ->get(); 
        
         $session = DB::table('sessions')
         ->join('cinemas', 'cinemas.id', '=', 'sessions.cinema_id')
         ->join('films', 'films.id', '=', 'sessions.film_id')
         ->where('sessions.datSession', '=', $dat)
         ->select('sessions.datSession', 'sessions.timBegin', 'cinemas.name', 'films.id')
         ->get(); 
        
        return view('welcome', [
            'film' => $film,
            'countZal' => $countZal,
            'session' => $session
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*timBegin: "18:00", cinema_id: "4", name: "Альфа", duration: "96"*/
        /*cinema_id: "3", timBegin: "10:00", film_id: "1"*/

        $validated = $request->validate([
            'cinema_id' => 'required|integer',
            'timBegin' => 'required',
            'film_id' => 'required|integer',
        ]);

        $rez = Session::create($validated);
      //  $nameFilm = Film::find($rez->film_id);
      $sessions = DB::table('sessions')
      ->join('films', 'films.id', '=', 'sessions.film_id')
      ->where('sessions.id', '=', $rez->id)
      ->select('sessions.timBegin', 'sessions.cinema_id', 'films.name', 'films.duration')
      ->get();  
      return $sessions;
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $rez = Session::where('sale', 0)->update(['sale'=> 1]);
        return $rez;
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session, $id)
    {
        $flight = Session::find($id)->delete();

        return "OK";
    }
}
