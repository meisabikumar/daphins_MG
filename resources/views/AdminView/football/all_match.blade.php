@extends('AdminView.default')

@section('content')

<section class="content-header">

	<h1>Matches View </h1>

	<ol class="breadcrumb">

		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard-Cric</a></li>

		<li><a href="{{URL::to('admin/cricket_matches')}}">{{ trans("Cricket Matches") }}</a></li>

		<li class="active">Football Matches View</li>

	</ol>

</section>

<section class="content">

	<div class="box">

		<div class="box-body ">


			<h4>Football Match Data </h4>


			<button class="btn btn-primary" style="float:right;margin:5px;" onclick="refreshData();"><i class="fa fa-refresh"></i> Refresh Matches</button>
			<div class="loaderRefresh">
				<h2 class="text-center" id="refresh-text">Refreshing Data..</h2>
				<img src="https://media3.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="">
			</div>


			<div class="col-md-12">


				<div class="tile">


					<div class="table-responsive">

						<table class="table table-bordered table-hover">



							<tbody>

								<tr>

									<th>Match ID</th>

                                    <th>Tournament Name</th>

									<th>Match Name</th>

									<th>Short Name</th>

									<th>Start Date</th>


								</tr>



								@foreach($match as $val)

								<tr>

									<td>{{ ($val->match_key) }}</td>

                                    <td>{{ ($val->tournament_name) }}</td>

									<td>{{ ($val->match_name) }}</td>

									<td>{{ ($val->match_short_name) }}</td>

									<td>{{ ($val->match_start_date) }}</td>


									@if( $val->active==1 )
									<td>

										<form method="post" action="/admin/football/update_disable_match">
											@csrf
											<input type="hidden" name="match_id" value="{{ $val->match_key }}">
											<input type="submit" name="active/inactive" value="Click to Inactive">
											<a href="{{URL::to('admin/cricket_matches/assign_player_price/'.$val['unique_id'])}}" title="Active" class="btn btn-success"><i class="fa fa-money" aria-hidden="true"></i></a>
										</form>

								</tr>

								@else

								<td>
									<form method="post" action="/admin/football/update_active_match">
                                        @csrf
                                        <input type="hidden" name="match_id" value="{{ $val->match_key }}">
                                        <input type="submit" name="active/inactive" value="Click to Active">
                                    </form>


									</tr>



									@endif



									@endforeach


							</tbody>

						</table>

					</div>




				</div>



			</div>



		</div>

	</div>

</section>



<script>

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

@endsection
