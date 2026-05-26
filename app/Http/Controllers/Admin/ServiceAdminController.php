<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceAdminController extends Controller
{
    public function index()
    {
        $services = Service::with('destination')->latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $destinations = Destination::where('is_active', true)->get();
        return view('admin.services.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name'           => 'required|string|max:255',
            'type'           => 'required|in:luu_tru,an_uong,trai_nghiem,lang_nghe,khac',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Thêm dịch vụ thành công!');
    }

    public function edit(Service $service)
    {
        $destinations = Destination::where('is_active', true)->get();
        return view('admin.services.edit', compact('service', 'destinations'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name'           => 'required|string|max:255',
            'type'           => 'required|in:luu_tru,an_uong,trai_nghiem,lang_nghe,khac',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Cập nhật dịch vụ thành công!');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Đã xóa dịch vụ.');
    }
}
