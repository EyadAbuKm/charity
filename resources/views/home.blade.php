@extends('layouts.app')
@section('title', 'الرئيسية')

@section('content')
<div class="row">
    <div class="col-xl-12">
      
      <!-- Income and Express -->
      <div class="card card-default">
        <div class="card-header">
          <h2>التبرعات والمساعدات المالية</h2>
          <div class="dropdown">
            <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" data-display="static">
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>

        </div>
        <div class="card-body">
          <div class="chart-wrapper">
            <div id="mixed-chart-1"></div>
          </div>
        </div>

      </div>


    </div>
 
  </div>


@endsection
