<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function roles(){
        //creacion rol de admin
        //$role_admin = Role::create(['name' => 'administrador']);
        User::find(2)->assignRole('administrador');
        //creacion rol de cliente
        //$role_usuario = Role::create(['name' => 'cliente']);
    }

    public function AQ(){ return view("preguntasFrecuentes.AQPage")->extends('layouts.app');}
}
