<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index () {
        return view('refunds');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'image' => ['required', 'image', 'max:5000'],
            'reason' => ['required'],
            'phone' => ['required'],
        ]);
        $path =  $data['image']->store('public');
        $pathArray = explode('/', $path);

        $data['image'] = end($pathArray);
        $data['status'] = Refund::STATUS_PENDING;

        $data['user_id'] = auth()->id();

        $refund = Refund::create($data);

        alert()->success('You\'re request has been sent, we will contact you as soon as possible.');
        return back();
    }
}
