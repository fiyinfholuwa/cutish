<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials', compact('testimonials'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'image' => 'nullable|image|max:2048',
        'status' => 'required|in:active,inactive'
    ]);

    $data = $request->except('image');

    if ($request->hasFile('image')) {
        $file = $request->file('image');

        // Path inside public/
        $folder = public_path('testimonials');

        // Create folder if it does not exist
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Generate unique filename
        $filename = time() . '_' . $file->getClientOriginalName();

        // Move file to public/testimonials
        $file->move($folder, $filename);

        // Save relative path in DB
        $data['image'] = 'testimonials/' . $filename;
    }

    Testimonial::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Testimonial added successfully'
    ]);
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive'
        ]);
        
        $testimonial = Testimonial::findOrFail($id);
        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
    
            // Path inside public/
            $folder = public_path('testimonials');
    
            // Create folder if it does not exist
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
    
            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Move file to public/testimonials
            $file->move($folder, $filename);
    
            // Save relative path in DB
            $data['image'] = 'testimonials/' . $filename;
        } 
        $testimonial->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Testimonial updated successfully'
        ]);
    }
    
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        
        $testimonial->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Testimonial deleted successfully'
        ]);
    }
    
    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return response()->json($testimonial);
    }
}