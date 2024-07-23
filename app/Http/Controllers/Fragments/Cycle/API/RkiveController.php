<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class RkiveController extends Controller
{
    public function budgetApproved()
    {
        $data = DB::table('g59_financeapproval')->get();
        return response()->json($data);
    }

    public function budgetEncrypt()
    {
        $data = DB::table('g59_financeapproval')->get();

        $encrypted = [];
        foreach ($data as $item) {
            $item->id = Crypt::encryptString($item->id);
            $item->title = Crypt::encryptString($item->title);
            $item->budget = Crypt::encryptString($item->budget);
            $item->description = Crypt::encryptString($item->description);
            $item->submitted_at = Crypt::encryptString($item->submitted_at);
            $item->reference = Crypt::encryptString($item->reference);
            $item->submitted_by = Crypt::encryptString($item->submitted_by);
            $item->admin_status = Crypt::encryptString($item->admin_status);
            $item->status = Crypt::encryptString($item->status);
            $item->comment = Crypt::encryptString($item->comment);
            $encrypted[] = $item;
        }

        return response()->json($encrypted);
    }

    public function budgetDecrypt()
    {
        $API = Http::get('http://127.0.0.1:8000/api/approved-encrypted-budget');

        $budgetData = json_decode($API->body(), true);

        $decrypted = [];
        foreach ($budgetData as $item) {
            $item['id'] = Crypt::decryptString($item['id']);
            $item['title'] = Crypt::decryptString($item['title']);
            $item['budget'] = Crypt::decryptString($item['budget']);
            $item['description'] = Crypt::decryptString($item['description']);
            $item['submitted_at'] = Crypt::decryptString($item['submitted_at']);
            $item['reference'] = Crypt::decryptString($item['reference']);
            $item['submitted_by'] = Crypt::decryptString($item['submitted_by']);
            $item['admin_status'] = Crypt::decryptString($item['admin_status']);
            $item['status'] = Crypt::decryptString($item['status']);
            $item['comment'] = Crypt::decryptString($item['comment']);
            $decrypted[] = (object) $item;
        }
        return response()->json($decrypted);
    }

}
