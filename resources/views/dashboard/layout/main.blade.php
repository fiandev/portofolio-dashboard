<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_DESCRIPTION', '') }}">
    <meta name="author" content="{{ env('APP_AUTHOR', '') }}">
    <meta name="generator" content="{{ env('APP_CODE_GENERATOR', '') }}">
    <title>Dashboard | {{ auth()->user()->name ?? "" }}</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" type="text/css" media="all" />
    <!-- extends root css -->
    <link rel="stylesheet" href="{{ url('/css/style.css') }}" title="main-css" />
    <!-- Custom styles for dashboard -->
    <link href="{{ url('/css/dashboard.css') }}" rel="stylesheet">
    @yield("head")
  </head>
  <body>
  @include("dashboard.partials.nav")
  <div class="preload">
    <div class="loader"></div>
  </div>
  <div class="container-fluid">
    <div class="row">
      @include("dashboard.partials.sidenav")
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @yield("container")
      </main>
    </div>
  </div>
   <!-- framework -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
   <script type="text/javascript" charset="utf-8">
      $(document).ready(function(){      
       $(".preload").remove()
       $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').remove();
       $('.disclaimer').remove();
      }); 
    </script>
   <!-- script for dashboard page -->
   <script src="/js/dashboard.js"></script>
   <script type="text/javascript" charset="utf-8">
     function myConfirm(title, text) {
        swal({
          content: true,
          title: title,
          text: text,
          icon: "warning",
          buttons: [
            'No',
            'Yes'
          ]
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: "ok!",
              text: "don't regret it!",
              icon: "success"
            }).then(function() {
              return true
            });
          } else {
            swal({
              title: "Cancelled",
              text: "this page will be refresh!",
              icon: "success"
            }).then(function(){
              window.location.reload()
            });
          }
        })
      }
   </script>
   <script src='//cdn.jsdelivr.net/npm/eruda'></script>
  <script>eruda.init();</script>
   <!-- custom script -->
   @yield("script")
  </body>
</html>