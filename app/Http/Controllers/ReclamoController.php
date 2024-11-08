<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamo;
use Illuminate\Support\Facades\DB;

class ReclamoController extends Controller
{
    public function updateEstado(Request $request)
{
    try {
        $reclamo = DB::table('reclamos')
            ->where('id', $request->id)
            ->update(['estado' => $request->estado]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}
}
