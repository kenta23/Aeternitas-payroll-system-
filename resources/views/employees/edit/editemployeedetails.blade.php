@extends('layouts.master')


@section('style')
   <style>
        .nav-link {
           border: none;
        }
        .navtab-parent {

        }
        .btn-navtabs {
            width: 100%;
        }
   </style>
@endsection

@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employee Edit<span id="year"></span></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee edit</li>
                    </ul>
                </div>
            </div>
        </div>

        {!! Toastr::message() !!}

                 <!-- NAV TABS -->
<ul class="nav nav-pills nav-justified navtab-parent" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active btn-navtabs"  id="personalinfo_tab" data-bs-toggle="tab" data-bs-target="#personalinfo-pane" type="button" role="tab" aria-controls="personalinfo-pane" aria-selected="true">Personal Information</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link btn-navtabs"  id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-pane" type="button" role="tab" aria-controls="contact-pane" aria-selected="false">Contact information</button>
    </li>

</ul>

  <form action="{{ route('employee/details/save') }}" method="POST">
     @csrf
     <div class="tab-content">
        <div class="p-3 border tab-pane fade show active" id="personalinfo-pane" role="tabpanel" aria-labelledby="personalinfo_tab">
                  <div class="row">
                        <input type="text" name="id" hidden value="{{ $employee->id }}">
                        <div class="col-sm-6 form-group">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" id="firstname" name="firstname" value="{{ $employee->first_name }}" class="form-control @error('fullname') is-invalid @enderror">

                                 @error('fullname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                            </div>

                            <div class="form-group">
                                <label>Middle name (optional)</label>
                                <input type="text" id="middlename" name="middlename" value="{{ $employee->middle_name }}" class="form-control @error('fullname') is-invalid @enderror">

                                 @error('fullname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                            </div>

                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" id="lastname" name="lastname" value="{{ $employee->last_name }}" class="form-control @error('fullname') is-invalid @enderror">

                                 @error('lastname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                            </div>

                        </div>


                    <div class="col-sm-6 form-group">
                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="text" id="phone" name="phone" value="{{ $employee->phone_number}}"   class="form-control @error('phone') is-invalid @enderror">

                            @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                             @enderror

                            <label>Email</label>
                            <input type="text" id="email" name="email" value="{{ $employee->email }}" class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Birth Date</label>
                        <input type="date" id="birthdate" name="birthdate" value="{{ $employee->birth_date }}" class="form-control @error('birthdate') is-invalid @enderror">

                        @error('birthdate')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-sm-6 form-group">
                        <label>Current Address</label>
                        <input type="text" id="address" name="address" value="{{ $employee->current_address }}" class="form-control @error('address') is-invalid @enderror">

                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-6 form-group">
                         <label for="">Resignation Date</label>
                         <input type="datetime-local" class="form-control @error('resignation_date') is-invalid @enderror" name="resignation_date" value="{{ $employee->separation_date }}">

                         @error('resignation_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="">Resignation Reason</label>
                        <input type="text" class="form-control @error('resignation_reason') is-invalid @enderror" name="resignation_reason" value="{{ $employee->separation_reason }}">

                        @error('resignation_reason')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                   </div>
                </div>
              </div>



              <div class="p-3 border tab-pane fade " id="contact-pane" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                     <div class="col-sm-6 form-group">
                          <label for="">Emergency Contact Name</label>
                          <input type="text" class="form-control @error('emergency_name') is-invalid @enderror" name="emergency_name"  value="{{ $employee->emergency_name }}">

                          @error('emergency_name')
                             <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="col-sm-6 form-group">
                          <label for="">Emergency Phone number</label>
                          <input type="text" class="form-control @error("emergency_phonenumber") is-invalid @enderror" name="emergency_phonenumber" value="{{ $employee->emergency_phonenumber }}">

                          @error('emergency_phonenumber')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                     </div>

                     <div class="col-sm-6 form-group">
                        <label for="">Relationship</label>
                        <input type="text" class="form-control @error("emergency_relationship") is-invalid @enderror" name="emergency_relationship" value="{{ $employee->emergency_relationship }}">

                        @error('emergency_relationship')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                   </div>

                     <div class="col-sm-6 form-group">
                        <label for="">Emergency Address</label>
                        <input type="text" class="form-control @error("emergency_address") is-invalid @enderror" name="emergency_address" value="{{ $employee->emergency_address }}">

                        @error('emergency_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                   </div>
                </div>
          </div>
        </div>


    <div class="submit-section">
        <button type="submit" class="btn btn-primary submit-btn">Update</button>
      </div>
  </form>
    </div>
 </div>

 @section('script')

 @endsection
@endsection
