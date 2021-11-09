<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserBookRequest;
use App\Models\Swap;

class UserSwapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Swap::whereNull('registration_number')
                    ->where('swap_data', '>=', date('Y-m-d H:m:s'))
                    ->get();
    }

    /**
     * Booking an appointment.
     *
     * @param  \Illuminate\Http\UserBookRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function book(UserBookRequest $request, $id)
    {
        //$swap = Swap::find($id);
        $swap = Swap::whereNull('registration_number')
                      ->where('swap_data', '>=', date('Y-m-d H:m:s'))
                      ->where('id', $id)
                      ->first();
        $swap->registration_number = $request->registration_number;
        $swap->save();
        return $swap;
    }

    /**
     * Cancellation booking an appointment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelBook(Request $request)
    {
        //$swap = Swap::find($id);
        $swap = Swap::where('registration_number', $request->registration_number)
                      ->first();
        $swap->registration_number = null;
        $swap->save();
        return $swap;
    }

    /**
     * Book the first available appointment date.
     *
     * @return \Illuminate\Http\Response
     */
    public function firstFreeBook(UserBookRequest $request)
    {
        $swap = Swap::whereNull('registration_number')
                    ->where('swap_data', '>=', date('Y-m-d H:m:s'))
                    ->orderBy('swap_data')
                    ->first();

        $swap->registration_number = $request->registration_number;
        $swap->save();
        return $swap;
    }

}
