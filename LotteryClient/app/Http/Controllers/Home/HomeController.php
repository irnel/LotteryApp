<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $service;
    protected $events;

    public function __construct(ApiInterface $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = $this->service->getAllAvailableEvents();
        return view('home')->with('events', $events);
    }

    public function events() 
    {
        return datatables()
            ->collection($this->service->getAllAvailableEvents())
            ->make(true);
    }
}
