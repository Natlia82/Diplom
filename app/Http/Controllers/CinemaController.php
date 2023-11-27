<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Place;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Session;
use App\Models\Ticket;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $zals = Cinema::get();
        if (!$zals->isEmpty()) {
           $places = Place::where('cinema_id', $zals[0]->id)->get();
            $maxRow = Place::where('cinema_id', $zals[0]->id)->max('row');
            $maxColum = Place::where('cinema_id', $zals[0]->id)->max('colum');
        } else {
            $zals =[];
            $places = [];
            $maxRow = "";
            $maxColum = "";
        }
      
      $films = Film::get();
      if ($films->isEmpty()) {
        $films = [];
    }
      $sessions = DB::table('sessions')
            ->join('films', 'films.id', '=', 'sessions.film_id')
            ->select('sessions.id', 'sessions.timBegin', 'sessions.cinema_id', 'films.name', 'films.duration')
            ->get();  
            if ($sessions->isEmpty()) {
                $sessions = [];
            }

        return view('index', [
            'zals' => $zals,
            'places' => $places,
            'row' => $maxRow,
            'colum' => $maxColum,
            'films' => $films,
            'sessions' => $sessions
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
        $film = DB::table('cinemas')->insert($request->validate([
        'name' => 'required|string',      
    ]));
   
       //return $request->input('name'); string
       return "OK";
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
     public function show(Cinema $cinema, $id)
    {
        return Cinema::find($id);
    }


    public function ticket($dat, $zal, $beg, $name)
    { 
        $rowMax = Place::where('cinema_id', $zal)->max('row');
        $place = Cinema::find($zal)->places;
       // $ticket = Ticket::where('datSession', $dat)->get();
       $ticket = DB::table('tickets')
                ->where('datSession', $dat)
                ->where('session_id', $beg)
                ->get();
     //   $maxColum = Place::where('cinema_id', $zal)->max('colum');
       // print_r($place);
        return view('hall', [
                            'zal' => Cinema::find($zal), 
                            'beg' => Session::find($beg),
                            'name' => Film::find($name)->name,
                            'place' => $place,
                            'pow' => $rowMax,
                            'tickets' => $ticket,
                            'dat' => $dat,
                            ]);
    }


 /*   public function ticket($dat, $zal, $beg, $name)
    {
        $row = Cinema::find($zal)->first()->maxRowPlace;
        
      //  print_r($row->row);
        $place = Cinema::find($zal)->places;
                 //->where('name', '$zal');
        print_r($place);
        return view('hall', [
                            'zal' => Cinema::find($zal)->name, 
                            'beg' => $beg,
                            'name' => $name,
                            'place' => $place,
                            'pow' => $row->row,
                            'ticket' => '',
                            ]);
    }
*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function edit(Cinema $cinema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cinema $cinema, $id)
    {
        $affected = DB::table('cinemas')
              ->where('id', $id)
              ->update($request->validate([
                'price' => 'required|numeric',
                'priceVip' => 'required|numeric',
            ]));
      //  return $request->all();
      return "OK";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cinema $cinema, $id)
    {   print_r($id);
        Cinema::find($id)->delete();
       // $allNew = Cinema::get();
        return "тест";
    }

   
}
