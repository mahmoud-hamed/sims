<?php

namespace App\Http\Livewire\Users;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $search = '';

    public function render()
    {
        $users = Client::where('name', 'like'  , '%' .$this->search . '%')
        ->orWhere('number', 'like', '%' . $this->search . '%')
        ->orWhere('email', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.users.user-index' , ['users' => $users]);
    }
}
