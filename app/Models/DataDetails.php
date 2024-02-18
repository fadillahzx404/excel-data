<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDetails extends Model
{
    use HasFactory;
    protected $table = 'data_details';
    protected $fillable = ['datas_id', 'header_table', 'col_keys', 'color_table', 'user_id', 'value_table'];

    public function coloringCol()
    {
        return $this->hasMany(ColoringDataCol::class);
    }
    public function coloringRow()
    {
        return $this->hasMany(ColoringDataRow::class);
    }
    public function userProfile()
    {
        return $this->hasMany(user::class);
    }
}
