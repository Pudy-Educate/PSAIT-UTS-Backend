<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function getAllMatkul() {
        return  response()->json([
            'data'=> Matakuliah::all()
        ]);
    }

}
