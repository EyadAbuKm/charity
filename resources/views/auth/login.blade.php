<!DOCTYPE html>

<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>الجمعية الإسلامية الخيرية في داريا</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
  
  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />

  


  <!-- FAVICON -->
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />

  <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
</head>

</head>
  <body class="bg-light-gray" id="body">
          <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
          <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
              <div class="col-lg-6 col-md-10">
                <div class="card card-default mb-0">
                  <div class="card-header pb-0">
                    <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                      <a class="w-auto pl-0">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                        <span class="brand-name text-dark"></span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body px-5 pb-5 pt-0">

                    <h4 class="text-dark mb-6 text-center">Login</h4>

                    <form action="{{route('login')}}" method="POST">
					  @csrf
                      <div class="row">
                        <div class="form-group col-md-12 mb-4">
                          <input type="text" class="form-control input-lg" id="text" aria-describedby="emailHelp"
                            placeholder="text" name="user">
                        </div>
                        <div class="form-group col-md-12 ">
                          <input type="password" class="form-control input-lg" id="password" placeholder="Password" name="password">
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary btn-pill mb-4">Sign In</button>
                        </div>
                      </div>
                    </form>
					@if (session('error'))
						<div>{{ session('error') }}</div>
					@endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

</body>
</html>
