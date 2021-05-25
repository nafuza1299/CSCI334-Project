<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;


class QRCodeController extends Controller
{
    public function index($id)
    {
        auth()->guard('web')->logout();
        
        $check_id = app("BusinessAddress")->checkBusinessAddressID($id);

        //check if business address exists, if not redirect to home
        if($check_id == NULL){
            return redirect(route("home"));
        }
        //go to page if successful
        else{
            return view('user.qr-check-in',  compact('id'));
        }
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $id = auth()->id();

        $request->validate([
            'business_address_id' => 'required|integer',
        ]);

        app("CheckIn")->createCheckIn($id, $request);

        return redirect(route('home'));
    }

    public function indexGenerate()
    {
        //get business's business addresses
        $address = app("BusinessAddress")->getBusinessAddress(auth()->guard('business')->id());

        return view('organization.generate-qr-code', compact('address'));
    }

    public function generateQR(Request $request)
    {   
        //get selected address information
        $address = app("BusinessAddress")->getSelectedAddress(auth()->guard('business')->id(), $request);

        $url = route('qr-check-in', ['id'=>$address[0]->id]);

        return redirect()->route('business.generate.qr')->with('qrcode', $url);

    }
}
