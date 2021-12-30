<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            @if(!\Illuminate\Support\Facades\Auth::guest())
                <div class="pull-left image">
                    <img src="{{ asset("dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                    <!-- Status -->
{{--                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
                </div>
            @else
                <div class="pull-left image">
                    <img src="{{ asset("dist/img/guest.jpg") }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{__('layout.guest')}}</p>
                </div>
            @endif
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route("books.index") }}"><i class="fa fa-inbox"></i> <span>{{__('layout.borrow_book')}}</span></a></li>
            <li><a href="{{ route("orders.index") }}"><i class="fa fa-recycle"></i> <span>{{__('layout.return_book')}}</span></a></li>
            @if(!\Illuminate\Support\Facades\Auth::guest() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <li><a href="{{ route("orders.all") }}"><i class="fa fa-list"></i> <span>{{__("layout.borrowing_logs")}}</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-tag"></i> <span>{{__('layout.manage_categories')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route("categories.create") }}">{{__("layout.add_new_category")}}</a></li>
                        <li><a href="{{ route("categories.index") }}">{{__("layout.category_list")}}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-book"></i> <span>{{__('layout.manage_books')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route("books.create") }}">{{__("layout.add_new_book")}}</a></li>
                        <li><a href="{{ route("books.index") }}">{{__("layout.book_list")}}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i> <span>{{__('layout.manage_users')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route("users.create") }}">{{__('layout.add_new_user')}}</a></li>
                        <li><a href="{{ route("users.index") }}">{{__('layout.user_list')}}</a></li>
                    </ul>
                </li>
                <li><a href="/log-viewer"><i class="fa fa-list"></i> <span>{{__('layout.system_log')}}</span></a></li>
            @endif

        </ul>

        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
