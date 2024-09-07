@extends('layouts.master')
@section('content')
    @section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
    <!-- checkbox style -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/checkbox-style.css') }}">
    @endsection
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                        <div class="view-icons">
                            <a href="{{ route('all/employee/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="{{ route('all/employee/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->


            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th class="text-nowrap">Join Date</th>
                                    <th>Department</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $emp )
                                <tr>
                                    @php
                                     $currentDate = \Carbon\Carbon::now();
                                     $separationDate = $emp->separation_date ? \Carbon\Carbon::parse($emp->separation_date) :    null;
                                    @endphp
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ url('employee/details/edit/'.$emp->id) }}" class="avatar"> <img alt="" src="{{ URL::to('/assets/img/employee_avatar.png') }}"></a>

                                            <a href="{{ url('employee/details/edit/'.$emp->id) }}">{{    $emp->first_name }} {{ $emp->last_name }}
                                                @if ($separationDate && $separationDate->lessThanOrEqualTo($currentDate))
                                                  <span class="text-primary">Resigned</span>
                                                @else
                                                <span>{{ $emp->position }}</span>
                                                @endif
                                            </a>

                                        </h2>
                                    </td>
                                    <td>{{ $emp->employee_id }}</td>
                                    <td>{{ $emp->email }}</td>
                                    <td>{{ $emp->phone_number }}</td>
                                    <td>{{ $emp->created_at }}</td>
                                    <td>{{ $emp->department->name }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ url('all/employee/view/edit/'.$emp->employee_id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="{{url('all/employee/delete/'.$emp->id)}}"onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

       <!-- Add Employee Modal -->
       <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="employeeForm" action="{{ route('all/employee/save') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">First name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="First name" />
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Middle name</label>
                                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" placeholder="Optional" />
                                    @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Last name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Last name" />
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker @error('birth_date') is-invalid @enderror" type="text" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                                        @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="select form-control @error('gender') is-invalid @enderror" style="width: 100%;" id="gender" name="gender">
                                        <option value="">-- Select --</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Current Address</label>
                                    <input class="form-control @error('current_address') is-invalid @enderror" type="text" id="address" name="current_address" placeholder="Current Address" value="{{ old('current_address') }}">
                                    @error('current_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Position</label>
                                    <select class="select form-control @error('position') is-invalid @enderror" style="width: 100%;" id="position" name="position">
                                        <option value="">-- Select --</option>
                                        @foreach ($position as $pos)
                                            <option value="{{ $pos->position }}" {{ old('position') == $pos->position ? 'selected' : '' }}>{{ $pos->position }}</option>
                                        @endforeach
                                    </select>
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Department</label>
                                    <select class="select form-control @error('department_id') is-invalid @enderror" style="width: 100%;" id="department" name="department_id">
                                        <option value="">-- Select --</option>
                                        @foreach ($departments as $dep)
                                            <option value="{{ $dep->id }}" {{ old('department_id') == $dep->id ? 'selected' : '' }}>{{ $dep->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                     <label class="col-form-label">Phone Number</label>
                                     <div class="input-group">
                                            <span class="input-group-text">+63</span>
                                            <input class="form-control" type="text" @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="Enter 10 digit phone number Ex. 9123456789">

                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                      </div>
                                 </div>
                            </div>
                        </div>
                        <h3>Emergency Contact</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emergency_name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control @error('emergency_name') is-invalid @enderror" name="emergency_name" id="emergency_name" value="{{ old('emergency_name') }}">
                                    @error('emergency_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emergency_phonenumber" class="col-form-label">Contact No.</label>
                                    <div class="input-group">
                                           <span class="input-group-text">+63</span>
                                           <input class="form-control" type="text" @error('emergency_phonenumber') is-invalid @enderror" name="emergency_phonenumber" id="emergency_phonenumber" value="{{ old('emergency_phonenumber') }}" placeholder="Enter 10 digit phone number Ex. 9123456789">

                                           @error('emergency_phonenumber')
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                       @enderror
                                     </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emergency_relationship" class="col-form-label">Relationship</label>
                                    <input type="text" class="form-control @error('emergency_relationship') is-invalid @enderror" name="emergency_relationship" id="emergency_relationship" value="{{ old('emergency_relationship') }}">
                                    @error('emergency_relationship')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emergency_address" class="col-form-label">Address</label>
                                    <input type="text" class="form-control @error('emergency_address') is-invalid @enderror" name="emergency_address" id="emergency_address" value="{{ old('emergency_address') }}">
                                    @error('emergency_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Add Employee Modal -->

    </div>
    <!-- /Page Wrapper -->
    @section('script')

    <script>
        const phoneNumber = document.getElementById('phone_number');
        const contactNumber = document.getElementById('emergency_phonenumber');

        function slicedText() {
            if(phoneNumber.value > 10) {
                phoneNumber.value = phoneNumber.value.slice(0, 10);
            }
            if(contactNumber.value > 10) {
                contactNumber.value = contactNumber.value.slice(0, 10);
            }
        }
        phoneNumber.addEventListener('input', slicedText);
        contactNumber.addEventListener('input', slicedText);

    </script>

 <script>
    $(document).ready(function() {
        $('#searchBtn').on('click', function() {
            var employee_id = $('#employee_id').val();
            var name = $('#name').val();
            var position = $('#position').val();

            $.ajax({
                url: "{{ route('all/employee/search') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    employee_id: employee_id,
                    name: name,
                    position: position
                },
                success: function(response) {
                    $('#employeeList').html(response.html);
                }
            });
        });
    });
  </script>

    <script>
    $(document).ready(function() {
   /* $('#employeeForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#add_employee').modal('hide');
                    alert('Form submitted successfully!');
                    $('#employeeForm')[0].reset();
                } else if (response.errors) {
                    displayErrors(response.errors);
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        });
    }); */

    function displayErrors(errors) {
        $('.error').remove();
        $.each(errors, function(key, value) {
            var input = $('#employeeForm').find('[name=' + key + ']');
            input.after('<span class="error" style="color:red;">' + value + '</span>');
        });
    }
});
    </script>

    <script>
        $(document).ready(function() {
            $('.select2s-hidden-accessible').select2({
                closeOnSelect: false
            });
        });
    </script>
    @endsection
@endsection
