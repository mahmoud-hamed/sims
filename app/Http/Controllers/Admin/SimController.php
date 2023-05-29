<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sim;
use Illuminate\Http\Request;

class SimController extends Controller
{
    public function index()
    {
        $sims = Sim::all();
        return view('admin.sims.index', compact('sims'));
    }

    public function create()
    {
        return view('admin.sims.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required',
            'type' => 'required|in:zain,mobily,stc',
            'period' => 'required|in:month,3months,6months,year',
            'price' => 'required|numeric',
            'serial' => 'required|unique:sims',
        ]);

        Sim::create($validatedData);

        return redirect()->route('sims')->with('Add', 'SIM created successfully.');
    }

    public function edit($id)
    {
        $sim = Sim::find($id);
        if (!$sim) {
            return redirect()->route('admin.sims')->with('error', 'SIM not found.');
        }

        return view('admin.sims.edit', compact('sim'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'number' => 'required',
            'type' => 'required|in:zain,mobily,stc',
            'period' => 'required|in:month,3months,6months,year',
            'price' => 'required|numeric',
            'serial' => 'required|unique:sims,serial,' . $id,
        ]);

        $sims = Sim::find($id);
        if (!$sims) {
            return redirect()->route('sims')->with('error', 'SIM not found.');
        }

        $sims->update($validatedData);

        return redirect()->route('sims')->with('edit', 'SIM updated successfully.');
    }

    public function destroy($id)
    {
        $sims = Sim::find($id);
        if (!$sims) {
            return redirect()->route('sims')->with('error', 'SIM not found.');
        }

        $sims->delete();

        return redirect()->route('sims')->with('delete', 'SIM deleted successfully.');
    }
}
