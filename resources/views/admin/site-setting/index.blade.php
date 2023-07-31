

@extends('layouts.master')
@section('css')
<!-- include libraries(jQuery, bootstrap) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- summernote css/js -->
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    {{ __('admin.introductory_site_setting') }}
@stop


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('admin.introductory_site_setting') }}
                </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{ __('admin.add') }}
                </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
<!-- resources/views/contacts.blade.php -->
@section('content')
<div class="page-wrapper">

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('admin.add') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{  route('update-sitesetting') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.email') }}</label>
                                            <input type="text" id="email" name="email" class="form-control" value="{{ $sitesetting->email ?? '' }}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.phone') }}</label>
                                            <input type="text" id="phone" class="form-control" name="phone" value="{{ $sitesetting->phone ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.whatss') }}</label>
                                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $sitesetting->whatsapp ?? '' }}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.app_store') }}</label>
                                            <input type="text" class="form-control" id="app_store" name="app_store" value="{{ $sitesetting->app_store ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.google') }}</label>
                                            <input type="text" class="form-control" id="google_play" name="google_play" value="{{ $sitesetting->google_play ?? '' }}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.address') }}</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ $sitesetting->address ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.facebook') }}</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $sitesetting->facebook ?? '' }}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.twitter') }}</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $sitesetting->twitter ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.instagram') }}</label>
                                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $sitesetting->instagram ?? '' }}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.snapchat') }}</label>
                                            <input type="text" class="form-control" id="snapchat" name="snapchat" value="{{ $sitesetting->snapchat ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('admin.logo') }}</label>
                                    <div class="form-group mb-3">
                                        <input type="file" class="dropify" name="logo" data-height="200" />
                                    </div>
                                    @if(isset($sitesetting->attachmentRelation))
                                    <div class="mt-3">
                                        <label>{{ __('admin.current_logo') }}</label><br>
                                        <img src="{{ asset($sitesetting->attachmentRelation[0]->path) }}" alt="Current Logo" style="max-height: 150px;">
                                    </div>
                                    @endif
                                </div>
                            
                                              
                            
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('admin.confirm') }}</button>
                                </div>
                                                       
                            
                            </form>

    </div>
        </div>
            </div>
                </div>
                    </div>
                        </div>
                            </div>
                            </div>
                            </div>

@endsection