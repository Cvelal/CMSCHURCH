<?php

namespace App\Http\Controllers;

use App\Event;
use DB;
use App\Setting;
use Dcblogdev\Countries\Facades\Countries;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Setting::notSet()) {
            return view('setup');
        }
        $user = \Auth::user();
        $c_types = \App\CollectionsType::getTypes();
        $eventsall =  \App\Announcement::leftjoin('users', "announcements.branch_id", '=', 'users.id')->where('announcements.branch_id', $user->id)->orWhere('announcements.branch_id', $user->id)->orderBy('announcements.id', 'desc')->get();
        $members = \App\Member::where('branch_id', $user->id)->get();
        $events = Event::where('branch_id', $user->id)->orderBy('date', 'asc')->get();
        // dd($options);
        $num_members = $user->isAdmin() ? DB::table('members')->count() : DB::table('members')->where('branch_id', \Auth::user()->id)->count();
        $num_pastors = $user->isAdmin() ? DB::table('members')->where('position', 'pastor')->orWhere('position', 'senior pastor')->count() : DB::table('members')->where('position', 'pastor')->orWhere('position', 'senior pastor')->where('branch_id', \Auth::user()->id)->count();
        $num_workers = $user->isAdmin() ? DB::table('members')->where('position', 'worker')->count() : DB::table('members')->where('position', 'worker')->where('branch_id', \Auth::user()->id)->count();
        $total = ['workers' => $num_workers, 'pastors' => $num_pastors, 'members' => $num_members];
        $currencies = Countries::all();
        $options = Setting::findName(['logo', 'name']);
        // $currencies = findName(['logo', 'name'], $options);
        $currency = auth()->user()->getCurrency();
        // get due savings
        $dueSavings = \App\CollectionCommission::dueSavings($user);
        // get the commission percentage
        $percentage = \App\Options::getLatestCommission();
        $percentage = $percentage ? (int)$percentage->value : 0;
        //
        $allDueSavings = \App\CollectionCommission::calculateUnsettledCommission(true);

        $branches = \App\User::all();
        return view('dashboard.index', compact('events', 'options', 'total', 'members', 'eventsall', 'c_types', 'currency', 'dueSavings', 'percentage', 'allDueSavings'));
    }

    public function gallery()
    {
        return view('gallery.gallery');
    }
}
