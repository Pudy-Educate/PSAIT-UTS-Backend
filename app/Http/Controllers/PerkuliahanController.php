<?php

namespace App\Http\Controllers;

use App\Models\Perkuliahan;
use Illuminate\Http\Request;

class PerkuliahanController extends Controller
{
    public function index()
    {
        $perks = Perkuliahan::with('mahasiswa', 'matakuliah')->get()->map(function ($perk) {
            return [
                'nama' => $perk->mahasiswa->nama,
                'nim' => $perk->mahasiswa->nim,
                'alamat' => $perk->mahasiswa->alamat,
                'tanggal_lahir' => $perk->mahasiswa->tanggal_lahir,
                'kode_mk' => $perk->matakuliah->kode_mk,
                'nama_mk' => $perk->matakuliah->nama_mk,
                'sks_mk' => $perk->matakuliah->sks,
                'nilai' => $perk->nilai
            ];
        });
        return response()->json($perks);
    }

    public function selectNilaiBasedOnNim(Request $request, $nim)
    {
        $perks = Perkuliahan::with('mahasiswa','matakuliah')->where('perkuliahan.nim', $nim)->get()->map(function ($perk) {
            return [
                'nama' => $perk->mahasiswa->nama,
                'nim' => $perk->mahasiswa->nim,
                'alamat' => $perk->mahasiswa->alamat,
                'tanggal_lahir' => $perk->mahasiswa->tanggal_lahir,
                'kode_mk' => $perk->matakuliah->kode_mk,
                'nama_mk' => $perk->matakuliah->nama_mk,
                'sks_mk' => $perk->matakuliah->sks,
                'nilai' => $perk->nilai
            ];
        });
        return response()->json($perks);
    }

    private function searchNilai($nim,$mk){
        $isDataExist = Perkuliahan::where('nim', $nim)
        ->where('kode_mk', $mk)
        ->first();
        return $isDataExist;
    }

    public function addNewNilai(Request $request) {
        $nim = $request->get('nim');
        $mk = $request->get('kode_mk');
        $isDataExist = $this->searchNilai($nim,$mk);

        if ($isDataExist) {
            return response()->json(["status"=>409,"message"=>"Data already exists"]);  
        } 

        try {
            $perkuliahan = new Perkuliahan([
                'nim' => $nim,
                'kode_mk' => $mk,
                'nilai' => $request->get('nilai'),
            ]);
            $perkuliahan->save();

            return response()->json(["status"=>200,'message' => 'Nilai created successfully','data'=>$perkuliahan], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create nilai', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function updateNilai(Request $request) {
        $nim = $request->get('nim');
        $mk = $request->get('kode_mk');
        $data = $this->searchNilai($nim,$mk);

        if (!$data) {
            return response()->json(["status"=>409,"message"=>"Data doesnt exists"]);  
        } 

        try {
            $data->update(['nilai'=>$request->get('nilai')]);

            return response()->json(["status"=>200,'message' => 'Nilai updated successfully','data'=>$data], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update Nilai', 'message' => $e->getMessage()], 500);
        }
    }

    function destroy(Request $request,$nim, $mk) {
        $data = $this->searchNilai($nim,$mk);
        
        if (!$data) {
            return response()->json(["status"=>409,"message"=>"Data doesnt exists"]);  
        } 
        try {
            $data->delete();

            return response()->json(["status"=>200,'message' => 'Nilai deleted successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Nilai', 'message' => $e->getMessage()], 500);
        }
    }

    
}
