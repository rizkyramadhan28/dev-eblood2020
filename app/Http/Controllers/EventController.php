<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function all() {
        $events = Event::all();

        return response()->json([
            "event" => $events,
            "status" => "Success",
            "success" => true
        ], 200);
    }

    public function new(Request $request) {
        $validation = $request->validate([
            'date' => 'required',
            'user' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);

        $event = Event::create($request->all());

        if ($event) {
            return response()->json([
                "event" => $event,
                "status" => "Success",
                "success" => true
            ], 200);
        }

        return response()->json([
            "validation" => $validation,
            "status" => "Failed",
            "success" => false
        ], 400);
    }

    public function get(Request $request, $id) {
        $event = Event::whereId($id)->first();

        if ($event) {

            return response()->json([
                "event" => $event,
                "status" => "Success",
                "success" => true
            ], 200);
        }

        return response()->json([
            "status" => "Failed",
            "success" => false
        ], 400);
    }

    public function update(Request $request, $id) {
        $event = Event::whereId($id)->first();

        if ($event) {
            $validation = $request->validate([
                'date' => 'min:5|max:255',  
                'user' => 'min:5|max:255',
                'description' => 'min:5|max:255',
                'address' => 'min:5|max:255',
            ]);

            if ($validation) {
                if ($event) {
                    $event->update($request->all());
    
                    return response()->json([
                        "status" => "Success",
                        "success" => true
                    ], 200);
                }
            }
        }

        return response()->json([
            "status" => "Failed",
            "success" => false
        ], 400);
    }

    public function delete($id) {
        $event = Event::whereId($id)->first();

        if ($event) {

            $event->delete();

            return response()->json([
                "status" => "Success",
                "success" => true
            ], 200);
        }

        return response()->json([
            "status" => "Failed",
            "success" => false
        ], 400);
    }
}
