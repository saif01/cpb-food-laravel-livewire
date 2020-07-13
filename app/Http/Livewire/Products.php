<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Products extends Component
{
    public function render()
    {
        $allData = Product::where('status', '1')->orderBy('id', 'desc')->paginate(9);

        //dd($allData);

        return view('livewire.products', compact('allData'));
    }
}
