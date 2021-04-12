<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <!-- CSRF Token -->

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{{Config::get("Site.title")}}}</title>

        <link rel="shortcut icon" type="image/x-icon" href="{{asset('front/img/profeud_favicon.ico')}}">

        <!-- Script -->

        <script src="{{ asset('js/admin/jquery.min.js') }}"></script>

        <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">

        <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>    

        <link href="{{ asset('css/admin/font-awesome.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/ionicons.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/morris.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/themify-icons.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/AdminLTE.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/custom_admin.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/bootmodel.css') }}" rel="stylesheet">

        <link href="{{ asset('css/admin/notification/jquery.toastmessage.css') }}" rel="stylesheet">

        <script src="{{ asset('css/admin/notification/jquery.toastmessage.js') }}"></script>

        <script src="{{ asset('js/admin/jquery.equalheights.js') }}"></script>

        <link href="{{ asset('css/admin/chosen.min.css') }}" rel="stylesheet">

        <script src="{{ asset('js/admin/chosen.jquery.min.js') }}"></script>

    </head>

    <body class="skin-black">

        <header class="header">



                <a href="{{URL::to('admin/dashboard')}}" class="logo">



                    <img src="{{ asset('img/logo.png')}}">

                    {{-- Config::get("Site.title") --}}

                </a>

            <!-- Header Navbar: style can be found in header.less -->

            <nav class="navbar navbar-static-top" role="navigation">

                <!-- Sidebar toggle button--> 

                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>

                <div class="navbar-right">

                    <ul class="nav navbar-nav">

                        <?php $authuser = Auth::user(); ?>

                       

                         

         

                       

                        <li class="dropdown user user-menu">

                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span>{{{ auth()->user()->full_name}}} <i class="caret"></i></span> </a>

                            <ul class="dropdown-menu">

                                <!-- Menu Footer-->

                                <li class="user-footer">

                                    <div class="pull-left"><a class="btn btn-default btn-flat" href="{{URL::to('admin/myaccount')}}">

                                        {{ trans("Edit Profile") }} </a> 

                                    </div>

                                    <div class="pull-right"> <a class="btn btn-default btn-flat" href="{{URL::to('admin/logout')}}">

                                        {{ trans("Logout") }} </a>

                                    </div>

                                </li>

								

                            </ul>

						

                        </li>

                    </ul>

                </div>

            </nav>

        </header>

        <!-- Start Main Wrapper -->

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?php 

                $segment1   =   Request::segment(1); //admin

                $segment2   =   Request::segment(2); //url

                $segment3   =   Request::segment(3); //parameters

                $segment4   =   Request::segment(4); 

                $segment5   =   Request::segment(5); 

                 

                ?>

            <aside class="left-side sidebar-offcanvas">

                <section class="sidebar">

                    <ul class='sidebar-menu'>

                        <!-- Super Admin Menu listing start here -->

                        @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2)

                        <li class="{{ ($segment2 == 'dashboard') ? 'active' : '' }} "><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-home  {{ ($segment3 == 'dashboard') ? '' : '' }}"></i>{{ trans("Dashboard") }} </a></li>



                        @can('hasPermitUsers')

                        <!-- <li class="{{ ($segment2 == 'users') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/users/'.USER)}}">

                            <i class="fa fa-users {{ $segment2 == 'users' ? '' : '' }}"></i>

                            {{'Users'}} 

                            </a>

                        </li> -->



                        <li class="treeview {{ in_array($segment2 ,array('users','bot-users')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-users  {{ in_array($segment2 ,array('users')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Users") }} </a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('cms-manager','email-manager','faqs-manager','email-logs','block-manager','subscriber','user-notification','bot-users')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment2 ,array('cms-manager')) ? 'display:block;' : 'display:none;' }}">



         



                                <li  @if($segment2 =='users' && $segment3 == 3  ) class="active" @endif>

                                <a href="{{URL::to('admin/users/'.USER)}}"><i class='fa fa-angle-double-right'></i>{{ trans("App Users") }} </a>

                                </li>



                                <li  @if($segment2 =='bot-users' ) class="active" @endif>

                                <a href="{{URL::to('admin/bot-users')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Bot Users") }} </a>

                                </li>

           

                                <!--         <li @if($segment2=='subscriber') class="active" @endif><a href="{{URL::to('admin/subscriber')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage Subscriber") }} </a></li> -->



                                @can('hasPermitSubadmin')

                                <li @if($segment2 =='users' && $segment3 == 2  ) class="active" @endif ><a href="{{URL::to('admin/users/2')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Sub Admin") }}  </a></li>





                                @endcan



                                <!--          <li @if($segment2=='user-notification') class="active" @endif><a href="{{URL::to('admin/user-notification')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Notifications") }} </a></li> -->



                            </ul>

                        </li>



                    <li class="{{ ($segment2 == 'promocode-manager') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/promocode-manager/')}}">

                            <i class="fa fa-tag {{ $segment2 == 'promocode-manager' ? '' : '' }}"></i>

                            {{'Promocodes'}} 

                            </a>

                        </li>

                    <li class="{{ ($segment2 == 'withdraw-amount') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/withdraw-amount/')}}">

                            <i class="fa fa-money {{ $segment2 == 'withdraw-amount' ? '' : '' }}"></i>

                            {{'Withdraw Request'}} 

                            </a>

                        </li>



                    <li class="{{ ($segment2 == 'kyc-doc') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/kyc-doc/')}}">

                            <i class="fa fa-file {{ $segment2 == 'kyc-doc' ? '' : '' }}"></i>

                            {{'KYC Doc'}} 

                            </a>

                        </li>                        

@endcan













@can('hasPermitGame')

                        <?php /*

                        <li class="{{ ($segment2 == 'games') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/games/')}}">



                            <i class="fa fa-gamepad {{ $segment2 == 'games' ? '' : '' }}"></i>

                            {{'Games'}} 

                            </a>

                        </li>

                        */ ?>

                        <li class="{{ ($segment2 == 'tournaments') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/tournaments/')}}">

                            <i class="fa fa-calendar {{ $segment2 == 'tournaments' ? '' : '' }}"></i>

                            {{'Tournaments'}} 

                            </a>

                        </li>



                        <?php /* 



                        <li class="{{ ($segment2 == 'stages') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/stages/')}}">

                            <i class="fa fa-anchor {{ $segment2 == 'stages' ? '' : '' }}"></i>

                            {{'Stages'}} 

                            </a>

                        </li>   



                        */ ?>                     



                        <li class="{{ ($segment2 == 'series') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/series/')}}">

                            <i class="fa fa-trophy {{ $segment2 == 'series' ? '' : '' }}"></i>

                            {{'Series'}} 

                            </a>

                        </li>



                        <?php /*



                        <li class="{{ ($segment2 == 'contests' || $segment2 == 'contest') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/contests/')}}">

                            <i class="fa fa-handshake-o {{ $segment2 == 'contests' ? '' : '' }}"></i>

                            {{'Contests'}} 

                            </a>

                        </li>

                        */ ?>



<li class="treeview {{ in_array($segment2 ,array('contests', 'contest', 'contest_category', 'user_contests', 'contest_template')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-handshake-o  {{ in_array($segment2 ,array('contests')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Contests") }} </a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('contests')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment2 ,array('contests')) ? 'display:block;' : 'display:none;' }}">



         



                                <li  @if($segment2 =='contests' ) class="active" @endif>

                                <a href="{{URL::to('admin/contests/')}}"><i class='fa fa-angle-double-right'></i>{{ trans("All Contests") }} </a>

                                </li>



                                <li  @if($segment2 =='user_contests' ) class="active" @endif>

                                  <a href="{{URL::to('admin/user_contests/')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Front User Contests") }} </a>

                                </li>                                

           



                                <li @if($segment2 =='contest_category' ) class="active" @endif ><a href="{{URL::to('admin/contest_category/')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Contest Category") }}  </a></li>





                                <li @if($segment2 =='contest_template' ) class="active" @endif ><a href="{{URL::to('admin/contest_template/')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Contest Template") }}  </a></li>


                                  <li @if($segment2 =='cricket_contest' ) class="active" @endif ><a href="{{URL::to('admin/cricket_contest/')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Cricket Contest") }}  </a></li>

                                 <li @if($segment2 =='cric_create' ) class="active" @endif ><a href="{{URL::to('admin/contests/cric_create/')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Create Cricket Contest") }}  </a></li>


  

                            </ul>

                        </li>















                        <li class="{{ ($segment2 == 'matches') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/matches/')}}">

                            <i class="fa fa-money {{ $segment2 == 'matches' ? '' : '' }}"></i>

                            {{'Matches'}} 

                            </a>

                        </li>



    <li class="{{ ($segment2 == 'cricket_matches') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/cricket_matches/')}}">

                            <i class="fa fa-money {{ $segment2 == 'cricket_matches' ? '' : '' }}"></i>

                            {{'Cricket Matches'}} 

                            </a>

                        </li>









                        <li class="{{ ($segment2 == 'players') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/players/')}}">

                            <i class="fa fa-user-o {{ $segment2 == 'players' ? '' : '' }}"></i>

                            {{'Players'}} 

                            </a>

                        </li>
                        <li class="{{ ($segment2 == 'cricket_players') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/cricket_players/')}}">

                            <i class="fa fa-user-o {{ $segment2 == 'cricket_players' ? '' : '' }}"></i>

                            {{'Cricket Players'}} 

                            </a>

                        </li> 
                                                <li class="{{ ($segment2 == 'cricket_players') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/add_new_player/')}}">

                            <i class="fa fa-user-o {{ $segment2 == 'add_new_player' ? '' : '' }}"></i>

                            {{'Add new Cricket Player'}} 

                            </a>

                        </li> 



<?php /*

                        <li class="{{ ($segment2 == 'teams') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/teams/')}}">

                            <i class="fa fa-link {{ $segment2 == 'teams' ? '' : '' }}"></i>

                            {{'Teams'}} 

                            </a>

                        </li>



                        <li class="{{ ($segment2 == 'players') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/players/')}}">

                            <i class="fa fa-user-o {{ $segment2 == 'players' ? '' : '' }}"></i>

                            {{'Players'}} 

                            </a>

                        </li>



                        

                        <li class="{{ ($segment2 == 'organisations') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/organisations/')}}">

                            <i class="fa fa-university {{ $segment2 == 'organisations' ? '' : '' }}"></i>

                            {{'Organizations'}} 

                            </a>

                        </li>

*/ ?>



@endcan



                        <?php /*

                        <li class="treeview {{ in_array($segment2 ,array('club','list-grade','team','fixture','game-prizes','game-points')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-th  {{ in_array($segment3 ,array('club','list-grade','team','fixture','game-prizes','game-points')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Game") }}</a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('club','list-grade','team','fixture','game-prizes','game-points')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment3 ,array('club','player-packs','purchase-player-packs','additional-player-logs')) ? 'display:block;' : 'display:none;' }}">

                                <li  @if($segment2 =='club') class="active" @endif>

                                <a href="{{URL::to('admin/club')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Basics") }} </a>

                                </li>

                                <li  @if($segment2 =='list-grade') class="active" @endif>

                                <a href="{{URL::to('admin/list-grade')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Grades") }} </a>

                                </li>

                                <li  @if($segment2 =='team') class="active" @endif>

                                <a href="{{URL::to('admin/team')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Teams") }} </a>

                                </li>

                                <li  @if($segment2 =='fixture') class="active" @endif>

                                <a href="{{URL::to('admin/fixture')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Fixtures") }} </a>

                                </li>

                                <li  @if($segment2 =='game-prizes') class="active" @endif>

                                <a href="{{URL::to('admin/game-prizes')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Prizes") }} </a>

                                </li>

                                @if(Auth::guard('admin')->user()->user_role == SUPER_ADMIN_ROLE_ID)

                                <li  @if($segment2 =='game-points') class="active" @endif>

                                <a href="{{URL::to('admin/game-points')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Point System") }} </a>

                                </li>

                                @endif

                            </ul>

                        </li>

                        <li class="treeview {{ in_array($segment2 ,array('player','additional-player-logs','player-packs')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-th  {{ in_array($segment3 ,array('player','additional-player-logs','player-packs')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Players") }}</a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('player','additional-player-logs')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment3 ,array('club','player-packs','additional-player-logs')) ? 'display:block;' : 'display:none;' }}">

                                <li  @if($segment2 =='player') class="active" @endif>

                                <a href="{{URL::to('admin/player')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Players") }} </a>

                                </li>

                                <li  @if($segment2 =='player-packs') class="active" @endif>

                                <a href="{{URL::to('admin/player-packs')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Purchase Players") }} </a>

                                </li>

                                <li  @if($segment2 =='additional-player-logs') class="active" @endif>

                                <a href="{{URL::to('admin/additional-player-logs')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Purchase Log") }} </a>

                                </li>

                                <!-- <li  @if($segment2 =='availability') class="active" @endif>

                                    <a href="{{URL::to('admin/availability')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Availability") }} </a>

                                    </li> -->

                            </ul>

                        </li>

                        <li class="{{ ($segment2 == 'users') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/users/'.USER)}}">

                            <i class="fa fa-users {{ $segment2 == 'users' ? '' : '' }}"></i>

                            {{'Users'}} 

                            </a>

                        </li>

                        <li class="{{ ($segment2 == 'sponsor') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/sponsor')}}">

                            <i class="fa fa-cc-diners-club {{ $segment2 == 'sponsor' ? '' : '' }}"></i> {{'MCT Partners '}} 

                            </a>

                        </li>

                        <li class="{{ ($segment2 == 'about-club') ? 'active in' : '' }}">

                            <a href="{{URL::to('admin/about-club')}}">

                            <i class="fa fa-cc-diners-club {{ $segment2 == 'about-club' ? '' : '' }}"></i>

                            {{'About Club'}} 

                            </a>

                        </li>

                        <!-- About US -->

                        <li class="treeview {{ in_array($segment2 ,array('platform','serve','partner','user-slider','team-slider')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-th  {{ in_array($segment3 ,array('platform','serve','team-slider')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("About us") }}</a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('platform','serve','partner','user-slider')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment3 ,array('platform','partner','serve','user-slider','team-slider')) ? 'display:block;' : 'display:none;' }}">

                                <li  @if($segment2 =='platform' || $segment3 =='platform') class="active" @endif>

                                <a href="{{URL::to('admin/platform')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Platform Manager") }} </a>

                                </li>

                                <li  @if($segment2 =='serve') class="active" @endif>

                                <a href="{{URL::to('admin/serve')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Serve Slider") }} </a>

                                </li>

                                <li  @if($segment2 =='partner') class="active" @endif>

                                <a href="{{URL::to('admin/partner')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Partner Slider") }} </a>

                                </li>

                                <li  @if($segment2 =='user-slider') class="active" @endif>

                                <a href="{{URL::to('admin/user-slider')}}"><i class='fa fa-angle-double-right'></i>{{ trans("User Slider") }} </a>

                                </li>

                                <li  @if($segment2 =='team-slider') class="active" @endif>

                                <a href="{{URL::to('admin/team-slider')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Team Slider") }} </a>

                                </li>

                            </ul>

                        </li>

                        <li class="treeview {{ in_array($segment2 ,array('slider-manager','clubs-slider')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-th  {{ in_array($segment2 ,array('slider-manager','clubs-slider')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Slider Manager") }}</a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('slider-manager','clubs-slider')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment2 ,array('slider-manager','clubs-slider')) ? 'display:block;' : 'display:none;' }}">

                                <li  @if($segment2 =='slider-manager' && $segment3 == 'clubs-slider') class="active" @endif>

                                <a href="{{URL::to('admin/slider-manager/clubs-slider')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Club Slider") }} </a>

                                </li>

                                <li  @if($segment2 =='slider-manager' && $segment3 == 'fantasy-slider') class="active" @endif>

                                <a href="{{URL::to('admin/slider-manager/fantasy-slider')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Fantasy Slider") }} </a>

                                </li>

                                <li  @if($segment2 =='slider-manager' && $segment3 == 'platfrom-feature') class="active" @endif>

                                <a href="{{URL::to('admin/slider-manager/platfrom-feature')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Platform Feature") }} </a>

                                </li>

                            </ul>

                        </li>

                        <li class="treeview {{ in_array($segment2 ,array('dropdown-manager','food-category')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-th  {{ in_array($segment2 ,array('dropdown-manager','bowl-style','bat-style')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Masters") }}</a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('dropdown-manager','bowl-style','bat-style')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment2 ,array('dropdown-manager','bowl-style','bat-style')) ? 'display:block;' : 'display:none;' }}">

                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'position') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/position')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Position") }} </a>

                                </li>

                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'club-position') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/club-position')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Club Position") }} </a>

                                </li>



                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'club-position') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/bat-style')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Batting Style") }} </a>

                                </li>



                                 <li  @if($segment2 =='dropdown-manager' && $segment3 == 'club-position') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/bowl-style')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Bowling Style") }} </a>

                                </li>

                       

                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'svalue') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/svalue')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Value") }} </a>

                                </li>

                                <!-- <li  @if($segment2 =='dropdown-manager' && $segment3 == 'jvalue') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/jvalue')}}"><i class='fa fa-angle-double-right'></i>{{ trans("JValue") }} </a>

                                </li> -->

                                <!-- <li  @if($segment2 =='dropdown-manager' && $segment3 == 'teamtype') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/teamtype')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Team Type") }} </a>

                                </li> -->

                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'teamcategory') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/teamcategory')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Team Category") }} </a>

                                </li>

                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'matchtype') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/matchtype')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Match Type") }} </a>

                                </li>

                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'vanue') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/vanue')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Vanue") }} </a>

                                </li>

                                <li  @if($segment2 =='dropdown-manager' && $segment3 == 'about-us') class="active" @endif>

                                <a href="{{URL::to('admin/dropdown-manager/about-us')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Here About Us") }} </a>

                                </li>

                            </ul>

                        </li>

                          */ ?>

    @if(Auth::user()->can('hasPermitCms') && Auth::user()->can('hasPermitEmail'))

                        <li class="treeview {{ in_array($segment2 ,array('cms-manager','no-cms-manager','faqs-manager','categories','email-manager','email-logs','block-manager','subscriber','user-notification')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-desktop  {{ in_array($segment2 ,array('cms-manager','email-manager','email-logs','block-manager','faqs-manager','subscriber','user-notification')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("System Management") }} </a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('cms-manager','email-manager','faqs-manager','email-logs','block-manager','subscriber','user-notification')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment2 ,array('cms-manager')) ? 'display:block;' : 'display:none;' }}">



                        @can('hasPermitCms')



                                <li  @if($segment2 =='cms-manager') class="active" @endif>

                                <a href="{{URL::to('admin/cms-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage CMS") }} </a>

                                </li>

                        @endcan

                        <!--         <li @if($segment2=='subscriber') class="active" @endif><a href="{{URL::to('admin/subscriber')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage Subscriber") }} </a></li> -->

                            @can('hasPermitEmail')

                                <li @if($segment2 =='email-manager') class="active" @endif ><a href="{{URL::to('admin/email-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage Email Templete") }} </a></li>



                                <li @if($segment2=='email-logs') class="active" @endif><a href="{{URL::to('admin/email-logs')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage Email Logs") }} </a></li>

                            @endcan



                       <!--          <li @if($segment2=='user-notification') class="active" @endif><a href="{{URL::to('admin/user-notification')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Notifications") }} </a></li> -->



                            </ul>

                        </li>

    @endif

        

@can('hasPermitSetting')           

                        <li class="treeview {{ in_array($segment2 ,array('settings')) ? 'active in' : 'offer-reports' }} {{ in_array($segment2 ,array('language-settings')) ? 'active in' : 'offer-reports' }}">

                            <a href="javascript::void(0)"><i class="fa fa-cogs  {{ in_array($segment2 ,array('settings')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Manage Settings")  }} </a>

                            <ul class="treeview-menu {{ in_array($segment2 ,array('settings')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment2 ,array('settings')) ? 'display:block;' : 'display:none;' }}">

                                <li  @if($segment2=='settings' && Request::segment(4)=='Site') class="active" @endif>

                                <a href="{{URL::to('admin/settings/prefix/Site')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage Site Settings") }} </a>

                                </li>

                                <li  @if($segment2=='settings' && Request::segment(4)=='Reading') class="active" @endif>

                                <a href="{{URL::to('admin/settings/prefix/Reading')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage Reading Settings") }} </a>

                                </li>

                                <li  @if($segment2=='settings' && Request::segment(4)=='Social') class="active" @endif>

                                <a href="{{URL::to('admin/settings/prefix/Social')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Manage Social Setting") }} </a>

                                </li> 

                            </ul>

                        </li>

@endcan

                        @endif

                    

                     



                                        

                    </ul>



                </section>

                @if(Auth::user()->user_role != 1)

                <div class="lobby_link">

        <!--         <span><a class="btn btn-info" href="{{ URL::to('/lobby')}}">Go to Lobby</a></span><br> -->

                <span>&copy;{{Config::get('Site.copyrights')}}{{date('Y',time())}}</span>

                </div>

                @endif

            </aside>

            <!-- Main Container Start -->

            <aside class="right-side">

                @if(Session::has('error'))

                <script type="text/javascript"> 

                    $(document).ready(function(e){

                        

                        show_message("{{{ Session::get('error') }}}",'error');

                    });

                </script>

                @endif

                @if(Session::has('success'))

                <script type="text/javascript"> 

                    $(document).ready(function(e){

                        show_message("{{{ Session::get('success') }}}",'success');

                    });

                </script>

                @endif

                @if(Session::has('flash_notice'))

                <script type="text/javascript"> 

                    $(document).ready(function(e){

                        show_message("{{{ Session::get('flash_notice') }}}",'success');

                    });

                </script>

                @endif

                <div id="loader_img" style="display:none">

                    <center><img src="{{WEBSITE_IMG_URL}}spin.gif" style="height: 87px; margin-top: 24%; width: 87px;"></center>

                </div>

                @yield('content')

            </aside>

        </div>

        <?php echo Config::get("Site.copyright_text"); ?>

    </body>

</html>

<script src="{{ asset('js/admin/bootbox.js') }}"></script>

<script src="{{ asset('js/admin/core/mws.js') }}"></script>

<script src="{{ asset('js/admin/core/themer.js') }}"></script>

<script src="{{ asset('js/admin/app.js') }}"></script>

<script src="{{ asset('css/admin/fancybox/jquery.fancybox.js') }}"></script>

<link href="{{ asset('css/admin/fancybox/jquery.fancybox.css') }}" rel="stylesheet">

<link href="{{ asset('css/admin/bootmodel.css') }}" rel="stylesheet">

<script type="text/javascript">

    $(".chosen_select").chosen();

    function show_message(message,message_type) {

        $().toastmessage('showToast', { 

            text: message,

            sticky: false,

             hideAfter: 500000,

    

            position: 'top-right',

            type: message_type,

        });

    }

            

    $(function(){





        $('.items-inner').equalHeights();

    });

    



</script>

@stack('scripts')