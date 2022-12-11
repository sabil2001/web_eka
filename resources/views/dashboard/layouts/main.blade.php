<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>{{ $tittle }}</title>
      <meta name="robots" content="noindex, nofollow">
      
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
      
      <link rel="shortcut icon" href="/img/logo.png">
      <link href="/assets/img/favicon.png" rel="icon">
      <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
      <link href="/assets/css/bootstrap-icons.css" rel="stylesheet">
      <link href="/assets/css/boxicons.min.css" rel="stylesheet">
      <link href="/assets/css/quill.snow.css" rel="stylesheet">
      <link href="/assets/css/quill.bubble.css" rel="stylesheet">
      <link href="/assets/css/remixicon.css" rel="stylesheet">
      <link href="/assets/css/simple-datatables.css" rel="stylesheet">
      <link href="/assets/css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="/style.css">
      <script src="/assets/js/Chart.js"></script>
      <style>
        .btn{
          border-radius: 8px;
          transition: all 0.5s;
        }
        .btn:hover{
          border-radius: 8px;
          transform: translateY(2px);
          transition: 0.5s;
        }
        .foto-pegawai{
          width: 150px;
          height: 150px;
        }
        /* .img-preview{
          width: 150px;
          height: 150px;
          background-color: black;
        } */
      </style>
      
   </head>
   <body>

    @include('dashboard.layouts.header')

    @include('dashboard.layouts.sidebar')

    <main id="main" class="main">
        @yield('container')
    </main>

    <footer id="footer" class="footer">
      <div class="copyright"> &copy; Copyright 2021 - <strong><span>SIE PRODUKSI BALI BASED GARMENT</span></strong></div>
   </footer>
   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
      <script src="/assets/js/apexcharts.min.js"></script>
      <script src="/assets/js/bootstrap.bundle.min.js"></script>
      <script src="/assets/js/quill.min.js"></script>
      <script src="/assets/js/simple-datatables.js"></script>
      <script src="/assets/js/tinymce.min.js"></script>
      <script src="/assets/js/validate.js"></script>
      <script src="/assets/js/main.js"></script> 
      <script>
      function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
      </script>    

      
      
    </body>
</html>






