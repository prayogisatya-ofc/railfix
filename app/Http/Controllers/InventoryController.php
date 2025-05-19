<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use App\Models\Location;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location_id');
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = Inventory::with('location');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%');
        }

        if ($location) {
            $query->where('location_id', $location);
        }

        if ($start && $end) {
            $query->whereDate('date_in', '>=', $start)->whereDate('date_in', '<=', $end);
        }

        $inventories = $query->paginate(10)->latest();
        $locations = Location::all();

        return view('inventori.index', compact('inventories', 'locations'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('inventori.create', compact('locations'));
    }

    public function store(InventoryRequest $request)
    {
        $request->validated();

        Inventory::create($request->all());

        return redirect()->route('inventory.index')->with('success', 'Inventory created successfully.');
    }

    public function edit(Inventory $inventory)
    {
        $locations = Location::all();
        return view('inventori.edit', compact('inventory', 'locations'));
    }

    public function update(InventoryRequest $request, Inventory $inventory)
    {
        $request->validated();

        $inventory->update($request->all());

        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Inventory deleted successfully.');
    }


    public function print(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = Inventory::with('location');

        if ($start && $end) {
            $query->whereDate('date_in', '>=', $start)->whereDate('date_in', '<=', $end);
        }

        $inventories = $query->latest()->get();

        return view('inventori.print', compact('inventories'));
    }
}
