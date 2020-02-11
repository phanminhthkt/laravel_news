<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="{{asset('public/back-end/')}}/images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="{{asset('public/back-end/')}}/images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    @permission(['Permission Update','All'])
                    <li>
                        <a href="{{route('PermissionList')}}"> <i class="menu-icon fa fa-laptopmenu-icon fa fa-laptop"></i>Permission </a>
                    </li>
                    @endpermission
                    @permission(['Permission Update','All'])
                    <li>    
                        <a href="{{route('RoleList')}}"> <i class="menu-icon fa fa-laptopmenu-icon fa fa-laptop"></i>Roles </a>
                    </li>
                    @endpermission
                    @permission(['Permission Update','All'])
                    <li>    
                        <a href="{{route('AuthorList')}}"> <i class="menu-icon fa fa-laptopmenu-icon fa fa-laptop"></i>Author </a>
                    </li>
                    @endpermission  

                    @permission(['Category List','All'])
                    <li>    
                        <a href="{{route('CategoryList')}}"> <i class="menu-icon fa fa-laptopmenu-icon fa fa-laptop"></i>Category </a>
                    </li>
                    @endpermission

                    @permission(['Post List','All'])
                    <li>    
                        <a href="{{route('PostList')}}"> <i class="menu-icon fa fa-laptopmenu-icon fa fa-laptop"></i>Posts </a>
                    </li>
                    @endpermission 

                    
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>