@extends('layouts.app')

@section('content')
<body class="antialiased">
  <div class="container">
    <!-- main app container -->
    <div class="readersack">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h3>REGISTRACIJA</h3>

            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <form method="post" id="handleAjax" action="{{url('do-register')}}" name="postform">
              <div class="form-group">
                <label>Ime</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" />
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" />
                @csrf
              </div>
              <div class="form-group">
                <label>Lozinka</label>
                <input type="password" name="password" class="form-control" />
              </div>
              <div class="form-group">
                <label>Potvrda Lozinke</label>
                <input type="password" name="confirm_password" class="form-control" />
              </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">REGISTRACIJA</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

@endsection