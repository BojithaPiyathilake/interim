<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dark Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <style>
    .inline{
        display: inline;
      }
  </style>
</head>

<body class="bg-secondary">

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand mr-auto" href="#">
            <img src="Logo.jpeg" alt="logo" style="width:70px;">
        </a>

        <a href="#" class="text-secondary mr-1">Help          |</a>

        <a href="#" class="text-secondary">
            <i class="fas fa-bell mr-1"> <span class="badge badge-light">4</span>        |</i>
        </a>

        <a href="#" class="text-secondary">
            <i class="fas fa-cog mr-1">          |</i>
        </a>


        <ul class="navbar-nav">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
        </ul>
    </nav>



<br>

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-2">      <!--if screen size goes below large then start stacking-->
        <div class="p-2 border bg-dark border-dark rounded-lg flex-shrink-3">
            <h4 class="p-2 border border-light rounded-lg text-white">Navigation Bar</h5>
            <!-- A vertical navbar -->
            <nav class="navbar bg-dark">
            <!-- Links -->
            <ul class="navbar-nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link text-light font-italic p-2" href="/general">General Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light font-italic p-2" href="#">User Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light font-italic p-2" href="#">Environment Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light font-italic p-2" href="/admin/admin">Admin Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light font-italic p-2" href="#">Security Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light font-italic p-2" href="#">Update Map</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light font-italic p-2" href="#">Requests</a>
            </li>
            </ul>
            </nav>
        </div>
    </div>


    <div style="background-color:#ECF0F1" class="col-md p-2 border border-secondary rounded-lg ml-2 mr-3">
      <!-- @yield('cont') -->
      <div class="row justify-content-between">
        <div class="col-md-12">
            <h6>Crime information</h6>
            <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>crime type</th>
                    <th>description</th>
                    <th>Location</th>
                    <th>Date complained logged</th>
                    <th>Action taken</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                 <tr>
                    <td>{{$crime->id}}</td>
                    <td>{{$crime->crime_type}}</td>
                    <td>{{$crime->description}}</td>
                    <td>{{$crime->polygon}}</td>
                    <td>{{$crime->created_at}}</td>
                    <td>{{$crime->action_taken}}</td>
                    <td>{{$crime->status}}</td>
                    <!-- <td><a href='/edit/{{ $crime->id }}' class="btn btn-outline-warning" role="button" >Edit</a></td>
                    <td><a href="#" class="btn btn-outline-danger" role="button">Disable</a></td> -->
                </tr>
            </tbody>
        </table>
        </div>
      </div>
      </br>
      </br>
      <div class="row justify-content-between">
        <div class="col-md-3">
            <form action="\searchauth" method="get">
            @csrf
                <h6>Select Organization</h6>
                <div class="input-group mb-3">
                    <select name="organization1" class="custom-select">
                        <option value="0">Select</option>
                        <option value="1">Forest Department</option>
                        <option value="2">Wildlife authorities</option>
                    </select>
                    @error('organization1')
                        <div class="alert">                                   
                            <strong>{{ "This field is mandatory" }}</strong>
                        </div>
                    @enderror
                </div>
                <h6>Select role</h6>
                <div class="input-group mb-3">
                    <select name="role" class="custom-select">
                        <option value="0">Select</option>
                        <option value="1">Head of Organization</option>
                        <option value="2">Manager</option>
                        <option value="3">Staff</option>
                    </select>
                    @error('role')
                        <div class="alert">                                   
                            <strong>{{ "This field is mandatory" }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-submit">
                    <input type="hidden" class="form-control" name="crimeid" value="{{$crime->id}}">
                    <button type="submit" class="btn btn-primary" >Search authorities</button>
                </div>
            </form>
        </div>
        <div class="col-md-8">
        <h6>Authority information</h6>
            <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
            @foreach($Users as $user)<tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
      </div>
      </br>
      <hr>
      </br>
      <h6>Assign Authorities</h6>
      </br>
      <div class="row justify-content-between">
        <div class="col-md-12">
            <form action="\assignauth" method="post">
            @csrf
                <h6>Crime report</h6>
                <div class="input-group mb-8">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Id</span>
                    </div>
                    <input type="text" class="form-control" name="crimeid" value="{{$crime->id}}">
                    @error('crimeid')
                        <div class="alert">                                   
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                </div>
                <br>
                <h6>Authority Details</h6>
                <br>
                <h6>Select Organization</h6>
                <div class="input-group mb-3">
                    <select name="organization" class="custom-select">
                        <option value="0">Select</option>
                        <option value="1">Forest Department</option>
                        <option value="2">Wildlife authorities</option>
                    </select>
                    @error('organization')
                        <div class="alert">                                   
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Authority Id</span>
                    </div>
                    <input type="text" class="form-control" name="authority_id">
                    @error('authority_id')
                        <div class="alert">                                   
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br>
                <h6>Additional details</h6>
                <br>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Comments</span>
                    </div>
                    <input type="text" class="form-control" name="comment">
                    @error('comment')
                        <div class="alert">                                   
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary" >Assign authorities</button>
                </div>
            </form>
        </div>
    </div>
      <!-- <end of content> -->
    </div>
</div>
</div>
<br>
<div class="d-flex  bg-light justify-content-end">
  <a href="#" class="text-secondary mr-2">
    <i class="fab fa-facebook-square"></i> Facebook |
  </a>
  <a href="#" class="text-secondary mr-2">
    <i class="fab fa-twitter-square"></i> Twitter |
  </a>
  <a href="#" class="text-secondary mr-2">
    <i class="fab fa-instagram"></i>  Instagram
  </a>
</div>
<div class="d-flex bg-light justify-content-center">
  <h5 class="text-secondary"><i class="far fa-copyright"></i> 2020 by Reforest Sri Lanka</h5><br>
</div>
<div class="d-flex bg-light justify-content-center">
  <h6>All rights reserved</h6>
</div>

</body>
</html>