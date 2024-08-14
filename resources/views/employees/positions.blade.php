
@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Positions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Department</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_position"><i class="fa fa-plus"></i> Add Position</a>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th>Department Name</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $key=>$items )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td class="position">{{ $items->position }}</td>
                                    <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item edit_position" href="#" data-toggle="modal" data-target="#edit_position{{ $items->id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item delete_position" href="#" data-toggle="modal" data-target="#delete_position{{ $items->id }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Position Modal -->
        <div id="add_position" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Position</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('position.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Position Name <span class="text-danger">*</span></label>
                                <input class="form-control @error('department') is-invalid @enderror" type="text" id="position" name="position">
                                @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Department Modal -->

        <!-- Edit Department Modal -->
        @foreach ($positions as $key=>$items )
        <div id="edit_position{{ $items->id }}" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('position.update', $items->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" id="e_id{{ $items->id }}" value="{{ $items->id }}">
                            <div class="form-group">
                                <label>Department Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position_edit{{ $items->id }}" name="position_name" value="{{ $items->position }}">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- /Edit Department Modal -->

        <!-- Delete Department Modal -->
        @foreach ($positions as $key=>$items )
        <div class="modal custom-modal fade" id="delete_position{{ $items->id }}" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Department</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('position.destroy', $items->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" value="{{ $items->id}}" hidden>
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- /Delete Department Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
    {{-- update js --}}
    <script>
        $(document).on('click','.edit_position',function()
        {
            var _this = $(this).parents('tr');
            var id = _this.find('.id').text();
            $('#e_id'+id).val(id);
            $('#position_edit'+id).val(_this.find('.position').text());
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_position',function()
        {
            var _this = $(this).parents('tr');
            var id = _this.find('.id').text();
            $('.e_id'+id).val(id);
        });
    </script>
    @endsection
@endsection

