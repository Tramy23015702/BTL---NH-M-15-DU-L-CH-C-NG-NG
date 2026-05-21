<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationAdminController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'type'        => 'required|in:ban_lang,thien_nhien,van_hoa,lang_nghe',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'map_link'    => 'nullable|url',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        Destination::create($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Thêm điểm du lịch thành công!');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'type'        => 'required|in:ban_lang,thien_nhien,van_hoa,lang_nghe',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'map_link'    => 'nullable|url',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Cập nhật điểm du lịch thành công!');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Đã xóa điểm du lịch.');
    }
}
