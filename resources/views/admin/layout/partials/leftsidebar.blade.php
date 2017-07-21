    <!--Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info" style="background:#111111;">
                <div class="text-center" style="margin-top:30px">
                    <img src="{{url(config('whyte.project.logo'))}}" alt="User" />
                </div>
              
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    @include('admin.layout.partials.sidemenu')
                </ul>
            </div>

            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    <a target="_blank" href="{{ url(config('whyte.admin.copyright_link'))}}">{{config('whyte.admin.copyright')}}</a>
                </div>
                {{-- <div class="version">
                    <b>Version: </b> 1.0.3
                </div> --}}
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar-->
