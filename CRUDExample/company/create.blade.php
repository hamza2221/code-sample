@extends('admin/layout/admin')

@section('title', "Companies")

@section('breadcrumbs')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item">Company</li>
<li class="breadcrumb-item active">Create</li>
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
                <h2><b>Registration Form</b></h2>
            </center>
        </legend><br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="well form-horizontal" action="{{ route('admin.company.store')}}" method="post">
                            @csrf
                            <!-- <div class="form-group"> -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">First Name</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="person_name" placeholder="First Name" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Company Name</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="name" placeholder="Company Name" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-1">
                                        <div class="form-group">
                                            <label for="name">Company Name</label>
                                            <input name="name" type="text" class="form-control" id="name">
                                        </div> -->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="address1" placeholder="address1" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="address2" placeholder="address2" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="address3" placeholder="address3" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            
                                {{-- <div class="col-4">
                                        <div class="form-group">
                                            <label for="address1">Address1</label>
                                            <input name="address1" type="text" class="form-control" id="address1">
                                        </div>
                                    </div> -->

                            <div class="col-4">
                                        <div class="form-group">
                                            <label for="address2">Address2</label>
                                            <input name="address2" type="text" class="form-control" id="address2">
                                        </div>
                                    </div> -->

                            <div class="col-4">
                                        <div class="form-group">
                                            <label for="address3">Address3</label>
                                            <input name="address3" type="text" class="form-control" id="address3">
                                        </div>
                                    </div> -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">NTN Number</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="n_t_n_number" placeholder="13 Digit code" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                            </div> --}}
                            <!-- <div class="col-1">
                                        <div class="form-group">
                                            <label for="n_t_n_number">NTN Number</label>
                                            <input name="n_t_n_number" type="text" class="form-control"
                                                id="n_t_n_number">
                                        </div>
                                    </div> -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">NTN Number</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="n_t_n_number number" placeholder="15 Digit code"
                                            class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">GST Number</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="g_s_t_number number" placeholder="15 Digit code"
                                            class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- 
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label for="g_s_t_number">GST Number</label>
                                            <input name="g_s_t_number" type="text" class="form-control"
                                                id="g_s_t_number">
                                        </div>
                                    </div> -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Remarks</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="Remarks" placeholder="Anything......" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-1">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea name="remarks" type="text" class="form-control"
                                                id="remarks"></textarea>
                                        </div>
                                    </div> -->

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Product</label>
                                    <div class="col-md-4 inputGroupContainer">
                                        <div class="input-group">

                                            <select name="product_id" class="form-control">
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Purchase</label>
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="purchase_amount" placeholder="0.00" class="form-control"
                                                    type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="purchase_amount">Purchase Amount</label>
                                            <input name="purchase_amount" type="number" class="form-control"
                                                id="purchase_amount">
                                        </div>
                                    </div>
 -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="landline_number">Landline Number</label>
                                            <input name="landline_number" type="text" class="form-control"
                                                id="landline_number">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="srs_code">SRS Code</label>
                                            <input name="srs_code" type="text" class="form-control" id="srs_code">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Subscription Type</label>
                                            <select name="subscription_type" class="form-control">
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Courier</label>
                                            <select name="courier" class="form-control">
                                                <option value="ums">UMS</option>
                                                <option value="byhand">By Hand</option>
                                                <option value="email">Email</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="suspended">Suspended</option>
                                                <option value="demo">Demo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Postal name</label>
                                        <div class="col-md-4 inputGroupContainer">
                                        <input name="postal_name" type="text" class="form-control" id="postal_name">
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Postal Address</label>
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="postal_address1" placeholder="address1"
                                                    class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="postal_address2" placeholder="address2"
                                                    class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="postal_address3" placeholder="address3"
                                                    class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="col-4">
                                        <div class="form-group">
                                            <label for="postal_name">Postal Name</label>
                                            <input name="postal_name" type="text" class="form-control" id="postal_name">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="postal_address1">Postal Address1</label>
                                            <input name="postal_address1" type="text" class="form-control"
                                                id="postal_address1">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="postal_address2">Postal Address2</label>
                                            <input name="postal_address2" type="text" class="form-control"
                                                id="postal_address2">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="postal_address3">Postal Address3</label>
                                            <input name="postal_address3" type="text" class="form-control"
                                                id="postal_address3">
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Nick Name</label>
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="nick_name" placeholder="Nick Name" class="form-control"
                                                    type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-4">
                                        <div class="form-group">
                                            <label for="nick_name">Nick Name</label>
                                            <input name="nick_name" type="text" class="form-control" id="nick_name">
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Nick Address</label>
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="nick_address1" placeholder="address1" class="form-control"
                                                    type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="nick_address2" placeholder="address2" class="form-control"
                                                    type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                                <input name="nick_address3" placeholder="address3" class="form-control"
                                                    type="text">
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="col-4">
                                        <div class="form-group">
                                            <label for="nick_address1">Nick Address1</label>
                                            <input name="nick_address1" type="text" class="form-control"
                                                id="nick_address1">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="nick_address2">Nick Address2</label>
                                            <input name="nick_address2" type="text" class="form-control"
                                                id="nick_address2">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="nick_address3">Nick Address3</label>
                                            <input name="nick_address3" type="text" class="form-control"
                                                id="nick_address3">
                                        </div>
                                    </div> -->

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select name="country_id" class="form-control">
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
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