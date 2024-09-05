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
                                    <input class="form-control" type="text" name="company_name" value="{{ $companySettings ? $companySettings->company_name : '' }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    <input type="text" class="form-control" name="contact_person" value="{{ $companySettings ?$companySettings->contact_person : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ $companySettings ? $companySettings->address : '' }}">
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
                                    <input type="text" class="form-control" name="city" value="{{ $companySettings ?  $companySettings->city : '' }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <select class="form-control select" name="state_province">
                                            <option value="{{ $companySettings ? $companySettings->state_province : 'Metro Manila' }}"
                                                {{  (isset($companySettings) && $companySettings->state_province === 'Metro Manila') ? 'selected' : '' }}>Metro Manila</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code" value="{{ $companySettings ? $companySettings->postal_code : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $companySettings ? $companySettings->email : '' }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                      <div class="input-group mb-3">
                                        <span class="input-group-text" id="mobile-label">+63</span>
                                        <input type="tel" class="form-control" value="{{ $companySettings ?  $companySettings->mobile_number : '' }}" id="mobile_number" placeholder="Phone number" aria-label="Mobile number" aria-describedby="Mobile number">
                                      </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input type="text" class="form-control" name="website_url" value="{{ $companySettings ? $companySettings->website_url : '' }}">
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
