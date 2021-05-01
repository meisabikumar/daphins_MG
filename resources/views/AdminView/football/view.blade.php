@extends('AdminView.default')

@section('content')


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


<section class="content-header">
    <h1>Contest Template </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{URL::to('admin/contests')}}">{{ trans("Contest Template") }}</a></li>
        <li class="active">{{ trans("Contest Template view") }}</li>
    </ol>
</section>
<section class="content">

    <div class="box">
        <div class="box-body ">


    <div class="col-md-12">
        <!-- <div class="alert alert-dismissible alert-success d-none" id="error_msg"></div> -->
        <div class="tile">
            <?php /*
            <div class="row mb-3">
                <div class="col-sm-1 col-md-1 col-lg-1 mr-4"><span class="btn btn-primary active">Tournament Detail</span></div>
                <div class="col-sm-1 col-md-1 col-lg-1 mr-2 ml-4"><a href="{{ route('contest.player-score',[$contest->id,$contest->tournament_id])}}" class="btn btn-primary">Player Score</a></div>
                <div class="col-sm-1 col-md-1 col-lg-1"><a href="{{ route('contest.contestents',$contest->id)}}" class="btn btn-primary">Contestants</a></div>
            </div>
            */ ?>
            <h3>Contest Template Detail</h3>
        	<table class="table">
                <?php /*
                @if(!empty($contest->user))
                <tr><td>Teamname: {{ $contest->user->username }}</td></tr>
                @endif
                */ ?>
                <?php /*
        		<tr>
        			<td>Tournament:
                        @if($contest['tournament_id'])
                            @php
                                $tours = explode(',',$contest['tournament_id']);
                            @endphp
                            @foreach($tours as $tour)
                                {{$tournaments[$tour]}}@if(!$loop->last){{','}}@endif
                            @endforeach
                        @endif
                    </td>
        			<td>Contest Type: {{ ucwords($contest->contest_type) }}</td>
        		</tr>
                */ ?>
        		<tr>
        			<td>Entry Fee: {{ '$ '.$contest->entry_fee }}</td>
        			<td>Winning Amount: {{ '$ '.$contest->winning_amt }}</td>
        		</tr>
        		<tr>
        			<td>Min entry: {{ $contest->min_entry }}</td>
        			<td>Max entry: {{ $contest->max_entry }}</td>
        		</tr>
        		<tr>
                    <td>Admin Percent: {{ $contest->admin_per.'%' }}</td>
                    <td>Admin Amount: {{ '$ '.$contest->admin_amt }}</td>
                </tr>
                <tr>
        			<td>Is Free: @if($contest->is_free) {{ 'Yes' }} @else {{ 'No' }} @endif</td>
        			<td>Entry per User: {{ $contest->entry_per_user }}</td>
        		</tr>
                <?php /*
                @if($contest->is_private == 1)
                <tr>
                    <td>Is Private: @if($contest->is_private == 1 ) {{ 'Yes' }} @else {{ 'No' }} @endif</td>
                    <td>URL:  {{ route('contest.private',base64_encode($contest->id)) }}</td>
                </tr>
                @endif
                */ ?>
        	</table>
        	<h3>Prize Breakdown</h3>
        	<table class="table">
        		<tr>
        			<th>Rank</th>
        			<th>Amount Per Person</th>
        		</tr>
                <?php
                    $breakdown = json_decode($contest->breakdown);
                ?>
                @if (!empty($breakdown))


        		@foreach($breakdown as $b)

        			<tr>
        				<td>{{ $b->from }}
        					@if(!empty($b->to))
        						{{ ' - '.$b->to }}
        					@endif
        				</td>
        				<td>{{ '$ '.$b->amt_per_person }}</td>
        			</tr>
        		@endforeach
                @endif
        	</table>
            <h3>Contest Participants</h3>
              <table id="contest_participant" class="table table-hover" style="max-width: 100%; ">
                <thead>
                  <tr>
                    <th>Team Name</th>

                    <th>Points</th>
                    <th>Rank</th>
                    <th>Won amt.</th>
                  </tr>
                </thead>
                <tbody>
                    <!--Coding By Amir-->
                        {{-- @foreach($ranks as $r)

                        <tr>
                            <td>{{$r->p_name}}</td>
                            <td>{{$totalPlayers}}</td>
                            <td>{{$r->points}}</td>
                            <td>{{$r->rank}}</td>
                            <td>{{$r->won_amount}}</td>
                        </tr>
                        @endforeach --}}
                    <!--Coding By Amir Ends-->


                </tbody>
              </table>



        </div>

    </div>
</div>
</div>
</section>



<style type="text/css">
    table{ max-width:  800px;  }
    table tr th{ width: 200px !important;  }
    table th, table td{ font-size: 16px !important;  }


</style>

@endsection
