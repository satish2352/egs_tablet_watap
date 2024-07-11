@extends('admin.layout.master')

@section('content')

<style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0 0 0 / 33%);
        }

        /* Modal content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of modal image */
        .caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add animation (zoom in) */
        .modal-content, .caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform: scale(0)}
            to {-webkit-transform: scale(1)}
        }

        @keyframes zoom {
            from {transform: scale(0)}
            to {transform: scale(1)}
        }

        /* Close button */
        .close {
            position: absolute;
            margin-top: 2%;
            right: 5%;
            right: 35px;
            color: #000;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <div class="main-panel">
        <div class="content-wrapper mt-7">

            <div class="row justify-content-center">
                <div class="col-8 grid-margin ">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-start align-items-center">
                            <h3 class="page-title">
                                Tablet Beneficiary Details
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
                                            <label>Grampanchayat Name :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>
                                                @if($data_gram_doc_details['user_data']['vid']=='999999')
                                                    {{ strip_tags($data_gram_doc_details['user_data']['gram_panchayat_name']) }}
                                                @else
                                                    {{ strip_tags($data_gram_doc_details['user_data']['village']) }}
                                                @endif
                                            </label>
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
                                            <img class="preview-image" src="{{ asset('storage/all_web_data/images/gramsevak/'.$data_gram_doc_details['user_data']['aadhar_image']) }}" style="width:100px; height:100px;" onclick="openModal(this.src, 'Aadhar Image')" />
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Gramsevak ID Card :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img class="preview-image" src="{{ asset('storage/all_web_data/images/gramsevak/'.$data_gram_doc_details['user_data']['gram_sevak_id_card_photo']) }}" style="width:100px; height:100px;" onclick="openModal(this.src, 'Gramsevak ID Card')" />
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Photo Of Beneficiary :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img class="preview-image" src="{{ asset('storage/all_web_data/images/gramsevak/'.$data_gram_doc_details['user_data']['photo_of_beneficiary']) }}" style="width:100px; height:100px;" onclick="openModal(this.src, 'Photo Of Beneficiary')" />
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Photo Tablet IMEI :</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <img class="preview-image" src="{{ asset('storage/all_web_data/images/gramsevak/'.$data_gram_doc_details['user_data']['photo_of_tablet_imei']) }}" style="width:100px; height:100px;" onclick="openModal(this.src, 'Photo Tablet IMEI')" />
                                        </div>
                                    </div>

                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">
                                        <span class="close" onclick="closeModal()">&times;</span>
                                        <img class="modal-content" id="img01">
                                        <div class="caption" id="caption"></div>
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
    

        <script>
            // Function to open modal and display the image
            function openModal(src, caption) {
                const modal = document.getElementById("myModal");
                const modalImg = document.getElementById("img01");
                const captionText = document.getElementById("caption");
                modal.style.display = "block";
                modalImg.src = src;
                captionText.innerHTML = caption;
            }

            // Function to close the modal
            function closeModal() {
                const modal = document.getElementById("myModal");
                modal.style.display = "none";
            }

            // Event listener to close the modal when clicking outside of the image
            window.onclick = function(event) {
                const modal = document.getElementById("myModal");
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>



    @endsection

