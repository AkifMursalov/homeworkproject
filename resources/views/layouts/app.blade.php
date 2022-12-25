<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap cdn --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{-- Add jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    {{-- Add css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- Add js --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <title>@yield('title')</title>
</head>
<body>
    {{-- Create a navigation bar with burger menu and add scripts to activate it --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img style="width:50px" src="{{asset('images/logo.png')}}" alt=""></a>
        <div class="navbar navbar-expand-sm" id="navbarNav">
          <ul class="nav navbar list-inline">
            <li style='float:right;' class="nav-item active">
              <a style="color: rgb(255, 255, 255); font-size: 17px;" class="nav-link" href="{{route('home.show')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li style='float:right;' class="nav-item active">
              <a style="color: rgb(255, 255, 255); font-size: 17px;" class="nav-link" href="/create">Create</a>
            </li>
          </ul>
        </div>
    </nav>
    <div class="container mx-auto">
        @yield('content')
    </div>

</body>
</html>
