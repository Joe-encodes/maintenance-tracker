<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceRequest;
use App\Notifications\RequestStatusChanged;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @property \App\Models\User $user
 */

class MaintenanceRequestController extends Controller
{
    use AuthorizesRequests;


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * Show all requests (admin sees all, users see theirs)
     */
    public function index()
    {
        $requests = auth()->user()->is_admin
            ? MaintenanceRequest::latest()->paginate(10)
            : auth()->user()->maintenanceRequests()->latest()->paginate(10);

        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $maintenance_request)
    {
        $validated = $maintenance_request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required|in:Low,Medium,High'
        ]);

        auth()->user()->maintenanceRequests()->create($validated);

        return redirect()->route('requests.index')->with('success', 'Request submitted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Edit request (only for admins/owners)
     */
    public function edit(MaintenanceRequest $maintenance_request)

    {
        $this->authorize('update', $maintenance_request);
        return view('requests.edit', compact('maintenance_request'));
    }

    /**
     * Update the specified resource in storage.
     * Update Request Status
     */
    public function update(Request $req, MaintenanceRequest $maintenance_request)
    {
        $this->authorize('update', $maintenance_request);

        $oldStatus = $maintenance_request->status;

        $validated = $req->validate([
            'status' => 'required|in:Pending,Awaiting Approval,In Progress,Completed'
        ]);

        $maintenance_request->update($validated);

        // Send notification only if status is changed
        if ($oldStatus !== $validated['status']) {
            $maintenance_request->user->notify(new RequestStatusChanged($maintenance_request, $oldStatus));
        }

        return redirect()->route('requests.index')->with('success', 'Request Status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceRequest $maintenance_request)
    {
        $this->authorize('delete', $maintenance_request);
        $maintenance_request->delete();

        return back()->with('success', 'Request deleted!');
    }
}
