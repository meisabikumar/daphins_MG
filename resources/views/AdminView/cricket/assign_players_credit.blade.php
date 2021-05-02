@extends('AdminView.default')
@section('content')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
<section class="content-header">
	<h1>
		{{ trans("Player Price") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/cricket_matches/')}}">{{ trans("Matches") }}</a></li>
		<li class="active">Assign Player Price</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-body ">


			<div class="col-md-12">
				<!-- <div class="alert alert-dismissible alert-success d-none" id="error_msg"></div> -->
				<div class="tile">



					{{-- {{ Form::open(['role' => 'form','url' => 'admin/cricket_matches/assign_player_price/'.$id,'class' => 'mws-form','files'=>'true']) }}
					{{Form::label('Tournament:', '')}}
					{{ Form::text('tournament','', array('placeholder' => 'Tournmanet Name'))}} --}}

                    <form method="post" action="/admin/cricket/get_player/{{$teams[0]['fixture_id']}}">
                        @csrf

					<div class="table-responsive">
						<table class="table">

							<thead>
								<tr style="float:right;">
									<td colspan="2">


										{{-- <a href="{{URL::to('admin/cricket_matches/assign_player_price/'.$id)}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans("Reset") }}</a> --}}
										{{-- <a href="{{URL::to('admin/cricket_matches')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans("Cancel") }}</a> --}}

										<div class="loaderRefresh">
											<h2 class="text-center" id="refresh-text">Refreshing Data..</h2>
											<img src="https://media3.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="">
										</div>
									</td>

								</tr>

								<tr style="background-color:#3c3f44; color:white;">
									<th width="30%" height="50%" class="" colspan="2" style="font-size:14px;">Player Price</th>
								</tr>
							</thead>
							<tbody>

								@if(!empty($teams))


								@foreach($teams as $key => $val)



								<tr style="background-color:#3c3f44; color:white;">
									<th width="30%" height="50%" class="" colspan="2" style="font-size:14px;">{{$val['name']}} </th>
								</tr>

								@if(!empty($val['players']))
								@foreach($val['players'] as $key1 => $val1)


								<tr>
									<th width="30%" class="">{{ $val1['fullname']}} ({{ $val1['position']['name']}}) </th>
									<td data-th='Full Name' class="txtFntSze">

                                        {{-- <input type="number" step="0.1" name="player[{{$val['team_id']}}][{{$key}}][{{$val1['id']}}]" value="0.0"> --}}

                                        <input type="number" step="0.1" name="player[{{$key}}][{{$val['team_id']}}][{{$key1}}][{{$val1['id']}}]" value="0.0">
                                        {{-- <input type="hidden" step="0.1" name="player[{{$key}}][{{$key1}}][team_id]" value="{{$val['team_id']}}"> --}}

                                        {{-- <input type="hidden" step="0.1" name="player[{{$key}}][{{$key1}}][player_name]" value="{{$val1['fullname']}}">
                                        <input type="hidden" step="0.1" name="player[{{$key}}][{{$key1}}][player_id]" value="{{$val1['id']}}">
                                        <input type="number" step="0.1" name="player[{{$key}}][{{$key1}}][credit]" value="0.0"> --}}
								</tr>
								@endforeach
								@else
								<tr>
									<td colspan="2" style="text-align: center;">NO PLAYER FOUND FOR THIS TEAM</td>
								</tr>
								@endif

								@endforeach


								@else
								<tr>
									<td colspan="2" style="text-align: center;">No Data found.</td>
								</tr>
								@endif

							</tbody>
						</table>
					</div>
                    <input type="submit" value="{{ trans('Save') }}" class="btn btn-danger" style="margin-top: 2cm;">
                    </form>


					{{-- {{ Form::close() }} --}}
					<br><br>
					<button class="btn btn-danger" style="float:right;margin-right:10px;" onclick="HardRefreshData();"><i class="fa fa-refresh"></i>&nbsp;Hard Refresh</button>
					<button class="btn btn-primary" style="float:right;margin-right:10px;" onclick="refreshData();"><i class="fa fa-link"></i>&nbsp; Associate Players</button>
					<br>

				</div>

			</div>
		</div>
	</div>
	<br><br>


</section>
<p class="text-center"><strong>Note:</strong> Use Hard Refresh only when no player data is available. Don't forget to Associate Players after a Hard Refresh.</p>

<SCRIPT language=Javascript>
	<!--
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 &&
			(charCode < 48 || charCode > 57))
			return false;

		return true;
	}
	//
	-->
</SCRIPT>

<script>
	function refreshData() {

		if (window.confirm("Associate Players? This Operation cannot be cancelled.")) {
			document.querySelector(".loaderRefresh").style.display = "block";



			$.ajax({
				url: "/beta/api/assoc_players_match/",
				success: function(result) {
					$("#refresh-text").text("Completed. Please wait..");
					window.location.reload();
				}
			});

		}
	}

	function HardRefreshData() {

		if (window.confirm("Confirm Hard Refresh? This Operation cannot be cancelled.")) {
			document.querySelector(".loaderRefresh").style.display = "block";
			var url = window.location.href.split('/');
			var match_id = url[url.length-1];
			$.ajax({
				url: "/beta/api/feed_team_players_hard/?match_id="+match_id,
				success: function(result) {
					$("#refresh-text").text("Associating Players. Please Wait...");
					// Associate players after hard refresh
					$.ajax({
						url: "/beta/api/assoc_players_match/",
						success: function(result) {
							$("#refresh-text").text("Completed. Please wait..");
							window.location.reload();
						}
					});
					// window.location.reload();
				}
			});

		}
	}
</script>
<style type="text/css">
	/*    table{ max-width:  800px;  }

    table tr th{ width: 200px !important;  }

    table th, table td{ font-size: 16px !important;  }*/

	.loaderRefresh {
		position: fixed;
		top: 25%;
		left: 40%;
		width: 300px;
		height: 300px;
		z-index: 1;
		display: none;
		box-shadow: 0 0 10px 5px darkgray;
	}

	.loaderRefresh img {
		width: 100%;
		height: 100%;
		position: relative;
	}

	.loaderRefresh h2 {
		position: absolute;
		bottom: 20px;
		width: 100%;
		z-index: 1;
		font-size: 17px;
	}
</style>

@stop
