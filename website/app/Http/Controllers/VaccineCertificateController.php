<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VaccineCertificateRequest;

class VaccineCertificateController extends Controller
{
    public function index()
    {
        return view('user.vaccine-certificate');
    }

    public function store(VaccineCertificateRequest $request)
    {
        $user_name = auth()->user()->name;
        $imageName = $user_name.'_'.time().'.'.$request->certificate->extension();  
        $request->certificate->storeAs('user/certs', $imageName);
        $user = auth()->user();
        if(!is_null($user->certificate)){
            Storage::delete($user->certificate);
        }
        $user->certificate = $imageName;
        $user->save();
        return redirect(route('vaccine.certificate'))->with('success', "Image Successfully Uploaded");
    }
}
