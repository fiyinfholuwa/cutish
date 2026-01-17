<?php
// app/Http/Controllers/Admin/ServiceController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AvailableService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = AvailableService::latest()->paginate(10);
        return view('admin.services', compact('services'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        
        AvailableService::create($request->all());
        
        return redirect()->back()->with('success', 'Service added successfully.');

    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        
        $service = AvailableService::findOrFail($id);
        $service->update($request->all());
        return redirect()->back()->with('success', 'Service updated successfully.');
    }
    
    public function destroy($id)
    {
        $service = AvailableService::findOrFail($id);
        $service->delete();
        
        return redirect()->back()->with('success', 'Service deleted successfully.');

    }
    
    public function show($id)
    {
        $service = AvailableService::findOrFail($id);
        return response()->json($service);
    }
}