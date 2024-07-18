@extends('layouts.settings')
@section('content')

    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Company Settings</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    <form action="{{ route('company/settings/save') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="id" value="1">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Name <span class="text-danger">*</span></label>
                                    @if (!empty($companySettings->company_name))
                                    <input class="form-control" type="text" name="company_name" value="{{ $companySettings->company_name }}">
                                    @else
                                    <input class="form-control" type="text" name="company_name" value="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    @if (!empty($companySettings->contact_person))
                                    <input type="text" class="form-control" name="contact_person" value="{{ $companySettings->contact_person }}">
                                    @else
                                    <input type="text" class="form-control" name="contact_person" value="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    @if (!empty($companySettings->address))
                                    <input type="text" class="form-control" name="address" value="{{ $companySettings->address }}">
                                    @else
                                    <input type="text" class="form-control" name="address" value="">

                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" value="Philippines" id="country" name="country" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    @if (!empty($companySettings->city))
                                        <input type="text" class="form-control" name="city" value="{{ $companySettings->city }}">
                                    @else
                                        <input type="text" class="form-control" name="city">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <select class="form-control select" name="state_province">
                                        @if (!empty($companySettings->state_province))
                                            <option value="Metro Manila" {{ ( $companySettings->state_province == 'Metro Manila') ? 'selected' : '' }}>Metro Manila</option>
                                        @else
                                            <option value="Metro Manila" {{ ( $companySettings->state_province == 'Metro Manila') ? 'selected' : '' }}>Metro Manila</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    @if (!empty($companySettings->postal_code))
                                        <input type="text" class="form-control" name="postal_code" value="{{ $companySettings->postal_code }}">
                                    @else
                                        <input type="text" class="form-control" name="postal_code">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    @if (!empty($companySettings->email))
                                        <input type="email" class="form-control" name="email" value="{{ $companySettings->email }}">
                                    @else
                                        <input type="email" class="form-control" name="email">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @if (!empty($companySettings->mobile_number))
                                       <div class="input-group">
                                         <span class="input-group-text" id="mobile-label">+63</span>
                                         <input type="tel" class="form-control" id="mobile_number" placeholder="Phone number" aria-label="Mobile number" aria-describedby="Mobile number">
                                       </div>
                                    @else
                                      <div class="input-group mb-3">
                                        <span class="input-group-text" id="mobile-label">+63</span>
                                        <input type="tel" class="form-control" id="mobile_number" placeholder="Phone number" aria-label="Mobile number" aria-describedby="Mobile number">
                                      </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    @if (!empty($companySettings->fax))
                                    <input type="text" class="form-control" name="fax" value="{{ $companySettings->fax }}">
                                    @else
                                    <input type="text" class="form-control" name="fax" value="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    @if (!empty($companySettings->website_url))
                                    <input type="text" class="form-control" name="website_url" value="{{ $companySettings->website_url }}">
                                    @else
                                    <input type="text" class="form-control" name="website_url" value="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

    @section('script')
        <script>
             const mobilenumber = document.getElementById('mobile_number');

            mobilenumber.addEventListener('input', function(e) {
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            })

        </script>

    @endsection
@endsection
