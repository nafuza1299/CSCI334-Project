<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CertificateRequest;

class VaccineCertificateController extends Controller
{
    public function index()
    {
        if(auth()->user()->vaccinated == 1){
            return redirect(route('home'));
        }
        else{
            return view('user.vaccine-certificate');
        }
    }

    public function store(CertificateRequest $request)
    {
        $user_name = auth()->user()->name;
        //store image name as name_date.mime
        $imageName = $user_name.'_'.time().'.'.$request->certificate->extension();  
        $request->certificate->storeAs('user/certs', $imageName);

        //if image already exists, delete existing image
        $user = auth()->user();
        if(!is_null($user->certificate)){
            Storage::delete($user->certificate);
        }
        
        $user->certificate = $imageName;
        $user->save();
        return redirect(route('vaccine.certificate'))->with('success', "Image Successfully Uploaded");
    }
}
