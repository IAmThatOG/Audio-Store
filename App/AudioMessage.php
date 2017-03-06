<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioMessage extends Model
{
    protected $fillable = [
        'title', 'image_path', 'image_size', 'image_name', 'audio_path', 'audio_size', 'audio_name', 'minister',
        'price', 'category_name'
    ];

    //Establish the relationship between AudioMessage and Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
