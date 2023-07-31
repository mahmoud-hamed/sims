@extends('layouts.master')
@section('css')
<style>
    #HASH {
  display: flex;
  justify-content: space-between;
}

.badge{
    
    position: absolute;
    /* background: rgba(0,0,255,1); */
    height: 1rem;
    top: 1rem;
    right: 2rem;
    /* width:2rem; */
    text-align: center;
    /* line-height: 2rem; */
    /* font-size: 1rem; */
    border-radius: 15%;
    /* color:white; */
    /* border:1px solid blue; */

}

</style>
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    {{ __('admin.users') }}
@stop


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('admin.users') }} </h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{ __('admin.users') }}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
<div class="row">
    @foreach ($sims as $sim )
    <div class="col-xl-4 col-lg-4">
		<div class="img-thumbnail  mb-3">
			<a href="#">
                @if ($sim->status == 'active')
                <span id="badge" class="badge badge-success">Active</span>
                @else
                    <span id="badge" class="badge badge-danger">Expired</span>
                @endif
				<img src="http://sims.test/assets/img/Rectangle 10817.png" alt="thumb1" class="thumbimg wd-100p">
			</a>
			<div class="caption">
             
                <div id="HASH">
                    <span>{{ __('admin.number') }}</span>
                    <span>{{ $sim->sim->number }}</span>
      
                </div>
                <div id="HASH">
                    <span>{{ __('admin.end_date') }}</span>
                    <span>{{ $sim->end_date }}</span>
                </div>
                <div id="HASH">
                    <span>{{ __('admin.company') }}</span>
                    <span>{{ $sim->sim->type }}</span>
                </div>
               
               
                
				
			</div>
		</div>
	
</div>
    @endforeach
	
</div>
</div>
</div>



@endsection