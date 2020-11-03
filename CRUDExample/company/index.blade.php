@extends('admin/layout/admin')

@section('title', "Companies")

@section('breadcrumbs')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Company</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Companies</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('admin.company.create')}}" class="btn btn-primary">Add</a>
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">Person Name</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Address</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($companies as $company)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$company->person_name}}</td>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->address1}} {{$company->address2}} {{$company->address3}}</td>
                                        <td>
                                            <a href="{{ route('admin.company.edit', [$company->id])}}" class="btn btn-default">Edit</a>
                                            <a href="{{ route('admin.company.show', [$company->id])}}" class="btn btn-primary">View</a>
                                            <a href="{{ route('admin.person.index', ['company_id' => $company->id])}}" class="btn btn-primary">People</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Person Name</th>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Address</th>
                                        <th rowspan="1" colspan="1">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $companies->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


    </div>
    <!-- /.col -->
</div>
@endsection