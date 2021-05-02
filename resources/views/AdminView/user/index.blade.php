@extends('AdminView.default')
@section('content')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
<!-- date time picker js and css and here-->
<script>
	jQuery(document).ready(function(){
		$(".choosen_selct").chosen();
	});
</script>
<style>
.chosen-container-single .chosen-single{
	height:34px !important;
	padding:3px 6px;
}
</style>
<section class="content-header">
	<h1>Users </h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ trans("Users") }}</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text"><b>Users</b> <br/>(Till Now)</span>
			  <span class="info-box-number">{{ count($result) }}</span>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text"><b>Users</b>  <br/>(In this month)</span>
			  <span class="info-box-number">{{ count($result) }}</span>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-purple"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text"><b>Users</b> <br/>(In last month)</span>
			  <span class="info-box-number">{{ count($result) }}</span>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text"><b>Users</b> <br/>(In this year)</span>
			  <span class="info-box-number">{{ count($result) }}</span>
			</div>
		  </div>
		</div>
	</div>


                        <div class="box">
		<div class="box-body ">
			<table class="table table-hover">
				<thead>
					<tr>
                        <th>Full name</th>
                        <th>Team Name</th>
                        <th>Phone Number</th>
                        <th>Created On</th>
                        <th>Action</th>
					</tr>
				</thead>

				@if(!$result->isEmpty())
					@foreach($result as $key => $record)
						<tr>
							<td>
								{{ $record->name }}
							</td>
							<td>
								{{ $record->team_name }}
							</td>
							{{-- <td>
								<a href="mailto:{{ $record->email }}" class="redicon">
									{{ $record->email }}
								</a> --}}
							</td>
							<td>
								{{ !empty($record->phone) ? $record->phone :'-' }}
							</td>

							{{-- <td>
								@if($record->is_active	==1)
									<span class="label label-success" >{{ trans("Activated") }}</span>
								@else
									<span class="label label-warning" >{{ trans("Deactivated") }}</span>
								@endif
								@if($record->is_verified==1)
									<span class="label label-success" >{{ trans("Verified") }}</span>
								@else
									<span class="label label-warning" >{{ trans("Not Verified") }}</span>
								@endif
							</td> --}}
							<td>
								{{ $record->created_at}}
							</td>
							<td>
								<a title="{{ trans('Edit') }}" href="{{URL::to('admin/users/edit-user/'.$record->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="{{URL::to('admin/users/view-user/'.$record->id)}}" title="{{ trans('View') }}" class="btn btn-info">
									<i class="fa fa-eye"></i>
								</a>

								<a title="{{ trans('Delete') }}" href="{{ URL::to('admin/users/delete-user/'.$record->id) }}"  class="delete_any_item btn btn-danger">
									<i class="fa fa-trash-o"></i>
								</a>
								{{-- @if($record->is_verified == 1)
									<a  title="Click To Not unverifed"  href="{{URL::to('admin/users/verify-user/'.$record->id.'/0')}}"  class=" btn btn-success btn-small status_any_item"><span class="fa fa-check"></span> </a>
								@else
									<a title="Click To Verified" href="{{URL::to('admin/users/verify-user/'.$record->id.'/1')}}"   class=" btn btn-warning btn-small status_any_item"><span class="fa fa-ban"></span></a>
								@endif
								<a title="{{ trans('Send Login Credentials') }}" href="{{ URL::to('admin/users/send-credential/'.$record->id) }}" class="btn btn-success">
									<i class="fa fa-share"></i>
								</a> --}}
								{{-- <a title="user refer list" href="{{ URL::to('admin/users/user-refer/'.$record->id) }}" class="btn btn-success">
									<i class="fa fa-user-plus"></i>
								</a> --}}



							{{-- @if($record->user_role == 2) --}}
								@can('hasPermitSubadmin')
									<a title="{{ trans('Permission') }}" href="{{ URL::to('admin/users/permissions/'.$record->id) }}" class="btn btn-success">
										<i class="fa fa-key" aria-hidden="true"></i>
									</a>



								@endcan
							{{-- @endif --}}

									{{-- <a title="{{ trans('Cash Bonus') }}" href="{{ URL::to('admin/users/send-cash-bonus/'.$record->id) }}" class="btn btn-success">
										<i class="fa fa-gift" aria-hidden="true"></i>
									</a> --}}


							</td>
						</tr>
					 @endforeach
					 @else
						<tr>
							<td class="alignCenterClass" colspan="9" >{{ trans("No record is yet available.") }}</td>
						</tr>
					@endif
			</table>
		</div>
		{{-- <div class="box-footer clearfix">
			<div class="col-md-3 col-sm-4 "></div>
			<div class="col-md-9 col-sm-8 text-right ">@include('pagination.default', ['paginator' => $result])</div>
		</div> --}}
	</div>
</section>
<script>
$(document).ready(function() {
	 $( "#start_from" ).datepicker({
		dateFormat 	: 'yy-mm-dd',
		changeMonth : true,
		changeYear 	: true,
		yearRange	: '-100y:c+nn',
		onSelect	: function( selectedDate ){ $("#start_to").datepicker("option","minDate",selectedDate); }
	});
	$( "#start_to" ).datepicker({
		dateFormat 	: 'yy-mm-dd',
		changeMonth : true,
		changeYear 	: true,
		yearRange	: '-100y:c+nn',
		onSelect	: function( selectedDate ){ $("#start_from").datepicker("option","maxDate",selectedDate); }
	});
})
$(function(){
	$('.date_of_birth').datepicker({
		dateFormat 	: 'yy-mm-dd',
		changeMonth : true,
		changeYear 	: true,
		yearRange	: '-100y:c+nn',
		maxDate		: '-1'
	});
});

 $(document).on('click', '.show_profile', function(e){
			e.stopImmediatePropagation();
			url = $(this).attr('href');
			var full_name = $(this).attr('data-rel');
			bootbox.confirm("Are you sure want to show "+full_name+ '?',
			function(result){
				if(result){
					window.location.replace(url);
				}
			});
			e.preventDefault();
		});

		$(document).on('click', '.hide_profile', function(e){
			e.stopImmediatePropagation();
			url = $(this).attr('href');
			var full_name = $(this).attr('data-rel');
			bootbox.confirm("Are you sure want to hide "+full_name+ '?',
			function(result){
				if(result){
					window.location.replace(url);
				}
			});
			e.preventDefault();
		});
	$(".findUsers").change(function(){
		$("#search_users").submit();
	});
</script>
@stop
