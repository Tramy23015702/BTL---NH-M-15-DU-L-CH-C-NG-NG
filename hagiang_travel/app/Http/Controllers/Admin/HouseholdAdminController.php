<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseholdAdminController extends Controller
{
    public function index()
    {
        $households = Household::with('destination')->latest()->paginate(10);
        return view('admin.households.index', compact('households'));
    }

    public function create()
    {
        $destinations = Destination::where('is_active', true)->get();
        return view('admin.households.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'owner_name'     => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('households', 'public');
        }

        Household::create($data);
        return redirect()->route('admin.households.index')->with('success', 'Thêm hộ dân thành công!');
    }

    public function edit(Household $household)
    {
        $destinations = Destination::where('is_active', true)->get();
        return view('admin.households.edit', compact('household', 'destinations'));
    }

    public function update(Request $request, Household $household)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'owner_name'     => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:255',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($household->image) {
                Storage::disk('public')->delete($household->image);
            }
            $data['image'] = $request->file('image')->store('households', 'public');
        }

        $household->update($data);
        return redirect()->route('admin.households.index')->with('success', 'Cập nhật hộ dân thành công!');
    }

    public function destroy(Household $household)
    {
        if ($household->image) {
            Storage::disk('public')->delete($household->image);
        }
        $household->delete();
        return redirect()->route('admin.households.index')->with('success', 'Đã xóa hộ dân.');
    }
}
