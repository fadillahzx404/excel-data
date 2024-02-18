<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColoringDataRow extends Model
{
    use HasFactory;
    protected $table = 'coloring_data_row';
    protected $fillable = ['data_details_id', 'user_id', 'color_row', 'index_row'];
    public function userProfile()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
