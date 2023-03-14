<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>
    Argon Dashboard
  </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

  <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.min9c7f.css?v=2.0.5')}}" rel="stylesheet" />
  <script src="{{asset('assets/js/analytics.js')}}"></script>

</head>

<body>

  <main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-7">
            <div class="card border-0 mb-0">
              <div class="card-header bg-transparent">
                <h5 class="text-dark text-center mt-2 mb-3">{{ $title ?? "" }} Sign in</h5>
              </div>
              <div class="card-body px-lg-5 pt-0">
                <form role="form" class="text-start" method="POST" action="{{isset($url) ? $url : route('login')}}">
                  @csrf
                  <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email">
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password"
                    aria-label="Password" name="password">
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <div class="mb-2 position-relative text-center">
                    <p
                      class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                      or
                    </p>
                  </div>
                  <div class="text-center">
                  <a href="{{route('register')}}">
                    <button type="button" class="btn bg-gradient-dark w-100 mt-2 mb-4">Sign up</button>
                  </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@include('layouts.footer')

  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

  <script src="{{asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/jkanban/jkanban.js')}}"></script>

<script>
    @if ($errors->any())
    toastr.error('{{($errors->first())}}', "", {"iconClass": 'customer-info'});
    @endif
</script>
</body>
</html>
