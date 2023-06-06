<div class="row">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <a href="sim/create" class="modal-effect btn btn-sm btn-primary" style="color:white; float: right"><i
                        class="fas fa-plus"></i>&nbsp; {{ __('admin.add') }}</a>

                @can('تصدير EXCEL')
                    <a class="modal-effect btn btn-sm btn-primary" href="{{ url('export_invoices') }}" style="color:white"><i
                            class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                @endcan

                <select wire:model="search" class="form-control text-center  mx-10"
                    style="width: 230px; margin-bottom:10px; float: left;">
                    <option value="all">{{ __('admin.all') }}</option>
                    <option value="month">{{ __('admin.month') }}</option>
                    <option value="3months">{{ __('admin.3months') }}</option>
                    <option value="6months">{{ __('admin.6months') }}</option>
                    <option value="year">{{ __('admin.year') }}</option>

                </select>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table key-buttons text-md-nowrap"
                        data-page-length='50'style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ __('admin.phone_number') }}</th>
                                <th class="border-bottom-0">{{ __('admin.price') }}</th>
                                <th class="border-bottom-0">{{ __('admin.control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($sims as $item)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>

                                    <td>{{ $item->number }} </td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <a href="{{ route('sim.edit', $item->id) }}"
                                            class="btn round btn-outline-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <span class=" btn round btn-outline-danger delete-row text-danger"
                                            data-url="{{ url('sim/delete/' . $item->id) }}"><i
                                                class="fa-solid fa-trash"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div>
                        {{ $sims->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>
