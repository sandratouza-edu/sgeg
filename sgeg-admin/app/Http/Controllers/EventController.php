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
        $events = Event::with('room')->get();
        
        return view('event.index', compact('events'));
    }

    public function reserve(Request $request)
    {
       
        $seat['position'] = $request->number_id;
        $seat['is_table'] = 0;
        $seat['usable'] = 1;
        $seat['room_id'] = $request->room_id;
        $seat['status'] =  'reserved';

        $seatc = Seat::create($seat);

        $data['seat_id'] = $seatc->id;
        $data['user_id'] = $request->user_id;
        $data['update_at'] = 

        SeatUser::create($data);
    
        return response()->json(['message' => 'Asiento asignado correctamente']);

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
        $room = $event->room();
        $positions = Seat::where('room_id', $event->room_id)->pluck('position')->toArray();;
        $roles = Role::all();
        $degrees = Degree::all();
        $users = User::with('roles')->with('degree')->get();

        return view('event.edit', compact('event', 'rooms', 'degrees',  'roles', 'positions', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = [
            "title" => $request->title,
            "date" => $request->date,
            "room_id" => $request->room_id,
            "description" => $request->description,
        ];
        $event->update($data); 

        return redirect()->route('event.edit', $event)->with('success', 'event Updated');

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
