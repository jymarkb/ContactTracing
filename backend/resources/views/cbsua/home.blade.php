@extends('cbsua.layout')

@section('title', '- Home')


@section('content')

<div class="row justify-content-center" id="row-welcome">
    <div class="col-xl-8 text-center">
        <h1 class="heading-welcome">Welcome Student!</h1>
        <p class="info-welcome">Central Bicol State University of Agriculture Contact Tracing App. <br> Register below and help the school to fight the pandemic.</p>
        <a href="/register/eula" class="btn btn-lg btn-secondary btn-welcome p-3">Register Now!</a>
    </div>
</div>

@endsection

