<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       // print_r($request);
      // $rez = $request[0];
      //  $rez['place']

      //  Ticket::created($request['place'][0]); 
        // Ticket::created(['place_id'=> 91, 'session_id'=> 4, 'price'=> 280]);  //$request['place'];
        DB::table('tickets')->insert($request['place']);
        return $request['place']; 
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket, $id)
    {
        $rez = DB::table('tickets')
              ->where('nomerB', $id)  
             ->join('places', 'places.id', '=', 'tickets.place_id')
             ->join('sessions', 'sessions.id', '=', 'tickets.session_id')    
             ->join('films', 'films.id', '=', 'sessions.film_id')   
             ->join('cinemas', 'cinemas.id', '=', 'places.cinema_id')  
             ->select('places.seatNumber', 'tickets.price', 'sessions.timBegin', 'tickets.datSession', 'films.name', 'cinemas.name as zal')
            ->get();  

     /*   $namef
        $cinema
        $sessions
     */

        return view('payment', [
            'rez' => $rez,
            'bilet' => $id,
            ]);
    }

    public function qrCode($id)
    {
        $rez = DB::table('tickets')
        ->where('nomerB', $id)  
        ->join('places', 'places.id', '=', 'tickets.place_id')
        ->join('sessions', 'sessions.id', '=', 'tickets.session_id')    
        ->join('films', 'films.id', '=', 'sessions.film_id')   
        ->join('cinemas', 'cinemas.id', '=', 'places.cinema_id')  
        ->select('places.seatNumber', 'tickets.price', 'sessions.timBegin', 'tickets.datSession', 'films.name', 'cinemas.name as zal')
        ->get(); 
        $seans = $rez[0]->datSession; 
        $timBegin = $rez[0]->timBegin;
        $mesto="";
        foreach($rez as $element) {
            $mesto .= $element->seatNumber;
        }
            
    
        return view('ticket', [
            'qrCod' => QrCode::size(180)->generate("['".$seans."', '".$timBegin."' , '".$mesto."']"),
            'rez' => $rez,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
