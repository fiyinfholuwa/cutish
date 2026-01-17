<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function update(Request $request)
    {
        $uploadPath = public_path('uploads/gallery');

        // Create directory if it doesn't exist
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Remove images
        if ($request->filled('remove')) {
            $images = Gallery::whereIn('id', $request->remove)->get();
            foreach ($images as $img) {
                $fullPath = public_path($img->path);
                if (file_exists($fullPath)) unlink($fullPath);
            }
            Gallery::whereIn('id', $request->remove)->delete();
        }

        // Replace existing images
        if ($request->hasFile('replace')) {
            foreach ($request->file('replace') as $id => $file) {
                $ext = $file->getClientOriginalExtension();
                $filename = time().'_'.uniqid().'.'.$ext;
                $file->move($uploadPath, $filename);

                Gallery::where('id', $id)->update([
                    'path' => 'uploads/gallery/'.$filename
                ]);
            }
        }

        // Add new images
        if ($request->hasFile('new_images')) {
            $count = Gallery::count();
            foreach ($request->file('new_images') as $file) {
                if ($count >= 6) break;

                $ext = $file->getClientOriginalExtension();
                $filename = time().'_'.uniqid().'.'.$ext;
                $file->move($uploadPath, $filename);

                Gallery::create([
                    'path' => 'uploads/gallery/'.$filename
                ]);

                $count++;
            }
        }

        return back()->with('success', 'Gallery updated successfully.');
    }
}
