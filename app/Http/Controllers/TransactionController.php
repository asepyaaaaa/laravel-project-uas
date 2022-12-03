<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Zalora;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::get();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'List Semua Transaksi',
            'data' => $transaction
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth()->user();
        $zalora = Zalora::find($request->id_sepatu);
        
        $transaction = Validator::make($request->all(), [
            'id_sepatu' => 'required',
            'jumlah_sepatu' => 'required',
        ]);

        if ($transaction->fails()){
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'error',
                'error' => $transaction->errors()
            ], 400);
        }
        
        if ($zalora->stock_sepatu < $request->jumlah_sepatu){
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'error Stock Tidak Mencukupi',
                'error' => $transaction->errors()
            ], 400);
        }

        $transaction = Transaction::create([
            'id_sepatu' => $request->id_sepatu,
            'jumlah_sepatu' => $request->jumlah_sepatu,
            'total_harga' => $request->jumlah_sepatu * $zalora->harga,
            'id_user' => $user->id
        ]);

        $zalora->stock_sepatu = $zalora->stock_sepatu - $request->jumlah_sepatu;
        $zalora->save();


            if ($transaction) {
                return response()->json([
                    'success' => true,
                    'CODE' => 200,
                    'message' => 'Berhasil Menambahkan Data',
                    'data' => $transaction
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'CODE' => 400,
                    'message' => 'Gagal Menambahkan Data',
                    'data' => $transaction->errors()
                ], 400);
            }
    }
}
