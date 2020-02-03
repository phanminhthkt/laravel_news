<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    @include('back-end.layout.top')

</head>
<body>


        <!-- Left Panel -->

    <!-- /#left-panel -->
    @include('back-end.layout.navigation')
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
         @include('back-end.layout.header')
        <!-- /header -->
        <!-- Header-->
        @yield('content')
         <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
     @include('back-end.layout.bot')
    

</body>
</html>
