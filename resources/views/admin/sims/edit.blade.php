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
    {{ __('admin.update') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('admin.services') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('admin.update') }}
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="page-wrapper">
        <div class="container-xl py-3">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('admin.edit') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('sim.update', $sim->id) }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="number">{{ __('admin.phone') }}</label>
                            <input id="number" name="number" type="text" class="form-control"
                                value="{{ $sim->number }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="type">{{ __('admin.type') }}</label>
                            <select id="type" name="type" class="form-control">
                                <option value="zain" {{ $sim->type === 'zain' ? 'selected' : '' }}>Zain</option>
                                <option value="mobily" {{ $sim->type === 'mobily' ? 'selected' : '' }}>Mobily</option>
                                <option value="stc" {{ $sim->type === 'stc' ? 'selected' : '' }}>STC</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="period">{{ __('admin.period') }}</label>
                            <select id="period" name="period" class="form-control">
                                <option value="month" {{ $sim->period === 'month' ? 'selected' : '' }}>
                                    {{ __('admin.month') }}</option>
                                <option value="3months" {{ $sim->period === '3months' ? 'selected' : '' }}>
                                    {{ __('admin.3months') }}</option>
                                <option value="6months" {{ $sim->period === '6months' ? 'selected' : '' }}>
                                    {{ __('admin.6months') }}</option>
                                <option value="year" {{ $sim->period === 'year' ? 'selected' : '' }}>
                                    {{ __('admin.year') }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">{{ __('admin.price') }}</label>
                            <input id="price" name="price" type="number" step="0.01" class="form-control"
                                value="{{ $sim->price }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="serial">{{ __('admin.serial') }}</label>
                            <input id="serial" name="serial" type="text" class="form-control"
                                value="{{ $sim->serial }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('admin.confirm') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
