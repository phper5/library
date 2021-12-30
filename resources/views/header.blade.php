<header class="main-header">

    <!-- Logo -->
    <a href="{{ route("home") }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{{__("layout.lib")}}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{__("layout.library")}}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{__('layout.toggle_navigation')}}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu" style="padding-top: 10px;padding-bottom: 15px;">


                            <select class="form-control" name="locale" id="lang_switch" >
                                <option {{ app()->getLocale()=='en' ?'selected="selected':'' }} value="en">{{__('layout.english')}}</option>
                                <option {{ app()->getLocale()=='cn' ?'selected="selected':'' }} value="cn">{{__('layout.chinese')}}</option>
                                <option {{ app()->getLocale()=='sv' ?'selected="selected':'' }} value="sv">{{__('layout.swedish')}}</option>
                            </select>



                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    @if(!\Illuminate\Support\Facades\Auth::guest())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset("dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                        </a>
                    @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{__("layout.guest")}}</span>
                        </a>
                    @endif


                    <ul class="dropdown-menu">
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <li class="user-footer">
                                <div class="col-xs-6 text-center">
                                    <a href="{{ route("register") }}" class="btn btn-default btn-flat">{{__('layout.register')}}</a>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <a href="{{ route("login") }}" class="btn btn-default btn-flat">{{__('layout.log_in')}}</a>
                                </div>
                            </li>
                        @else
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">{{__('layout.profile')}}</a>
                                </div>
                                <div class="pull-right">
                                    <form action="{{ route('logout') }}" method="Post">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-default btn-flat">{{__('layout.sign_out')}}</button>
                                    </form>

                                </div>
                            </li>
                        @endif
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
{{--                <li>--}}
{{--                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </nav>
</header>
