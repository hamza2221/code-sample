@extends('admin/layout/admin')

@section('title', "Companies")

@section('breadcrumbs')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item">Company</li>
<li class="breadcrumb-item active">Show</li>
@endsection

@section('content')
<style>
    #success_massage {
        display: none;
    }
</style>
<div class="container">

    <!-- <form action=" " method="post" id="contact_form"> -->
    <fieldset>
        <legend>
            <center>
                <h2><b>{{$company->name}}</b></h2>
            </center>
        </legend><br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Show</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @foreach($company->toArray() as $key => $value)
                            <h4><strong>{{$key}}</strong> {{ $value }}</h4>
                        @endforeach
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>

            <script>
    // $(document).ready(function () {
    //     $('#contact_form').bootstrapValidator({
    //         // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
    //         feedbackIcons: {
    //             valid: 'glyphicon glyphicon-ok',
    //             invalid: 'glyphicon glyphicon-remove',
    //             validating: 'glyphicon glyphicon-refresh'
    //         },
    //         fields: {
    //             person_name: {
    //                 validators: {
    //                     stringLength: {
    //                         min:25

    //                     },
    //                     notEmpty: {
    //                         message: 'Please enter your First Name'
    //                     }
    //                 }
    //             },
    //             name: {
    //                 validators: {
    //                     stringLength: {
    //                         min: 2,
    //                     },
    //                     notEmpty: {
    //                         message: 'Please enter'

            </script>
@endsection