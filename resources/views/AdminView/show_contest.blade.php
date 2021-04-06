@extends('AdminView.default')
@section('content')
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <link href="{{ asset('css/bootstrap-datepicker.css') }}"
          rel="stylesheet">
    <!-- date time picker js and css and here-->
    <script>
        jQuery(document).ready(function() {
            $(".choosen_selct").chosen();
        });

    </script>
    <style>
        .chosen-container-single .chosen-single {
            height: 34px !important;
            padding: 3px 6px;
        }

    </style>
    <section class="content-header">
        <h1>Contests </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">{{ trans('Contests') }}</li>
        </ol>
    </section>
    <section class="content">


        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <a href="{{ URL::to('admin/contest/create') }}"
                       class="btn btn-success btn-small  pull-right"
                       style="margin:0;">{{ trans('Add New Contest') }} </a>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            {{ Form::open(['role' => 'form', 'url' => 'admin/contests/', 'class' => 'mws-form', 'method' => 'get']) }}
            {{ Form::hidden('display') }}

            {{ Form::select('is_active', ['' => trans('Select Status'), 0 => 'Inactive', 1 => 'Active'], isset($searchVariable['is_active']) ? $searchVariable['is_active'] : '', ['class' => 'form-control choosen_selct']) }}

            <div class="col-md-2 col-sm-2">
                <div class="form-group ">
                    {{ Form::text('name', isset($searchVariable['name']) ? $searchVariable['name'] : '', ['class' => 'form-control', 'placeholder' => 'Name']) }}
                </div>
            </div>

            <div class="col-md-2 col-sm-2">
                <button class="btn btn-primary"
                        style="margin:0;"><i class='fa fa-search '></i> {{ trans('Search') }}</button>
                <a href="{{ URL::to('admin/contests/') }}"
                   class="btn btn-primary"
                   style="margin:0;"><i class='fa fa-refresh '></i> {{ trans('Reset') }}</a>
            </div>
            {{ Form::close() }}

        </div> --}}

        <div class="box">
            <div class="box-body ">



                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                NameE
                            </th>
                            <th>
                                Series
                            </th>


                            <th>
                                Entry_fee
                            </th>
                            <th>
                                Min Entry
                            </th>
                            <th>
                                Max Entry
                            </th>


                            <th>

                                Created On
                            </th>
                            <th class="sorting">Status</th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    @if (!$result->isEmpty())
                        @foreach ($result as $key => $record)
                            <tr>
                                <td>
                                    {{ $record->match_id }}
                                </td>
                                <td>
                                    {{ $record->contest_name }}
                                </td>

                                <td>
                                    {{ !empty($record->series->title) ? $record->series->title : '--' }}

                                </td>
                                <td>{{ $record->entry_fee }}</td>
                                <td>{{ $record->min_entry }}</td>
                                <td>{{ $record->max_entry }}</td>

                                <td>
                                    {{-- {{ date(config::get('Reading.date_format'), strtotime($record->created_at)) }} --}}
                                    {{$record->created_at}}
                                </td>
                                <td>
                                    @if ($record->status == 1)
                                        <span class="label label-primary">Active</span>
                                    @else
                                        <span class="label label-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>





                                    {{-- <a class="btn btn-primary"
                                       href="{{ route('contest.show', $record->id) }}"
                                       title="View"><i class="fa fa-lg fa-eye"></i></a> --}}

                                    @if ($record->status == 1)

                                        <a class="btn btn-primary"
                                           href="{{ route('contest.edit', $record->id) }}"
                                           title="Edit"><i class="fa fa-lg fa-edit"></i></a>
                                        @if ($record->game_status != 'live')
                                            <a class="btn btn-primary delete"
                                               href="{{ route('contest.delete', $record->id) }}"
                                               title="Delete"><i class="fa fa-lg fa-trash"></i></a>
                                        @endif





                                        @if (empty($record->bot_status))
                                            <a href="{{ URL::to('admin/contests/active/' . $record->id) }}"
                                               title="Bot Deactive"
                                               class="btn btn-success"><i class="fa fa-user-plus"
                                                   aria-hidden="true"></i></a>
                                        @else
                                            <a href="{{ URL::to('admin/contests/active/' . $record->id) }}"
                                               title="Bot Active"
                                               class="btn btn-warning"><i class="fa fa-user-times"
                                                   aria-hidden="true"></i></a>
                                        @endif


                                        <a href="{{ URL::to('admin/contest/cancel/' . $record->id) }}"
                                           title="Cancel"
                                           class="btn btn-danger"
                                           onclick="return confirm('Are you sure?');"><i class="fa fa-times"
                                               aria-hidden="true"></i></a>

                                    @endif




                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="alignCenterClass"
                                colspan="9">No record is yet available.</td>
                        </tr>
                    @endif
                </table>





            </div>
            <div class="box-footer clearfix">
                <div class="col-md-3 col-sm-4 "></div>
                {{-- <div class="col-md-9 col-sm-8 text-right ">@include('pagination.default', ['paginator' => $result])</div> --}}
            </div>
        </div>
    </section>

@stop