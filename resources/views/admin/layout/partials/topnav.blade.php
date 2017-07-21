<!--Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            {{-- TODO:Insert Logo --}}
            <a class="navbar-brand" href="{{url('admin')}}">
                {{config('whyte.project.name')}} Admin</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!--call search-->
                    {{-- @include('admin.layout.partials.call_search') --}}
                    <!--notification-->
                    {{-- @include('admin.layout.partials.notification') --}}
                    <!--tasks-->
                    {{-- @include('admin.layout.partials.tasks') --}}
                    <li> <a href="{{url('/')}}"  target="_blank"><i class="material-icons" title="Go to website">open_in_new</i></a></li>

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu">
                            {{--               <li>
                                <a href="{{url('/')}}"  target="_blank"><i class="material-icons">open_in_new</i>Go to Website</a>
                            </li> --}}
                            <li >
                                <a href="{{url('admin/my-account')}}"><i class="material-icons">vpn_key</i>My Account</a>
                            </li>

                            <li><a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class=" waves-effect waves-block"><i class="material-icons">input</i>Sign Out</a></li>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                        </ul>
                    </li>
                    {{-- Call right sidebar --}}
                    {{-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> --}}
                </ul>
            </div>
        </div>
    </nav>
<!-- #Top Bar-->
