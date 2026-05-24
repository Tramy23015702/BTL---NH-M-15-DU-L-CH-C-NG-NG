<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    // Trang chủ — hiển thị danh sách điểm du lịch
    public function index(Request $request)
    {
        $query = Destination::where('is_active', true);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $destinations = $query->latest()->paginate(6);
        return view('welcome', compact('destinations'));
    }

    // Xem chi tiết một điểm du lịch
    public function show(Destination $destination)
    {
        $destination->load(['households', 'services']);
        return view('destination.show', compact('destination'));
    }

    // Trang chi tiết tour — lấy từ DB theo loại
    public function tourList(Request $request)
    {
        $types = \App\Models\Destination::typeList();
        $activeType = $request->get('type', '');

        // Nếu có filter loại hình thì chỉ lấy loại đó, không thì lấy tất cả
        $query = Destination::where('is_active', true)->with('services');
        if ($activeType && array_key_exists($activeType, $types)) {
            $query->where('type', $activeType);
        }

        $destinations = $query->orderBy('type')->get()->groupBy('type');

        return view('tour', compact('destinations', 'types', 'activeType'));
    }
}
