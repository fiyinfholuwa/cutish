<?php
// app/Http/Controllers/Admin/AppointmentController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AvailableService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['user', 'service'])
            ->latest()
            ->paginate(10);
            
        return view('admin.appointments', compact('appointments'));
    }
    
    public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);
    
        Appointment::where('id', $request->appointment_id)
            ->update(['status' => $request->status]);
    
        return response()->json(['success' => true]);
    }
    

    
    public function edit($id)
    {
        $appointment = Appointment::with(['user', 'service'])->findOrFail($id);
        $services = AvailableService::where('status', 'active')->get();
        
        return view('admin.appointments.edit', compact('appointment', 'services'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'available_service_id' => 'required|exists:available_services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'location_type' => 'required|in:home,venue',
            'address' => 'required_if:location_type,home',
            'price' => 'required|numeric',
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);
        
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        
        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment updated successfully');
    }
}