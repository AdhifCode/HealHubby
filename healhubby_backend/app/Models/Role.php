<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = 'role_id';
    protected $table ='roles';
    protected $fillable = [
        'role_id',
        'nama'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'role_id');
    }
}
