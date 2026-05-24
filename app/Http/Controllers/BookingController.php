<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Lưu đơn đặt tour
    public function store(Request $request)
    {
        $request->validate([
            'tour_name'      => 'required|string|max:255',
            'num_people'     => 'required|integer|min:1',
            'member_names'   => 'required|array|min:1',
            'member_names.*' => 'required|string|max:255',
            'total_price'    => 'required|numeric|min:0',
        ], [
            'tour_name.required'    => 'Tên tour không được để trống.',
            'num_people.required'   => 'Vui lòng nhập số người.',
            'num_people.min'        => 'Số người phải ít nhất là 1.',
            'member_names.required' => 'Vui lòng nhập tên thành viên.',
            'total_price.required'  => 'Tổng giá không hợp lệ.',
        ]);

        $membersString  = implode(', ', $request->input('member_names', []));
        $servicesString = implode(', ', $request->input('services', []));

        Booking::create([
            'user_id'      => Auth::id(),
            'tour_name'    => $request->tour_name,
            'num_people'   => $request->num_people,
            'member_names' => $membersString,
            'services'     => $servicesString,
            'total_price'  => $request->total_price,
            'status'       => 'pending',
        ]);

        return redirect()->back()->with('success', 'Quý khách đã đặt tour thành công, chúc quý khách có chuyến đi vui vẻ!');
    }

    // Lịch sử đặt tour của người dùng
    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())->latest()->paginate(10);
        return view('booking.history', compact('bookings'));
    }
}
