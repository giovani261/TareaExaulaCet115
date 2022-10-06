<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\UserCode;

class TwoFAController extends Controller
{
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function index()
    {
        return view('2fa');
    }

    public function indexR()
    {
        auth()->user()->generateCode();
        return view('2fa');
    }

    /**
     * Write Your Code..
     *
     * @return string
    */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id',auth()->user()->id)
                        ->where('code',$request->code)
                        ->where('updated_at','>=',now()->subMinutes(2))
                        ->first();

        if (!is_null($find)) {
            Session::put('user_2fa',auth()->user()->id);
            session()->flash('message', 'Autenticacion en dos pasos completada, puede usar todas las funcionalidades');
            return redirect()->intended();
           // return redirect()->route('welcome');
        }

        return back()->with('error', 'Ha introduciodo un codigo incorrecto.');
    }

    /**
     * Write Your Code..
     *
     * @return string
    */
    public function resend()
    {
        auth()->user()->generateCode();
  
        return back()->with('success', 'Hemos enviado el codigo a tu correo electronico.');
    }
}