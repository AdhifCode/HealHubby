<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $primaryKey = 'profession_id';
    protected $table ='professions';
    protected $fillable = [
        'profession_id',
        'name'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'profession_id');
    }
}
