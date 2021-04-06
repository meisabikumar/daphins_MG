<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- CSRF Token -->

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title></title>

    <link rel="shortcut icon"
          type="image/x-icon"
          href="{{ asset('front/img/profeud_favicon.ico') }}">

    <!-- Script -->

    <script src="{{ asset('js/admin/jquery.min.js') }}"></script>

    <link href="{{ asset('css/admin/bootstrap.min.css') }}"
          rel="stylesheet">

    <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>

    <link href="{{ asset('css/admin/font-awesome.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/ionicons.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/morris.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/jquery-jvectormap-1.2.2.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/bootstrap3-wysihtml5.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/themify-icons.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/AdminLTE.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/custom_admin.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/bootmodel.css') }}"
          rel="stylesheet">

    <link href="{{ asset('css/admin/notification/jquery.toastmessage.css') }}"
          rel="stylesheet">

    <script src="{{ asset('css/admin/notification/jquery.toastmessage.js') }}"></script>

    <script src="{{ asset('js/admin/jquery.equalheights.js') }}"></script>

    <link href="{{ asset('css/admin/chosen.min.css') }}"
          rel="stylesheet">

    <script src="{{ asset('js/admin/chosen.jquery.min.js') }}"></script>

</head>

<body class="skin-black">

    <header class="header">



        <a href="{{ URL::to('admin/dashboard') }}"
           class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </a>

        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-static-top"
             role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#"
               class="navbar-btn sidebar-toggle"
               data-toggle="offcanvas"
               role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>

            <div class="navbar-right">

                <ul class="nav navbar-nav">

                    <?php $authuser = Auth::user(); ?>


                    <li class="dropdown user user-menu">

                        <a href="javascript:void(0);"
                           class="dropdown-toggle"
                           data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span>user name <i class="caret"></i></span> </a>

                        <ul class="dropdown-menu">

                            <!-- Menu Footer-->

                            <li class="user-footer">

                                <div class="pull-left"><a class="btn btn-default btn-flat"
                                       href="{{ URL::to('admin/myaccount') }}">

                                        {{ trans('Edit Profile') }} </a>

                                </div>

                                <div class="pull-right"> <a class="btn btn-default btn-flat"
                                       href="{{ URL::to('admin/logout') }}">

                                        {{ trans('Logout') }} </a>

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

        <aside class="left-side sidebar-offcanvas">

            <section class="sidebar">

                <ul class='sidebar-menu'>

                    <!-- Super Admin Menu listing start here -->


                    <li class="active ">
                        <a href="https://www.profeud.com/admin/dashboard">
                            <i class="fa fa-home  "></i>Dashboard</a>
                    </li>


                    <li class="treeview offer-reports">
                        <a href="javascript::void(0)"><i class="fa fa-users "></i><i class="fa pull-right fa-angle-left"></i>Users </a>

                        <ul class="treeview-menu closed"
                            style="treeview-menu display:none;">
                            <li>
                                <a href="https://www.profeud.com/admin/users/3"><i class='fa fa-angle-double-right'></i>App Users </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/bot-users"><i class='fa fa-angle-double-right'></i>Bot Users </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/users/2"><i class='fa fa-angle-double-right'></i>Sub Admin </a>
                            </li>

                        </ul>

                    </li>

                    <li class="treeview offer-reports">
                        <a href="javascript::void(0)"><i class="fa fa-users "></i><i class="fa pull-right fa-angle-left"></i>Football Contest </a>

                        <ul class="treeview-menu closed"
                            style="treeview-menu display:none;">
                            <li>
                                <a href="{{URL::to('admin/football/contest')}}"><i class='fa fa-angle-double-right'></i>All Contest </a>
                            </li>

                            <li>
                                <a href="{{URL::to('admin/football/all_matchs')}}"><i class='fa fa-angle-double-right'></i>All Matchs </a>
                            </li>


                            <li>
                                <a href="https://www.profeud.com/admin/contests/cric_create"><i class='fa fa-angle-double-right'></i>Create Cricket Contest </a>
                            </li>

                        </ul>

                    </li>

                    <li class="treeview offer-reports">
                        <a href="javascript::void(0)"><i class="fa fa-users "></i><i class="fa pull-right fa-angle-left"></i>Cricket Contest</a>

                        <ul class="treeview-menu closed"
                            style="treeview-menu display:none;">
                            <li>
                                <a href="{{URL::to('admin/cricket/contest')}}"><i class='fa fa-angle-double-right'></i>All Contest</a>
                            </li>

                            <li>
                                <a href="{{URL::to('admin/cricket/all_matchs')}}"><i class='fa fa-angle-double-right'></i>All Matchs </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/contests/cric_create"><i class='fa fa-angle-double-right'></i>Create Cricket Contest </a>
                            </li>

                        </ul>

                    </li>

                    {{-- <li class="">
                        <a href="https://www.profeud.com/admin/promocode-manager"> <i class="fa fa-tag "></i> Promocodes</a>
                    </li> --}}

                    {{-- <li class="">
                        <a href="https://www.profeud.com/admin/withdraw-amount"><i class="fa fa-money "></i>Withdraw Request</a>
                    </li> --}}

                    {{-- <li class="">
                        <a href="https://www.profeud.com/admin/tournaments"><i class="fa fa-calendar "></i>Tournaments</a>
                    </li> --}}

                    {{-- <li class="">
                        <a href="https://www.profeud.com/admin/series"><i class="fa fa-trophy "></i>Series</a>
                    </li> --}}

                    <li class="treeview offer-reports">
                        <a href="javascript::void(0)"><i class="fa fa-handshake-o  "></i><i class="fa pull-right fa-angle-left"></i>Contests </a>

                        <ul class="treeview-menu closed"
                            style="treeview-menu display:none;">

                            <li>
                                <a href="https://www.profeud.com/admin/contests"><i class='fa fa-angle-double-right'></i>All Contests </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/user_contests"><i class='fa fa-angle-double-right'></i>Front User Contests </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/contest_category"><i class='fa fa-angle-double-right'></i>Contest Category </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/contest_template"><i class='fa fa-angle-double-right'></i>Contest Template </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/cricket_contest"><i class='fa fa-angle-double-right'></i>Cricket Contest </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/contests/cric_create"><i class='fa fa-angle-double-right'></i>Create Cricket Contest </a>
                            </li>
                        </ul>

                    </li>

                    <li class="">
                        <a href="https://www.profeud.com/admin/matches"><i class="fa fa-money "></i>Matches</a>
                    </li>

                    <li class="">
                        <a href="https://www.profeud.com/admin/cricket_matches"><i class="fa fa-money "></i>Cricket Matches</a>
                    </li>

                    <li class="">
                        <a href="https://www.profeud.com/admin/players"><i class="fa fa-user-o "></i>Players</a>
                    </li>

                    <li class="">
                        <a href="https://www.profeud.com/admin/cricket_players"><i class="fa fa-user-o "></i>Cricket Players</a>
                    </li>

                    <li class="">
                        <a href="https://www.profeud.com/admin/add_new_player"><i class="fa fa-user-o "></i>Add new Cricket Player</a>
                    </li>

                    <li class="treeview offer-reports">

                        <a href="javascript::void(0)"><i class="fa fa-desktop  "></i><i class="fa pull-right fa-angle-left"></i>System Management </a>

                        <ul class="treeview-menu closed"
                            style="treeview-menu display:none;">
                            <li>
                                <a href="https://www.profeud.com/admin/cms-manager"><i class='fa fa-angle-double-right'></i>Manage CMS </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/email-manager"><i class='fa fa-angle-double-right'></i>Manage Email Templete </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/email-logs"><i class='fa fa-angle-double-right'></i>Manage Email Logs </a>
                            </li>
                        </ul>

                    </li>

                    <li class="treeview offer-reports offer-reports">

                        <a href="javascript::void(0)"><i class="fa fa-cogs "></i><i class="fa pull-right fa-angle-left"></i>Manage Settings </a>

                        <ul class="treeview-menu closed"  style="treeview-menu display:none;">
                            <li>
                                <a href="https://www.profeud.com/admin/settings/prefix/Site"><i class='fa fa-angle-double-right'></i>Manage Site Settings </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/settings/prefix/Reading"><i class='fa fa-angle-double-right'></i>Manage Reading Settings </a>
                            </li>

                            <li>
                                <a href="https://www.profeud.com/admin/settings/prefix/Social"><i class='fa fa-angle-double-right'></i>Manage Social Setting </a>
                            </li>
                        </ul>

                    </li>

                </ul>



            </section>


        </aside>

        <!-- Main Container Start -->

        <aside class="right-side">

            @yield('content')

        </aside>

    </div>



</body>

</html>

<script src="{{ asset('js/admin/bootbox.js') }}"></script>

<script src="{{ asset('js/admin/core/mws.js') }}"></script>

<script src="{{ asset('js/admin/core/themer.js') }}"></script>

<script src="{{ asset('js/admin/app.js') }}"></script>

<script src="{{ asset('css/admin/fancybox/jquery.fancybox.js') }}"></script>

<link href="{{ asset('css/admin/fancybox/jquery.fancybox.css') }}"
      rel="stylesheet">

<link href="{{ asset('css/admin/bootmodel.css') }}"
      rel="stylesheet">

<script type="text/javascript">
    $(".chosen_select").chosen();

    function show_message(message, message_type) {

        $().toastmessage('showToast', {

            text: message,

            sticky: false,

            hideAfter: 500000,



            position: 'top-right',

            type: message_type,

        });

    }



    $(function() {





        $('.items-inner').equalHeights();

    });

</script>

@stack('scripts')
