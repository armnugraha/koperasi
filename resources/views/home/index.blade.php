@extends('../layouts.application')

@section('content')

  <div class="right_col" role="main">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
      <h2>ini adalah dashboard koperasi TF</h2>
      <h3>saldo : {{ Auth::user()->saldo }} </h3>
    </div>

  </div>
  <br />

@endsection