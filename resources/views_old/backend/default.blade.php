@extends('backend.home')
@section('title','Dashboard')
@section('content')

<div class="ms-content-wrapper">
    <div class="row">

      <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="material-icons">home</i> Dashboard</a></li>
          </ol>
        </nav>

        <div class="ms-panel">
          <div class="ms-panel-body">
              <h4 class="display-4" style="font-size: 25px;">Welcome To JSSSL Dashboard...</h4>
          </div>
        </div>

      </div>

    </div>
  </div>

@endsection
