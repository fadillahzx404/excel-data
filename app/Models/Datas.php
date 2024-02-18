<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_data', 'category_id'];

    /**
     * Get the user that owns the Datas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function dataDetails()
    {
        return $this->hasOne(DataDetails::class);
    }
}
