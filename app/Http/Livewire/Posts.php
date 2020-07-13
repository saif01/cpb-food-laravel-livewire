<?php

namespace App\Http\Livewire;

use Livewire\Component;

use  App\Models\Post;

use Illuminate\Support\Str;
use Livewire\WithPagination;

class Posts extends Component
{

    public function render()
    {

        $allData = Post::where('status', '1')->orderBy('id', 'desc')->paginate(9);
        //dd($allData);

        return view('livewire.posts', \compact('allData'));

    }
}
