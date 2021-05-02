@extends('AdminView.default')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>



    <section class="content-header">

        {{-- <h1>@if (isset($contest)) {{ 'Update' }} @else {{ 'Add' }}@endif Contest </h1> --}}

        <ol class="breadcrumb">

            <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li><a href="{{ URL::to('admin/contests') }}">{{ trans('Contests') }}</a></li>

            {{-- <li class="active">@if (isset($contest)) {{ 'Update' }} @else {{ 'Add' }}@endif Contest</li> --}}

        </ol>

    </section>

    <section class="content">





        <div class="box">

            <div class="box-body ">





                <div class="col-md-12">

                    <div class="alert alert-dismissible alert-success d-none" id="error_msg"></div>

                    <div class="tile">
                        {{-- class="add-form" --}}
                        <form method="post" action="{{url('/admin/football/contest/create')}}">

                            @csrf

                            <div class="form-group">

                                <label for="contest_category">Contest Category</label>

                                <select class="form-control" name="category" id="contest_category">

                                    <option value="">--Select Contest Category--</option>

                                    @foreach ($res as $id => $category)


                                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>



                                <!-- </select> -->

                            </div>





                            <div class="form-group">

                                <label for="contest_category">Football Match(Teams)(Tournament)</label>

                                <select class="form-control" name="match" id="series_id">

                                    <option value="">--Select Match--</option>

                                    @foreach ($res2 as $i)

                                        {{-- <option value="{{ $i->fixture_id }}">{{$i->localteam_data['name'] }} vs {{$i->visitorteam_data['name']}} ({{$i->type}}) ({{ $i->fixture_id }}) </option> --}}
                                        <option value="{{ $i->match_key }}">{{ $i->match_name }}({{ $i->match_key }})</option>


                                    @endforeach

                                </select>

                            </div>

                            <div id="games">

                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="name">Name</label>

                                            <input type="text" name="contest_name" id="name" class="form-control"
                                                placeholder="Contest Name" value="">

                                        </div>

                                    </div>

                                    <div class="col-md-4 normal-entry ">

                                        <div class="form-group">

                                            <label for="min_entry">Min. entry </label>

                                            <input type="text" name="min_entry" id="min_entry" class="form-control"
                                                placeholder="Min. entry" value="">

                                        </div>

                                    </div>

                                    <div class="col-md-4 normal-entry">

                                        <div class="form-group">

                                            <label for="max_entry">Max. entry</label>

                                            <input type="text" name="max_entry" id="max_entry" class="form-control"
                                                placeholder="Max. entry" value="">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">



                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="entry_fee">Entry Fee</label>

                                            <div class="input-group">

                                                <!-- <div class="input-group-prepend">

                                        <span class="input-group-text" id="basic-addon1">$</span>

                                      </div> -->

                                                <span class="input-group-addon">$</span>

                                                <input type="text" name="entry_fee" id="entry_fee" class="form-control"
                                                    placeholder="Entry Fee" value="">

                                            </div>

                                        </div>

                                    </div>





                                    {{-- <div class="col-md-4">

                                        <div class="form-group">

                                            <label>Admin Commission</label>

                                            <div class="input-group">

                                                <input type="radio" class="choose-comm-type" id="amt_type" name="amt_type"
                                                    value="per"> &nbsp;

                                                <label>In Percent</label>&nbsp;&nbsp;

                                                <input type="radio" class="choose-comm-type" name="amt_type"
                                                    value="fix">&nbsp;

                                                <label>Fixed Value</label>

                                            </div>



                                        </div>

                                    </div>





                                    <div class="col-md-4 " style="">

                                        <div class="form-group">

                                            <label for="admin_per">Admin Commission (in %)</label>

                                            <div class="input-group">

                                                <input type="text" name="admin_per" id="admin_per" class="form-control"
                                                    placeholder="Admin Commission (in %)" value="">

                                                <!-- <div class="input-group-append">

                                        <span class="input-group-text">%</span>

                                      </div> -->

                                                <span class="input-group-addon">%</span>

                                            </div>

                                            <input type="hidden" name="admin_amt" id="admin_amt" value="">

                                        </div>

                                    </div>



                                    <div class="col-md-4 " style="">

                                        <div class="form-group">

                                            <label for="admin_fix">Admin Commission (Fixed Amount)</label>

                                            <div class="input-group">

                                                <input type="text" name="admin_fix" id="admin_fix" class="form-control"
                                                    placeholder="Admin Commission (Fixed Amount)" value="">

                                                <!-- <div class="input-group-append">

                                        <span class="input-group-text">%</span>

                                      </div> -->

                                                <span class="input-group-addon">%</span>

                                            </div>

                                            <input type="hidden" name="admin_fix_amt" id="admin_fix_amt" value="">

                                        </div>

                                    </div> --}}

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label >Admin Commission</label>

                                            <div class="input-group">

                                                <input type="radio" class="choose-comm-type" id="amt_type" name="amt_type" {{ !empty($contest['amt_type']) && $contest['amt_type'] == 1  ? 'checked' : '' }}  {{isset($contest['is_free']) && $contest['is_free'] == 1 ? 'disabled' : ''}} value="per"> &nbsp;

                                                <label>In Percent</label>&nbsp;&nbsp;

                                                <input type="radio" class="choose-comm-type"  name="amt_type" {{  !empty($contest['amt_type']) && $contest['amt_type'] == 2 ? 'checked' : '' }}  {{isset($contest['is_free']) && $contest['is_free'] == 1 ? 'disabled' : ''}} value="fix">&nbsp;

                                                <label>Fixed Value</label>

                                            </div>



                                        </div>

                                    </div>





                                    <div class="col-md-4 " style="{{  !empty($contest['amt_type']) && $contest['amt_type'] == 1   ? '' : 'display: none;' }}">

                                        <div class="form-group">

                                            <label for="admin_per">Admin Commission (in %)</label>

                                            <div class="input-group">

                                              <input type="text" name="admin_per" id="admin_per" class="form-control" placeholder="Admin Commission (in %)" value="@if(isset($contest['admin_per'])){{ $contest['admin_per'] }}@endif">

                                              <!-- <div class="input-group-append">

                                                <span class="input-group-text">%</span>

                                              </div> -->

                                              <span class="input-group-addon">%</span>

                                            </div>

                                            <input type="hidden" name="admin_amt" id="admin_amt" value="@if(isset($contest['admin_amt'])){{ $contest['admin_amt'] }}@endif">

                                        </div>

                                    </div>



                                    <div class="col-md-4 " style="{{  !empty($contest['amt_type']) && $contest['amt_type'] == 2  ? '' : 'display: none;' }}">

                                        <div class="form-group">

                                            <label for="admin_fix">Admin Commission (Fixed Amount)</label>

                                            <div class="input-group">

                                              <input type="text" name="admin_fix" id="admin_fix" class="form-control" placeholder="Admin Commission (Fixed Amount)" value="@if(isset($contest['admin_fix'])){{ $contest['admin_fix'] }}@endif">

                                              <!-- <div class="input-group-append">

                                                <span class="input-group-text">%</span>

                                              </div> -->

                                              <span class="input-group-addon">%</span>

                                            </div>

                                {{--       <input type="hidden" name="admin_fix_amt" id="admin_fix_amt" value="@if(isset($contest['admin_fix_amt'])){{ $contest['admin_fix_amt'] }}@endif"> --}}

                                        </div>

                                    </div>



                                  </div>

                                </div>

                                <div class="row">





                                    <div class="col-md-4">



                                        <div class="animated-checkbox">

                                            <label>

                                                <input type="checkbox" name="is_free" id="is_free" value="1"><span
                                                    class="label-text">Free Contest</span>

                                            </label>

                                        </div>

                                        <div class="animated-checkbox">

                                            <label>

                                                <input type="checkbox" name="is_featured" id="is_featured" value="1"><span
                                                    class="label-text">Featured Contest</span>

                                            </label>

                                        </div>



                                        <div class="animated-checkbox">

                                            <label>

                                                <input type="checkbox" name="is_confirmed" id="is_confirmed" value="1"><span
                                                    class="label-text">Is Confirmed?</span>

                                            </label>

                                        </div>



                                        <div class="animated-checkbox">

                                            <label>

                                                <input type="checkbox" name="is_clonable" id="is_clonable" value="1"><span
                                                    class="label-text">Is Clonable?</span>

                                            </label>

                                        </div>




                                    </div>







                                </div>



                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>Number of entries per User</label>

                                            <input type="text" name="entry_per_user" class="form-control"
                                                id="entry_per_user" placeholder="Entry per User" value="">

                                        </div>

                                    </div>





                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>Prize distribution</label>

                                            <div class="input-group">

                                                <input type="radio" class="choose-prize-distribution" id="prize_type"
                                                    name="prize_type" value="per"> &nbsp;

                                                <label>In Percent</label>&nbsp;&nbsp;

                                                <input type="radio" class="choose-prize-distribution" name="prize_type"
                                                    value="fix">&nbsp;

                                                <label>Fixed Value</label>

                                            </div>



                                        </div>

                                    </div>



                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-md-6"><label class="h4">Prize Breakdown </label> <a
                                            class="btn btn-primary add-breakdown" href="#"><i
                                                class="fa fa-lg fa-plus"></i></a></div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="winning_amt">Winning Amount</label>

                                            <input type="text" readonly class="form-control" name="winning_amt"
                                                id="winning_amt" value="">

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="winning_amt">Breakdown Total</label>

                                            <input type="text" readonly class="form-control" name="breakdown"
                                                id="breakdown_amt" value="">

                                        </div>

                                    </div>

                                </div>



                                <div class="row">

                                    <div class="col-md-2">From Rank</div>


                                    <div class="col-md-2">To Rank</div>

                                    <div class="col-md-2 percent_header" style="">Prize Percent</div>

                                    <div class="col-md-2">Prize Amount</div>

                                    <div class="col-md-2">Amount Per Person</div>

                                </div>


                                <div id="pool_breakdown">





                                    <div class="row breakdown-row">

                                        <div class="col-md-2 from-col">

                                            <div class="form-group">




                                                <input type="text" class="form-control from" name="from[]" id="from1"
                                                    value="">





                                            </div>

                                        </div>

                                        <div class="col-md-2 to-col">

                                            <div class="form-group">


                                                <input type="text" class="form-control to" name="to[]" id="to2" value="">



                                            </div>

                                        </div>

                                        <div class="col-md-2" style="">

                                            <div class="form-group percent-col">

                                                <div class="input-group">

                                                    <input type="text" name="percent[]" id="percent2"
                                                        class="form-control percent" placeholder="%" value="">

                                                    <!-- <div class="input-group-append">

                                                <span class="input-group-text">%</span>

                                              </div> -->

                                                    <span class="input-group-addon">%</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2 amount-col">

                                            <div class="form-group">

                                                <div class="input-group">


                                                    <span class="input-group-addon">$</span>

                                                    <input type="text" name="amount[]" id="amount2"
                                                        class="form-control amount" placeholder="Amount" value="">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2 person-col">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <span class="input-group-addon">$</span>

                                                    <input type="text" name="person[]" id="person3"
                                                        class="form-control person" placeholder="Amount Per Person"
                                                        value="">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2">



                                            <div class="btn-group">

                                        <a class="btn btn-primary remove-breakdown" href="#"><i class="fa fa-lg fa-minus"></i></a>

                                    </div>


                                        </div>

                                    </div>



                                    {{-- <div class="row breakdown-row">

                                <div class="col-md-2 from-col">

                                    <div class="form-group">

                                        <?php
/*

                                        <select class="form-control from" name="from[]" id="from">

                                            <option value="">-</option>

                                        </select>

                                        */
?>



                                <input type="text"  class="form-control from" name="from[]" id="from2" >





                                    </div>

                                </div>

                                <div class="col-md-2 to-col">

                                    <div class="form-group">

                                        <?php
/*

                                        <select class="form-control to" name="to[]" id="to">

                                            <option value="">-</option>

                                        </select>



                                        */
?>



                                <input type="text"  class="form-control to" name="to[]" id="to3">



                                    </div>

                                </div>

                                <div class="col-md-2 percent-col">

                                    <div class="form-group">

                                        <div class="input-group">

                                          <input type="text" name="percent[]" id="percent3" class="form-control percent" placeholder="%">

                                          <!-- <div class="input-group-append">

                                            <span class="input-group-text">%</span>

                                          </div> -->

                                           <span class="input-group-addon">%</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2 amount-col">

                                    <div class="form-group">

                                        <div class="input-group">

                                          <!-- <div class="input-group-prepend">

                                            <span class="input-group-text" id="basic-addon1">$</span>

                                          </div> -->

                                          <span class="input-group-addon">$</span>

                                          <input type="text" name="amount[]" id="amount1" class="form-control amount" placeholder="Amount" readonly>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2 person-col">

                                    <div class="form-group">

                                        <div class="input-group">

                                          <!-- <div class="input-group-prepend">

                                            <span class="input-group-text" id="basic-addon1">$</span>

                                          </div> -->

                                          <span class="input-group-addon">$</span>

                                            <input type="text" name="person[]" id="person1" class="form-control person" placeholder="Amount Per Person">

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                </div>

                            </div>



                        </div>

        	  		</div> --}}
                                    {{-- <a href="/admin/football/contest/create"> --}}
                                    <div class="row breakdown-row d-none" id="breakdown-row">

                                        <div class="col-md-2 from-col">

                                            <div class="form-group">



                                                <?php
                                                /*

                                                <select class="form-control from" name="from[]" id="from">

                                                    <option value="">-</option>

                                                    @if (isset($breakdown))

                                                        @for ($i = 1; $i <= $contest['max_entry']; $i++)

                                                            <option value="{{ $i }}">{{ $i }}</option>

                                                        @endfor

                                                    @endif

                                                </select>



                                                */
                                                ?>







                                                <input type="text" class="form-control from" name="from[]" id="from">





                                            </div>

                                        </div>

                                        <div class="col-md-2 to-col">

                                            <div class="form-group">

                                                <?php
                                                /*

                                                <select class="form-control to" name="to[]" id="to">

                                                    <option value="">-</option>

                                                    @if (isset($breakdown))

                                                        @for ($i = 1; $i <= $contest['max_entry']; $i++)

                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>

                                                        @endfor

                                                    @endif

                                                </select>

                                                */
                                                ?>



                                                <input type="text" class="form-control to" name="to[]" id="to1">





                                            </div>

                                        </div>

                                        <div class="col-md-2 percent-col">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <input type="text" name="percent[]" id="percent1"
                                                        class="form-control percent" placeholder="%">

                                                    <!-- <div class="input-group-append">

                                            <span class="input-group-text">%</span>

                                          </div> -->

                                                    <span class="input-group-addon">%</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2 amount-col">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <!-- <div class="input-group-prepend">

                                            <span class="input-group-text" id="basic-addon1">$</span>

                                          </div> -->

                                                    <span class="input-group-addon">$</span>

                                                    <input type="text" name="amount[]" id="amount"
                                                        class="form-control amount" placeholder="Amount" readonly>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2 person-col">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <!-- <div class="input-group-prepend">

                                            <span class="input-group-text" id="basic-addon1">$</span>

                                          </div> -->

                                                    <span class="input-group-addon">$</span>

                                                    <input type="text" name="person[]" id="person2"
                                                        class="form-control person" placeholder="Amount Per Person">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="btn-group">

                                                <a class="btn btn-primary remove-breakdown" href="#"><i
                                                        class="fa fa-lg fa-minus"></i></a>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary" />
                            {{-- </a> --}}
                        </form>

                    </div>

                </div>

            </div>



        </div>





    </section>

@endsection
{{-- <script>
    function submit(e){
        e.preventDefault();
        document.querySelector('.add-form').submit();
    }
</script> --}}


@push('scripts')
    <script type="text/javascript" src="{{ asset('js/common/event.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/contest/event.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>

    <style type="text/css">
        .d-none,
        .d_none {

            display: none !important;

        }

    </style>

@endpush
