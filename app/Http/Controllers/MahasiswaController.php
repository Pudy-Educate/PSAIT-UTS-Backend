<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //

    public function getAllMhs() {
        return  response()->json([
            'data'=> Mahasiswa::all()
        ]);
    }
}
