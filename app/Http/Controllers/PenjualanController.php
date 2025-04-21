<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::query();

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_penjualan', [$request->start_date, $request->end_date]);
        }

        $penjualans = $query->get();
        $total = $penjualans->sum(fn($p) => $p->jumlah * $p->harga);

        return view('dashboard', compact('penjualans', 'total'));
    }
}