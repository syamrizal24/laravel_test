<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $items = Item::latest()->get();
        foreach ($items as $row) {
            $data["id"] = $row->id;
            $data["nama"] = $row->nama;
            $data["pajak"] = $row->pajak;
            $list[$row->id] = $data;
        }
        return response()->json([
            'success' => true,
            'message' => 'List Item',
            'data'    => $list
        ], 200);
    }
}
