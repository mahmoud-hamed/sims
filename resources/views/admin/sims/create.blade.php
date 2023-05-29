@extends('layouts.master')

@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    {{ __('admin.add-sim') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('admin.sims') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('admin.add') }}
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">

        <div class="col-lg-12 col-md-12">

            <div class="card">

                <div class="card-body">
                    <form action="{{ route('sim.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="number">{{ __('admin.phone') }}</label>
                            <input id="number" name="number" type="text" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="type">{{ __('admin.type') }}</label>
                            <select id="type" name="type" class="form-control">
                                <option value="zain">Zain</option>
                                <option value="mobily">Mobily</option>
                                <option value="stc">STC</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="period">{{ __('admin.period') }}</label>
                            <select id="period" name="period" class="form-control">
                                <option value="month">{{ __('admin.month') }}</option>
                                <option value="3months">{{ __('admin.3months') }}</option>
                                <option value="6months">{{ __('admin.6months') }}</option>
                                <option value="year">{{ __('admin.year') }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">{{ __('admin.price') }}</label>
                            <input id="price" name="price" type="number" step="0.01" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="serial">{{ __('admin.serial') }}</label>
                            <input id="serial" name="serial" type="text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('admin.confirm') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
