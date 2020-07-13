<?php

namespace App\Http\Livewire;

use Livewire\Component;

use  App\Models\Outlate;

use Illuminate\Support\Str;
use Livewire\WithPagination;

class Outlates extends Component
{
    public $division;

    public function mount($division){
        $this->division = $division;
    }


    public function render()
    {
        $division = $this->division;

        $allData = Outlate::where('status', '1')->where('division', $division)->orderBy('id', 'desc')->get();

        //dd($allData);

        return view('livewire.outlates', \compact('allData', 'division'));
    }
}
