<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Search by name/title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->date);
        }

        if ($request->filled('my_events')) {
            $query->where('created_by', auth()->id());
        }

        $events = $query->paginate(9)->withQueryString();
        // return $events;
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        Event::create([
            'title'           => $request->title,
            'description'     => $request->description,
            'location'        => $request->location,
            'event_date'      => $request->event_date,
            'total_seats'     => $request->total_seats,
            'available_seats' => $request->total_seats, // initially same
            'created_by'      => auth()->id(),
        ]);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::where('id', $id)->first();
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::where('id', $id)->first();
        $this->authorize('update', $event);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, string $id)
    {
        $event = Event::where('id', $id)->first();
        $this->authorize('update', $event);
        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        $this->authorize('delete', $event);
        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Post deleted successfully');
    }
}
