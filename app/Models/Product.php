<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Product extends Model
{
    protected $fillable = ['title', 'image', 'image_small', 'image2', 'image2_small', 'image3', 'image3_small', 'details', 'price', 'status', 'published_by', 'created_by'];


    public function publisher()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
