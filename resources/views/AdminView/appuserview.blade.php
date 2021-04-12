@extends('AdminView.default')
@section('content')
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
			  <span class="info-box-text"><b>Ye App User View Hai</b> <br/>(Till Now)</span>
			  <span class="info-box-number"></span>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text"><b>Tournaments</b>  <br/>(Till Now)</span>
			  <span class="info-box-number"></span>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-purple"><i class="fa fa-trophy"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text"><b>Series</b> <br/>(Till Now)</span>
			  <span class="info-box-number"></span>
			</div>
		  </div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-handshake-o"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text"><b>Contests</b> <br/>(Till Now)</span>
			  <span class="info-box-number"></span>
			</div>
		  </div>
		</div>
	</div>



</section>
@stop
