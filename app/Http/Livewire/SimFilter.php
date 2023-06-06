<?php

namespace App\Http\Livewire;

use App\Models\Sim;
use Livewire\Component;
use Livewire\WithPagination;


class SimFilter extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $searchh;
    public $search = 'all';
    public function render()
    {
        $search = $this->search;
        if ($this->search == 'all') {
            $sims = Sim::orderBy('id', 'DESC')->paginate(5);
            return view('livewire.sim-filter', compact('sims'));
        }
        $sims = Sim::where('period', $this->search)->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.sim-filter', compact('sims'));
    }
}
