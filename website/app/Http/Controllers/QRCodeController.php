<?php

namespace App\Http\Controllers;
use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessAddress;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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

         $check_in= CheckIn::create([
            'user_id' => $id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
        ]);

        return redirect(route('home'));
    }

    public function indexGenerate()
    {
        $userid = Auth::guard('business')->user()->id;
        $address= BusinessAddress::where('business_id', $userid)
                            ->orderByDesc('address')
                            ->get();

        return view('organization.generate-qr-code', compact('address'));
    }

    public function generateQR(Request $request)
    {   
        $userid = Auth::guard('business')->user()->id;
        $address= BusinessAddress::where('business_id', $userid)
                            ->where('id', $request->id)
                            ->get();

       $qrcode = QrCode::generate(route('qr-check-in', ['latitude' => $address[0]->latitude,'longitude' => $address[0]->longitude,'address' => $address[0]->address]));
        
       return redirect()->route('business.generate.qr')->with('qrcode', $qrcode);

    }
}
