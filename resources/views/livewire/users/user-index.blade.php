
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href={{ url('users/user/create') }} class="modal-effect btn btn-sm btn-primary"
                        style="color:white"><i class="fas fa-plus"></i>&nbsp; {{ __('admin.add') }}</a>

                        <input type="search"  wire:model="search" class="form-control float-end mx-10" placeholder="Search..."
                        style="width: 230px; margin-bottom:10px; margin-right:10px; float: right;" />

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table key-buttons text-md-nowrap"
                            data-page-length='50'style="text-align: center">
                            <thead>
                                <tr class="align-self-center">
                                    <th class="border-bottom-0">#</th>
                                    <th style="text-align:center">{{ __('admin.image') }}</th>

                                    <th class="border-bottom-0">{{ __('admin.name') }}</th>
                                    <th class="border-bottom-0">{{ __('admin.email') }}</th>
                                    <th class="border-bottom-0">{{ __('admin.phone') }}</th>
                                    <th class="border-bottom-0">{{ __('admin.balance') }}</th>

                                    <th class="border-bottom-0">{{ __('admin.control') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($users as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        @isset($item->attachmentRelation[0])
                                            <td><img src="{{ asset($item->attachmentRelation[0]->path) }} " alt="avatar"
                                                    height="60" style="border-radius:20px;"></td>
                                        @else
                                            <td><img src="{{ asset('assets/img/profile.png') }}" alt="avatar"
                                                    height="60"></td>
                                        @endisset
                                        <td>{{ $item->name }} </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->number }}</td>
                                        @isset($item->wallet)
                                        <td>{{ $item->wallet->balance }}</td>
                                        @else
                                        <td>0</td>
                                        @endisset
                                        <td>

                                            <a href="{{ route('user.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"
                                                class="btn round btn-outline-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('users.mysims', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Sims"
                                                Tooltip on top
                                                class="btn round btn-outline-primary">
                                                <i class="fa-solid fa-sim-card"></i>
                                            </a>
                                                <span  style="cursor: pointer;" class=" btn round btn-outline-danger delete-row text-danger" data-toggle="tooltip" data-placement="top" title="Delete"
                                                data-url="{{ url('users/user/delete/' . $item->id) }}"><i
                                                    class="fa-solid fa-trash"></i></span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">{{ __('admin.there_is_no_data_at_the_moment') }}</td>
                                    </tr>
                                @endforelse  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>