<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //chart
        // Mendapatkan tanggal saat ini dan 4 minggu sebelumnya

        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subMonth();



        $data = [
            'title' => 'Dashboard',
            'users' => User::count(),
        ];
        return view('admin.dashboard', $data);
    }
}