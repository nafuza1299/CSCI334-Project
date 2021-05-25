<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CertificateRequest;

class SafeRegistrationController extends Controller
{
 
    public function index()
    {
        return view('organization.business.safe-registration');
    }

    public function store(CertificateRequest $request)
    {
        $business_name = auth()->guard('business')->user()->username;

        //store image name as name_date.mime
        $imageName = $business_name.'_'.time().'.'.$request->certificate->extension();  
        $path = $request->certificate->storeAs('business/certs', $imageName);

        //if image already exists, delete existing image
        $user = auth()->guard('business')->user();
        if(!is_null($user->certificate)){
            Storage::delete($user->certificate);
        }
        
        $user->certificate = $imageName;
        $user->save();
        return redirect(route('business.safe.registration'))->with('success', "Image Successfully Uploaded");
    }
}
