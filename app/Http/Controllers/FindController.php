<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Collection;

class FindController extends Controller
{
    public function index()
    {
        $results = collect();
        return view('find.index', compact('results'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('q'));

        if (empty($query)) {
            $results = collect();
        } else {
            $results = Inventory::with('location')
                ->where('code', 'like', "%$query%")
                ->orWhere('name', 'like', "%$query%")
                ->get();
        }

        return view('find.index', compact('results', 'query'));
    }
}
