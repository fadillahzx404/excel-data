<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColoringDataCol extends Model
{
    use HasFactory;
    protected $table = 'coloring_data_col';
    protected $fillable = ['data_details_id', 'user_id', 'color_col', 'header', 'column'];

    public function userProfile()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
