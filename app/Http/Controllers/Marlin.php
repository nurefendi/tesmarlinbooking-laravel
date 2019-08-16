<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Marlin extends Controller
{
    //
    public function index()
    {
        return view('v_marlin');
    }

    public function index_proses(Request $req)
    {
        if (!$req->ajax()) {
            $d['status'] = false;
            $d['pesan'] = "Tidak Dapat mengakses";
            return json_encode($d);
        }

        if ($req->angka_awal > 1) {
            $d['status'] = true;
            $d['data'] = hitungangka($req->angka_awal);
            
        } else {
            $d['status'] = false;
            $d['pesan'] = "Angka Tidak boleh lebih kecil dari 1.";
        }
        
        return json_encode($d);
        
    }

    public function cekongkir()
    {
        return view('v_ongkir');
    }
}
