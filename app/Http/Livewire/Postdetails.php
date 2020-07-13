<?php

namespace App\Http\Livewire;

use Livewire\Component;

use  App\Models\Post;

class Postdetails extends Component
{
    public $singleData;

    public function mount($id)
    {
        $data = Post::find($id);

        $this->singleData = $data;

    }


    public function render()
    {

        $singleData = $this->singleData;

        return view('livewire.postdetails', \compact('singleData'));
    }
}
