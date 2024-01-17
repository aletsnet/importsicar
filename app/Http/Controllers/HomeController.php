<?php

namespace App\Http\Controllers;

use App\Models\Space;

use Illuminate\Http\Request;

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
    public function index()
    {
        $space = Space::Where('status','1003')->first();
        if(!$space instanceof Space){
            $space = new Space;
            $space->proceso = 'Proceso ' . date('d/m/Y H:i:s');
            $space->status = 1003;
            $space->save();
        }

        $spaces = Space::Get();
        $param = [
            'spaces' => $spaces
        ];

        return view('home', $param);
    }
}
