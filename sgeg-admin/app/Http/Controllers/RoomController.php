<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $rooms = Room::get();

        return view('room.index', compact('rooms'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        return view('room.create');
    }


     

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Room::create($request->all());
        /*
        $data = [
            'name' => "Marie Courie",
            'structure' => [
                'description' => 'se define areas,   secciones   y  filas por columnas',
                'numareas' => 2,
                'areas' => [
                    [
                        'name' => 'area1',
                        'numsections' => '4',
                        'sections' => [
                            [  'name' =>'section 1',
                                            'rows' =>'10',
                                            'cols' => 10
                                            ],
                            [  'name' =>'section 2',
                                            'rows' =>'10',
                                            'cols' => 10
                                            ],
                            [  'name' =>'section 3',
                                            'rows' =>'10',
                                            'cols' => 10
                                            ],
                            [  'name' =>'section 4',
                                            'rows' =>'10',
                                            'cols' => 10
                                            ],

                        ]
                    ],
                    [
                        'name' => 'area2',
                        'numsections' => '2',
                        'sections' => [
                            ['name' =>'section 1',
                                            'rows' =>'10',
                                            'cols' => 15
                                            ],
                            ['name' =>'section 2',
                                            'rows' =>'10',
                                            'cols' => 15
                                            ],
                            

                        ]
                    ]
                ]
            ]
        ];

        $room =  Room::create($data);
        */
        return redirect()->route('room.index')->with('success', 'Room Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): View
    {
 
        return view('room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room): View
    {
        
        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room): RedirectResponse
    {
        $room->update($request->all()); 
dd($room);
        return redirect()->route('room.index')->with('success', 'Room Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Room $room): RedirectResponse
    {
        $room->delete();

        return redirect()->route('room.index')->with('danger', 'Room Deleted');
    
    }

}
