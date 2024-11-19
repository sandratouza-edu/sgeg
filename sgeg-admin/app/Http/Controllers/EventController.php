<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Event;
use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatUser;
use App\Models\User;
use App\Models\Role;
use App\Models\Degree;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        $rooms = Room::all();
        
        return view('event.index', compact('events', 'rooms'));
    }

    public function reserve()
    {
    //    $users = User::with('seat')->get();
        $user = User::find(2);
        $seats = Seat::all();
       // $seats = User::with('user')->get();
        
        return view('actions.reserve', compact('user', 'seats'));
    }

    public function staircase()
    {
    //    $users = User::with('seat')->get();
        
        $seats = Seat::all();
       // $seats = User::with('user')->get();
        
        return view('actions.staircase', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        $roles = Role::all();
        $degrees = Degree::all();
        $users = User::with('roles')->with('degree')->get();

        return view('event.create', compact('rooms',  'degrees', 'roles', 'users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = [
            "title" => $request->title,
            "date" => $request->date,
            "room_id" => $request->room_id,
            "description" => $request->description,
        ];
        Event::create($data);
        
        return redirect()->route('event.index')->with('success', 'event Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): View
    {
        $rooms = Room::all();

        return view('event.show', compact('event', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $rooms = Room::all();
        $roles = Role::all();
        $degrees = Degree::all();
        $users = User::with('roles')->with('degree')->get();

        return view('event.edit', compact('event', 'rooms',  'degrees', 'roles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $event->update($request->all()); 

        return redirect()->route('event.index')->with('success', 'event Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('event.index')->with('danger', 'event Deleted');
    
    }
}
