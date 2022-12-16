<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Login</title>


    

    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/signin.css">
<link rel="shortcut icon" href="/img/logo.png">

    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">

    
<main class="form-signin w-100 m-auto rounded bg-body bg-white shadow">
  @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
     @endif
  <form class="" action="/login" method="post">
    {{-- csrf = untuk mengamankan form --}}
    @csrf
    <img class="mb-4 mt-2" src="/img/logo.png" alt="" width="" height="60">
    
    {{-- <h1 class="h4 mb-3 fw-normal">Hi, Welcome!</h1> --}}

    <div class="form-floating">
      <input type="email" class="form-control @error ('email') is-invalid @enderror" id="email" placeholder="email" name="email" autofocus required value="{{ old('email') }}">
      <label for="email">Email address</label>
      @error('email')
        <div class="invalid-feedback">
                    {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control @error ('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
      <label for="password">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    <p class="mt-2 mb-1 text-muted">&copy; 2022 SIE Bali Based Garment</p>
  </form>
</main>


    
  </body>
</html>
