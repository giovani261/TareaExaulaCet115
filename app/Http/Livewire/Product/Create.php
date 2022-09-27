<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Categorias;
use App\Models\Proveedores;
use Auth;

class Create extends Component
{
    use WithFileUploads;

    public $categorias_id='1', $proveedores_id='1', $name, $price, $description, $thumbnail; //$categorias_id se coloca su valor por default en 1, debido a que livewire solo guarda el valor cuando el select se cambia, por defecto esta en la categoria 1 ya que sera la primera que se muesta en el select

    public function save()
    {
        if(Auth::user()->hasRole(['administrador'])){
            $validate = $this->validate([
                'categorias_id' => 'required',
                'proveedores_id' => 'required',
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'thumbnail' => 'image|max:1024'
            ]);

            $validate['thumbnail'] = $this->thumbnail->store('photos');
            try{
                Product::create($validate);
                session()->flash('alert-class', 'alert-success'); 
                session()->flash('message', 'Se creo el producto correctamente');
                return redirect('');
            } catch(\Exception $e){
                session()->flash('alert-class', 'alert-danger'); 
                session()->flash('message', 'No se creo el producto');
                return redirect('');
            }
        }
        return redirect('/');
    }

    public function mount(){
        if(!Auth::user()->hasRole(['administrador'])){
            return redirect('/');
        }
        
    }
    public function render()
    {
        if(Auth::user()->hasRole(['administrador'])){
            $categorias = Categorias::all();
            $proveedores = Proveedores::all();
            return view('livewire.product.create',['categorias' => $categorias, 'proveedores' => $proveedores])->extends('layouts.app');
        }
    }
}
