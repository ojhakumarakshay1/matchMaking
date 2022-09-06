@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>{{ __('Your Profile') }}</h2></div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-success" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form id="updateForm" role="form" method="POST" enctype="multipart/form-data" action="{{ route('update-profile') }}">
                        @csrf
                        @php
                            $preference = $user->preference;
                        @endphp
                        <h3>
                            {{ __('About You') }}
                        </h3>
                        <div class="personal">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">{{ __('First Name') }}</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', ($user->first_name ?? '')) ?? '' }}" placeholder="{{ __('First name') }}">
                                    @error('first_name')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputLastName">{{ __('Last Name') }}</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', ($user->last_name ?? '')) ?? '' }}" placeholder="{{ __('Last name') }}">
                                    @error('last_name')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail">{{ __('Email') }}</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', ($user->email ?? '')) ?? '' }}" placeholder="{{ __('Email') }}" readonly>
                                    @error('email')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDOB">{{ __('Date of Birth') }}</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class='fa fa-calendar'></i></span>
                                        </div>
                                        <input type="text" class="form-control datepicker @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', ($user->formated_dob ?? '')) ?? '' }}" placeholder="{{ __('Date of Birth') }}" readonly>
                                    </div>
                                    
                                    @error('dob')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputGender">{{ __('Gender') }}</label>
                                    <div class="input-group">
                                        @php
                                            $gender = old('gender', ($user->gender ?? '')) ?? '';
                                        @endphp
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="gender1" name="gender" value="{{GENDER_TYPE_MALE}}" class="custom-control-input  @error('gender') is-invalid @enderror" @if($gender === GENDER_TYPE_MALE)  checked  @endif>
                                            <label class="custom-control-label" for="gender1">{{ __('Male') }}</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="gender2" name="gender" value="{{GENDER_TYPE_FEMALE}}" class="custom-control-input  @error('gender') is-invalid @enderror" @if($gender === GENDER_TYPE_FEMALE)  checked  @endif>
                                            <label class="custom-control-label" for="gender2">{{ __('Female') }}</label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAnnualIncome">{{ __('Annual Income') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-rupee"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('annual_income') is-invalid @enderror" id="annual_income" name="annual_income" value="{{ old('annual_income', ($user->annual_income ?? '')) ?? '' }}" placeholder="{{ __('Annual Income') }}">
                                    </div>
                                    
                                    @error('annual_income')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputOccupation">{{ __('Occupation') }}</label>
                                    <select class="custom-select @error('occupation') is-invalid @enderror" id="occupation" name="occupation">
                                        <option value=''>{{ __('Select your Occupation') }}</option>
                                        @php
                                            $occupation = old('occupation', ($user->occupation ?? '')) ?? '';
                                        @endphp
                                        <option value="{{ OCCUPATION_TYPE_PRIVATE_JOB }}" @if($occupation === OCCUPATION_TYPE_PRIVATE_JOB)  selected  @endif>{{ __('Private Job') }}</option>
                                        <option value="{{ OCCUPATION_TYPE_GOVERNMENT_JOB }}" @if($occupation === OCCUPATION_TYPE_GOVERNMENT_JOB)  selected  @endif>{{ __('Government Job') }}</option>
                                        <option value="{{ OCCUPATION_TYPE_BUSINESS }}" @if($occupation === OCCUPATION_TYPE_BUSINESS)  selected  @endif>{{ __('Business') }}</option>
                                    </select>
                                    @error('occupation')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFamilyType">{{ __('Family Type') }}</label>
                                    <select class="custom-select @error('family_type') is-invalid @enderror" id="family_type" name="family_type">
                                        <option value=''>{{ __('Select your Family Type') }}</option>
                                        @php
                                            $familyType = old('family_type', ($user->family_type ?? '')) ?? '';
                                        @endphp
                                        <option value="{{ FAMILY_TYPE_JOINT }}" @if($familyType === FAMILY_TYPE_JOINT)  selected  @endif>{{ __('Joint Family') }}</option>
                                        <option value="{{ FAMILY_TYPE_NUCLEAR }}" @if($familyType === FAMILY_TYPE_NUCLEAR)  selected  @endif>{{ __('Nuclear Family') }}</option>
                                    </select>
                                    @error('family_type')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputManglik">{{ __('Are you Manglik?') }}</label>
                                    <select class="custom-select @error('manglik') is-invalid @enderror" id="is_manglik" name="is_manglik">
                                        @php
                                            $isManglik = old('is_manglik', ($user->is_manglik ?? '')) ?? '';
                                        @endphp
                                        <option value=''>{{ __('Please select') }}</option>
                                        <option value="yes" @if($isManglik == true)  selected  @endif>{{ __('Yes') }}</option>
                                        <option value="no" @if($isManglik == false)  selected  @endif>{{ __('No') }}</option>
                                    </select>
                                    @error('is_manglik')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>    
                            </div>
                        </div>
                        <h3 class="mt-5">
                            {{ __('Your Preferences') }}
                            <small class="text-muted">{{ __('about your future partner ')}}</small>
                        </h3>
                        <hr />
                        <div class="preferences">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAnnualIncome">{{ __('Annual Income') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-rupee"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('prefered_annual_amount') is-invalid @enderror" id="prefered_annual_amount" name="prefered_annual_amount" value="{{ old('prefered_annual_amount', ($preference->prefered_annual_amount ?? '')) ?? '' }}" placeholder="{{ __('Annual Income') }}">
                                    </div>
                                    
                                    @error('prefered_annual_amount')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputOccupation">{{ __('Occupation') }}</label>
                                    <select class="custom-select @error('prefered_occupation') is-invalid @enderror" id="prefered_occupation" name="prefered_occupation[]" multiple>
                                        @php
                                            $partnerOccupation =  [];
                                            if(isset($preference->prefered_occupation)){
                                                $partnerOccupation = explode(',', $preference->prefered_occupation);
                                            }
                                        @endphp
                                        <option value="{{ OCCUPATION_TYPE_PRIVATE_JOB }}" @if(in_array(OCCUPATION_TYPE_PRIVATE_JOB, $partnerOccupation))  selected  @endif>{{ __('Private Job') }}</option>
                                        <option value="{{ OCCUPATION_TYPE_GOVERNMENT_JOB }}" @if(in_array(OCCUPATION_TYPE_GOVERNMENT_JOB, $partnerOccupation))  selected  @endif>{{ __('Government Job') }}</option>
                                        <option value="{{ OCCUPATION_TYPE_BUSINESS }}" @if(in_array(OCCUPATION_TYPE_BUSINESS, $partnerOccupation))  selected  @endif>{{ __('Business') }}</option>
                                    </select>
                                    @error('prefered_occupation')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFamilyType">{{ __('Family Type') }}</label>
                                    <select class="custom-select @error('family_type') is-invalid @enderror" id="prefered_family_type" name="prefered_family_type[]" multiple>
                                        @php
                                            $partnerFamilyType =  [];
                                            if(isset($preference->prefered_family_type)){
                                                $partnerFamilyType = explode(',', $preference->prefered_family_type);
                                            }
                                        @endphp
                                        <option value="{{ FAMILY_TYPE_JOINT }}" @if(in_array(FAMILY_TYPE_JOINT, $partnerFamilyType))  selected  @endif>{{ __('Joint Family') }}</option>
                                        <option value="{{ FAMILY_TYPE_NUCLEAR }}" @if(in_array(FAMILY_TYPE_NUCLEAR, $partnerFamilyType))  selected  @endif>{{ __('Nuclear Family') }}</option>
                                    </select>
                                    @error('prefered_family_type')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputManglik">{{ __('Are you Manglik?') }}</label>
                                    <select class="custom-select @error('manglik') is-invalid @enderror" id="prefered_manglik" name="prefered_manglik">
                                        <option value=''>{{ __('Please select') }}</option>
                                        @php
                                            $isPartnerManglik = old('prefered_manglik', ($preference->prefered_manglik ?? '')) ?? '';
                                        @endphp
                                        <option value="{{PREFERED_MANGLIK_YES}}" @if($isPartnerManglik === PREFERED_MANGLIK_YES)  selected  @endif>{{ __('Yes') }}</option>
                                        <option value="{{PREFERED_MANGLIK_NO}}" @if($isPartnerManglik === PREFERED_MANGLIK_NO)  selected  @endif>{{ __('No') }}</option>
                                        <option value="{{PREFERED_MAGLINK_BOTH}}" @if($isPartnerManglik == PREFERED_MAGLINK_BOTH)  selected  @endif>{{ __('Both') }}</option>
                                    </select>
                                    @error('prefered_manglik')
                                        <span class="error invalid-feedback" style="display: inline;">{{ $message }}</span>
                                    @enderror
                                </div>  
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Find Matching') }}</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- jquery-validation -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/additional-methods.js" type="text/javascript"></script>

<script>

$(document).ready(function() {
    // $('.datepicker').datepicker().val('');

    $(function () {
        $('.datepicker').datepicker({ 
            endDate: '-18y',
        });
    });

    // Validation
    $('#updateForm').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
            },
            last_name: {
                required: true,
                minlength: 3,
            },
            dob: {
                required: true,
            },
            gender: {
                required: true,
            },
            annual_income: {
                required: true,
                min: 0
            },
            occupation: {
                required: true,
            },
            family_type: {
                required: true,
            },
            is_manglik: {
                required: true,
            },
            prefered_annual_amount: {
                required: true,
                min: 0
            },
            "prefered_occupation[]": {
                required: true,
            },
            "prefered_family_type[]": {
                required: true,
            },
            "prefered_manglik": {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "It must be at least {0} characters long"
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "It must be at least {0} characters long"
            },
            dob: {
                required: "Please select your date of birth",
            },
            gender: {
                required: "Please specify your gender",
            },
            annual_income: {
                required: "Please enter your annual income",
                min: "Please enter valid amount"
            },
            occupation: {
                required: "Please select your occupation",
            },
            family_type: {
                required: "Please select your family type",
            },
            is_manglik: {
                required: "Please select suitable one",
            },
            prefered_annual_amount: {
                required: "Please enter expected annual income",
                min: "Please enter valid amount"
            },
            "prefered_occupation[]": {
                required: "Please select expected occupation ",
            },
            "prefered_family_type[]": {
                required: "Please select expected family type ",
            },
            "prefered_manglik": {
                required: "Please select expected condition",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endsection
