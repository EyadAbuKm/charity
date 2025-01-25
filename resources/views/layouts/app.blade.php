{{-- مصدر هذه الصفحة من موقع  --}}
{{-- https://demo.themefisher.com/mono-bootstrap/index.html --}}
{{-- من صفحة  --}}
{{-- view-source:https://demo.themefisher.com/mono-bootstrap/index.html --}}
{{-- تمثل المخطط في الصفحة الرئيسة --}}

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>الجمعية الإسلامية الخيرية بداريا - @yield('title', '')</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
   
  <link href="{{ asset('plugins/prism/prism.css') }}" rel="stylesheet" />
 
  <link href="{{ asset('plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <!-- FAVICON -->
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />

  <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
</head>


  <body class="navbar-fixed sidebar-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
      
      
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        @include('layouts.sidebar')

      <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
      <div class="page-wrapper">  
         
        @include('layouts.navbar')
        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
            <div class="content">
                <div class="card card-default">
                    @yield('content')
                </div>
            </div>
        </div>
        
        @include('layouts.footer')

      </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
    <script src="{{ asset('plugins/prism/prism.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/apexcharts/apexcharts.js') }}"></script>                  
    <script src="{{ asset('js/mono.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    
    @yield('customJs')
<?php if(isset($donorData)):?>
    <script>
       var totalAmounts = @json($donorData);
       var totalAmounts2 = @json($cachAidData);
       
      var mixedChart1 = document.querySelector("#mixed-chart-1");
      if (mixedChart1 !== null) {
      var mixedOptions1 = {
          chart: {
          height: 370,
          type: "bar",
          toolbar: {
              show: false,
          },
          },
          colors: ["#9e6de0", "#faafca", "#f2e052"],
          legend: {
          show: true,
          position: "top",
          horizontalAlign: "right",
          markers: {
              width: 20,
              height: 5,
              radius: 0,
          },
          },
          plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: "50%",
              barHeight: "10%",
              distributed: false,
          },
          },
          dataLabels: {
          enabled: false,
          },
  
          stroke: {
          show: true,
          width: 2,
          curve: "smooth",
          },
  
          series: [
          {
              name: "التبرعات",
              type: "column",
              data: totalAmounts,
          },
          {
              name: "المساعدات المالية",
              type: "column",
              data: totalAmounts2,
          },
          
        
          ],
  
          xaxis: {
          categories: [
              "Jan",
              "Feb",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec",
          ],
  
          axisBorder: {
              show: false,
          },
          axisTicks: {
              show: false,
          },
          crosshairs: {
              width: 40,
          },
          },
  
          fill: {
          opacity: 1,
          },
  
          tooltip: {
          shared: true,
          intersect: false,
          followCursor: true,
          fixed: {
              enabled: false,
          },
          x: {
              show: false,
          },
          y: {
              title: {
              formatter: function (seriesName) {
                  return seriesName;
              },
              },
              formatter: function (val) {
              return "ل.س " + val.toLocaleString();;
            },
          },
          },
      };
  
      var randerMixedChart1 = new ApexCharts(mixedChart1, mixedOptions1);
      randerMixedChart1.render();
      }
  
  </script>
  <?php endif?>
  </body>
</html>
