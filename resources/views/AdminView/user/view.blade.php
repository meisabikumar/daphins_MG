<?php
use Carbon\Carbon;
?>
@extends('AdminView.default')
@section('content')


<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

<!-- https://code.jquery.com/jquery-3.3.1.js
https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js
https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">




<section class="content-header">
	<h1>
		 {{ trans("Users Detail") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		{{-- <li><a href="{{URL::to('admin/users/'.USER)}}">{{ trans("Userss") }}</a></li> --}}
		<li class="active"> {{ trans("Users Detail") }}  </li>
	</ol>
</section>
<section class="content">
    <div class="box">
        <div class="box-body ">


    <div class="col-md-12">
        <!-- <div class="alert alert-dismissible alert-success d-none" id="error_msg"></div> -->
        <div class="tile">


 <div class="table-responsive">
  <table class="table">

				<thead>
					<tr style="background-color:#3c3f44; color:white;">
						<th  width="30%" height="50%" class="" colspan="2" style="font-size:14px;">PROFILE INFORMATION</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th  width="30%" class="">Full Name:</th>
						<td data-th='Full Name' class="txtFntSze">{{ $userDetails[0]->name }}</td>
					</tr>
					<tr>
						<th  width="30%" class="">Team Name:</th>
						<td data-th='Full Name' class="txtFntSze">{{ $userDetails[0]->team_name }}</td>
					</tr>
<!-- 					<tr>
						<th  width="30%" class="">Username:</th>
						<td data-th='Full Name' class="txtFntSze">{{ isset($userDetails->username) ? $userDetails->username:'' }}</td>
					</tr> -->
					<tr>
						<th  width="30%" class="">Email:</th>
						<td data-th='Email' class="txtFntSze">{{ $userDetails[0]->email }}</td>
					</tr>
					<tr>
						<th  width="30%" class="">Date Of Birth:</th>
						<td data-th='Phone Number' class="txtFntSze">{{ $userDetails[0]->DOB }}</td>
					</tr>
					<tr>
						<th  width="30%" class="">Gender:</th>
						<td data-th='Phone Number' class="txtFntSze">{{ $userDetails[0]->gender }}</td>
					</tr>
					<tr>
						<th  width="30%" class="">Phone:</th>
						<td data-th='Phone Number' class="txtFntSze">{{$userDetails[0]->mobile }}</td>
					</tr>

					<tr>
						<th  width="30%" class="">Wallet Amount:</th>
						<td data-th='Phone Number' class="txtFntSze">{{ $userDetails[0]->wallet }}</td>
					</tr>
					<tr>
						<th  width="30%" class="">Bonus Amount:</th>
						<td data-th='Phone Number' class="txtFntSze">{{ $userDetails[0]->referal_amount }}</td>
					</tr>
					<tr>
						<th  width="30%" class="">Winning Amount:</th>
						<td data-th='Phone Number' class="txtFntSze">{{ $userDetails[0]->won_amount }}</td>
					</tr>
					<tr>
						<th  width="30%" class="">Withdrawal amount:</th>
						<td data-th='Phone Number' class="txtFntSze">0</td>
					</tr>


				</tbody>
  </table>
  </div>




        </div>

    </div>
</div>
</div>


<div class="box" >
        <div class="box-body ">
<div class="row">
    <div class="col-md-12">
        <!-- <div class="alert alert-dismissible alert-success d-none" id="error_msg"></div> -->
        <div class="tile" style="margin-top: 20px; ">
            <h4>Joined Contest History</h4>


 <div class="table-responsive">

<table id="example_joined_contest" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            	<th>Contest Id</th>
                <th>Contest Name</th>
                <!-- <th>Series Name</th> -->
                <th>Joined On</th>
                <th>Status</th>
                <th>Won Amount</th>
                <th>Debit Winning</th>
                <th>Debit Wallet</th>
                <th>Refund Wallet</th>
                <th>Debit Referal</th>
                <th>Refund Referal</th>
            </tr>
        </thead>
        <tbody>
<!--                 <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td> -->

                {{-- @foreach($uc_all as $k => $v)
	                <tr>
	                	<td>{{!empty($v->contests->id) ? $v->contests->id : ''}}</td>
	                	<td>{{!empty($v->contests->name) ? $v->contests->name : ''}}</td>
	                	<!-- <td>{{!empty($v->contests->series) ? $series_match[$v->contests->series->id] : ''}}</td> -->
	                	<td data-order="{{strtotime($v->created_at)}}">{{ !empty($v->created_at) ?  Carbon::parse($v->created_at)->format(config::get("Reading.date_format"))  : '--' }}</td>
	                	<td>{!! isset($v->contests->status) && $v->contests->status != 1 ? '<span class="text-danger">cancelled</span>' : '<span class="text-success">Not Cancelled</span>' !!}</td>
	                	<td>{{!empty($v->contests->id) && isset($won_amount[$v->contests->id]) ? $won_amount[$v->contests->id] : '--'}}</td>
	                	<td>{{!empty($v->contests->id) && isset($debit_winning[$v->contests->id]) ? $debit_winning[$v->contests->id] : '--'}}</td>
	                	<td>{{!empty($v->contests->id) && isset($debit_walet[$v->contests->id]) ? $debit_walet[$v->contests->id] : '--'}}</td>
	                	<td>{{!empty($v->contests->id) && isset($refund_walet[$v->contests->id]) ? $refund_walet[$v->contests->id] : '--'}}</td>
	                	<td>{{!empty($v->contests->id) && isset($debit_referal[$v->contests->id]) ? $debit_referal[$v->contests->id] : '--'}}</td>
	                	<td>{{!empty($v->contests->id) && isset($refund_referal[$v->contests->id]) ? $refund_referal[$v->contests->id] : '--'}}</td>


	                </tr>
                @endforeach --}}
                @foreach ($contest_details as $k){
                    <tr>
                        <td>{{$k->contest_id}}</td>
                        <td>-</td>
                        <td>{{$k->created_at}}</td>
                        <td>Finished</td>
                        <td>{{$k->won_amount}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                }

                @endforeach

        </tbody>
        <tfoot>
            <tr>
            	<th>Contest Id</th>
                <th>Contest Name</th>
                <!-- <th>Series Name</th> -->
                <th>Date Joined</th>
                <th>Status</th>
                <th>Won Amount</th>
                <th>Debit Winning</th>
                <th>Debit Wallet</th>
                <th>Refund Wallet</th>
                <th>Debit Referal</th>
                <th>Refund Referal</th>
            </tr>
        </tfoot>
    </table>


	</div>
</div>
</div>
</div>
</div>
</div>




    <div class="box" >
        <div class="box-body ">
<div class="row">
    <div class="col-md-12">
        <!-- <div class="alert alert-dismissible alert-success d-none" id="error_msg"></div> -->
        <div class="tile" style="margin-top: 20px; ">
            <h4>Transaction History</h4>


 <div class="table-responsive">

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Type</th>
                <th>Date</th>
                <th>Tx ID</th>
                <th>Contest</th>
            </tr>
        </thead>
        <tbody>

<!--                 <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td> -->

                {{-- @foreach($uw_history as $k => $v)
	                <tr>
	                	<td>{{!empty($v->amount) ? $v->amount : 0}}</td>
	                	<td>
	                		@php

            if($v->transaction_type == 1){
                echo  'Added in wallet.';
            }elseif($v->transaction_type == 2){
                echo 'Wallet used to join contest.';
            }elseif($v->transaction_type == 3){
                echo  'Won from contest.';
            }elseif($v->transaction_type == 4 && $v->status == 0){
               echo  'Pending Withdraw request.';
            }elseif($v->transaction_type == 4 && $v->status == 1){
               echo  'Admin approved Withdraw request.';
            }elseif($v->transaction_type == 4&& $v->status == 2){
                echo 'Successfully Withdrawn won amount.';
            }elseif($v->transaction_type == 4&& $v->status == 3){
               echo  'Withdraw request rejected by admin.';
            }elseif($v->transaction_type == 5){
                echo 'Referral amount.';
            }elseif($v->transaction_type == 6){
               echo  'Referral used to join contest.';
            }elseif($v->transaction_type == 7){
               echo  'Winning amount used to join contest.';
            }


	                		@endphp

	                	</td>
	                	<td data-order="{{strtotime($v->created_at)}}">{{ !empty($v->created_at) ?  Carbon::parse($v->created_at)->format('d-M-Y, h:i a')  : '--' }}</td>
	                	<td>{{$v->transation_id}}</td>
	                	<td>{{!empty($v->contests->name) ? $v->contests->name : ''}}</td>
	                </tr>
                @endforeach --}}



        </tbody>
        <tfoot>
            <tr>
                <th>Amount</th>
                <th>Type</th>
                <th>Date</th>
                <th>Tx ID</th>
                <th>Contest</th>
            </tr>
        </tfoot>
    </table>


	</div>
</div>
</div>
</div>
</div>
</div>
</section>

<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
} );


$(document).ready(function() {
    $('#example_joined_contest').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
} );


</script>




<style type="text/css">
    table{ max-width:  800px;  }
    table tr th{ width: 200px !important;  }
    table th, table td{ font-size: 16px !important;  }


</style>
@stop
