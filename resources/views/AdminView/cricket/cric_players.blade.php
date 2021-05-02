@extends('AdminView.default')
@section('content')
<?php
use Carbon\Carbon;
?>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
<!-- date time picker js and css and here-->

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
	<h1>Players </h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ trans("players") }}</li>
	</ol>
</section>
<section class="content">


<div class="row">
		{{ Form::open(['role' => 'form','url' => 'admin/players/','class' => 'mws-form',"method"=>"get"]) }}

			<!--<div class="col-md-2 col-sm-2">
				<div class="form-group ">
					{{ Form::select('is_active',array(''=>trans('Select Status'),0=>'Inactive',1=>'Active'),((isset($searchVariable['is_active'])) ? $searchVariable['is_active'] : ''), ['class' => 'form-control choosen_selct']) }}
				</div>
			</div>-->

			<div class="col-md-2 col-sm-2">
				<div class="form-group ">
					{{ Form::text('first_name',((isset($searchVariable['first_name'])) ? $searchVariable['first_name'] : ''), ['class' => 'form-control','placeholder'=>'First Name']) }}
				</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="form-group ">
					{{ Form::text('last_name',((isset($searchVariable['last_name'])) ? $searchVariable['last_name'] : ''), ['class' => 'form-control','placeholder'=>'Last Name']) }}
				</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="form-group ">
					{{ Form::text('nick_name',((isset($searchVariable['nick_name'])) ? $searchVariable['nick_name'] : ''), ['class' => 'form-control','placeholder'=>'Nick Name']) }}
				</div>
			</div>





			<div class="col-md-2 col-sm-2">
				<button class="btn btn-primary" style="margin:0;"><i class='fa fa-search '></i> {{ trans('Search') }}</button>
			</div>
			{{ Form::close() }}





	</div>




	<div class="box">
		<div class="box-body ">



<table class="table table-hover">
				<thead>
					<tr>
{{-- <th >

							{{
								link_to_route(
									"Players.index",
									trans("Player Id"),
									array(
										'id'=>isset($id)?$id:'',
										'sortBy' => 'id',
										'order' => ($sortBy == 'id' && $order == 'desc') ? 'asc' : 'desc',
										$query_string
									),
								   array('class' => (($sortBy == 'id' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'id' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>

						<th >

							{{
								link_to_route(
									"Players.index",
									trans("First Name"),
									array(
										'id'=>isset($first_name)?$first_name:'',
										'sortBy' => 'first_name',
										'order' => ($sortBy == 'first_name' && $order == 'desc') ? 'asc' : 'desc',
										$query_string
									),
								   array('class' => (($sortBy == 'first_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'first_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th >

							{{
								link_to_route(
									"Players.index",
									trans("Last Name"),
									array(
										'id'=>isset($last_name)?$last_name:'',
										'sortBy' => 'last_name',
										'order' => ($sortBy == 'last_name' && $order == 'desc') ? 'asc' : 'desc',
										$query_string
									),
								   array('class' => (($sortBy == 'last_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'last_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th >

							{{
								link_to_route(
									"Players.index",
									trans("Nick Name"),
									array(
										'id'=>isset($nick_name)?$nick_name:'',
										'sortBy' => 'nick_name',
										'order' => ($sortBy == 'nick_name' && $order == 'desc') ? 'asc' : 'desc',
										$query_string
									),
								   array('class' => (($sortBy == 'nick_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'nick_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>


						<th >

							{{
								link_to_route(
									"Players.index",
									trans("Deleted At"),
									array(
										'id'=>isset($deleted_at)?$deleted_at:'',
										'sortBy' => 'deleted_at',
										'order' => ($sortBy == 'deleted_at' && $order == 'desc') ? 'asc' : 'desc',
										$query_string
									),
								   array('class' => (($sortBy == 'deleted_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'deleted_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th> --}}

						<th>
							Player Id
						</th>
						<th>
							Name
						</th>
						<th>
							Action
						</th>
					</tr>
				</thead>
				{{-- @if(!$result->isEmpty())
					@foreach($result as $key => $record)
						<tr>
							<td>
								{{ $record->id }}
							</td>

							<td>
								{{ $record->first_name }}
							</td>
							<td>
								{{ $record->last_name }}
							</td>
							<td>
								{{ $record->nick_name }}
							</td>



							<td>
								{{ !empty($record->deleted_at) ?  Carbon::parse($record->deleted_at)->format('d/m/y') : '--'}}
							</td>

							<td>

							<a href="{{URL::to('admin/players/view_series_player_stats/'.$record->id)}}"><button class="btn btn-primary">View Stats</button>
							</a> --}}
                            <tr>
                                <td colspan="3">
							<em><center>No data from sportsmonk</center></em>
							</td>

						</tr>
					 {{-- @endforeach --}}
					 {{-- @else
						<tr>
							<td class="alignCenterClass" colspan="9" >{{ trans("No record is yet available.") }}</td>
						</tr>
					@endif --}}
			</table>


		</div>
		{{-- <div class="box-footer clearfix">
			<div class="col-md-3 col-sm-4 "></div>
			<div class="col-md-9 col-sm-8 text-right ">@include('pagination.default', ['paginator' => $result])</div>
		</div> --}}
	</div>
</section>








@stop
