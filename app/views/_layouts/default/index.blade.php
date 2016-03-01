<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="<?= csrf_token() ?>">
  <meta name="description" content="Laravel Quiz is a student platform where the students can test
  their knowledge in different subjects">
  <meta name="keywords" content="Laravel,Quiz,dimitar032,Open Source Platform">
  <link rel="author" href="http://github.com/dimitar032">
  <title>Laravel Quiz -
    @section('title')
    @show
  </title>
   <link href="{{cdn('css/main/style.css')}}" rel="stylesheet" type="text/css">
   <script src="{{cdn('js/jquery/jquery.js')}}"></script>
   <script src="{{cdn('js/jquery.tablesorter.min.js')}}"></script>
   @section('specific-page-addons')@show
</head>
    <body>
      <div id="main-container">
        @include('_layouts.default.partials.top_nav')

        @yield('content')

      </div> <!-- end container -->
    </body>
</html>
