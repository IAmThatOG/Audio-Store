<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_name'];

    //Establish the relationship between Category and AudioMessage
    public function audioMessages()
    {
        return $this->hasMany(AudioMessage::class);
    }
}
