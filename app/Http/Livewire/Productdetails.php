<?php

namespace App\Http\Livewire;

use Livewire\Component;

use  App\Models\Product;

class Productdetails extends Component
{

    public $singleData;

    public function mount($id)
    {
        $data = Product::find($id);

        $this->singleData = $data;

    }


    public function render()
    {
        $singleData = $this->singleData;

        return view('livewire.productdetails', \compact('singleData'));
    }
}
