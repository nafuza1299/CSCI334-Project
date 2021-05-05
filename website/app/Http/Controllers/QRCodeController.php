<?php

namespace App\Http\Controllers;
use App\Models\QrCode;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($latitude, $longitude, $address)
    {
        Auth::guard('web')->logout();

        return view('user.qr-check-in',  compact('latitude', 'longitude', 'address'));
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $id = auth()->id();
        $request->validate([
            'latitude' => 'required|integer|max:255',
            'longitude' => 'required|integer|max:255',
            'address' => 'required|string|max:255',
        ]);

         $check_in= QRCode::create([
            'user_id' => $id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
        ]);

        return redirect(route('home'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
