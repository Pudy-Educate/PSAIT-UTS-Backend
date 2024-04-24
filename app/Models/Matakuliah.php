<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah';
    protected $primaryKey = 'kode_mk';
    public $incrementing = false;
    public $timestamps = false;
    
    public function perkuliahan()
    {
        return $this->hasMany(Perkuliahan::class, 'kode_mk', 'kode_mk');
    }
}
