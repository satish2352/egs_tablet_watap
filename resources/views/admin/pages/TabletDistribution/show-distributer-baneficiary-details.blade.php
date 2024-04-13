@extends('admin.layout.master')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper mt-7">

            <div class="row justify-content-center">
                <div class="col-8 grid-margin ">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-start align-items-center">
                            <h3 class="page-title">
                                Tablet Distribution Details
                            </h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end align-items-center">
                            <div>
                            <a href="{{ route('list-distributer-baneficiary', ['edit_id' => $editId]) }}" class="btn btn-sm btn-primary ml-3">Back</a>
                            </div>
                        </div>

                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    @include('admin.layout.alert')
                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Gramsevak Name :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ $data_gram_doc_details['user_data']['full_name'] }}</label>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Grampanchayat Name :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ $data_gram_doc_details['user_data']['gram_panchayat_name'] }}</label>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Mobile Number :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ $data_gram_doc_details['user_data']['mobile_number'] }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Aadhar Card Number :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ $data_gram_doc_details['user_data']['adhar_card_number'] }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>District :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($data_gram_doc_details['user_data']['district']) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Taluka :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($data_gram_doc_details['user_data']['taluka']) }}</label>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Village :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($data_gram_doc_details['user_data']['village']) }}</label>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Latitude :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($data_gram_doc_details['user_data']['latitude']) }}</label>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>longitude :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>{{ strip_tags($data_gram_doc_details['user_data']['longitude']) }}</label>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Aadhar Image :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img class="preview-image" src="{{ Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') }}{{ $data_gram_doc_details['user_data']['aadhar_image'] }}"
                                                style="width:100px; height:100px;" />
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Gramsevak ID Card :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img class="preview-image" src="{{ Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') }}{{ $data_gram_doc_details['user_data']['gram_sevak_id_card_photo'] }}"
                                                style="width:100px; height:100px;" />
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Photo Of Beneficiry :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img class="preview-image" src="{{ Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') }}{{ $data_gram_doc_details['user_data']['photo_of_beneficiary'] }}"
                                                style="width:100px; height:100px;" />
                                        
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Photo Tablet IMEI :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img class="preview-image" src="{{ Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') }}{{ $data_gram_doc_details['user_data']['photo_of_tablet_imei'] }}"
                                                style="width:100px; height:100px;" />
                                        
                                        </div>
                                    </div>
                                    <input type="hidden" class="tok" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                   


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    




    @endsection

