<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ url("/") }}" class="site_title"><i class="fa fa-paw"></i> <span>Koperasi ITB</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    {{-- <div class="profile clearfix">
        <div class="profile_pic">
            <img src="images/img.jpg" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>John Doe</h2>
        </div>
    </div> --}}
    
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        
        <div class="menu_section">

            <h3>General</h3>

            <ul class="nav side-menu">
                
                <li>
                    <a href="{{ url("/") }}"><i class="fa fa-home"></i> Home</a>
                </li>

                <li>
                    <a href="{{ url("/transactions") }}"><i class="fa fa-credit-card"></i> Transactions</a>
                </li>

                <li>
                    <a href="{{ url("/products") }}"><i class="fa fa-book"></i> Products</a>
                </li>

                <li>
                    <a href="{{ url("/users") }}"><i class="fa fa-user"></i> Users</a>
                </li>

                {{-- <li>
                    <a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="form.html">General Form</a></li>
                        <li><a href="form_advanced.html">Advanced Components</a></li>
                        <li><a href="form_validation.html">Form Validation</a></li>
                    </ul>
                </li> --}}

            </ul>

            <h3>Personal</h3>

            <ul class="nav side-menu">
                
                <li>
                    <a href="{{ url("/users") }}/{{ Auth::user()->id }}/edit"><i class="fa fa-cog"></i> Setting </a>
                </li>

            </ul>

            {{-- <h3>Admin</h3>

            <ul class="nav side-menu">
                
                <li>
                    <a href="{{ url("/roles") }}"><i class="fa fa-cog"></i> Role & Permissions </a>
                </li>

            </ul> --}}

        </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    {{-- <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
    </div> --}}
    <!-- /menu footer buttons -->
</div>