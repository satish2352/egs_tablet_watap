@extends('admin.layout.master')
<!-- <link href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css"> -->

@section('content')
<!-- 
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script> -->

    <?php $data_permission = getPermissionForCRUDPresentOrNot('list-users', session('permissions')); ?>
    <div class="main-panel">
        <div class="content-wrapper mt-7">
            <div class="page-header">
                <h3 class="page-title">
                    Beneficary List
                </h3>
                <span> Distributor Name : <b>{{ $all_data['distributer_data']['f_name'] }} {{ $all_data['distributer_data']['m_name'] }}
                     {{ $all_data['distributer_data']['l_name'] }}</b></span>
                     <span> Total Beneficiary : <b>{{ $all_data['count'] }}</b></span>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('list-users') }}">Distributor Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Beneficiary</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">

                <div class="row">
                         
                            

                        @if(session()->get('role_id')=='1')
                        <div class="row">

                       
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <input type="hidden" class="form-control mb-2" name="edit_id" id="edit_id"value="{{ $edit_id }}">
                                    <select class="form-control" name="district_id" id="district_id">
                                        <option value="">Select District</option>
                                        @foreach ($district_data as $district_for_data)    
                                        <option value="{{ $district_for_data['location_id'] }}">{{ $district_for_data['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('district_id'))
                                        <span class="red-text"><?php echo $errors->first('district_id', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="taluka_id" id="taluka_id">
                                        <option value="">Select Taluka</option>
                                    </select>
                                    @if ($errors->has('taluka_id'))
                                        <span class="red-text"><?php echo $errors->first('taluka_id', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="village_id" id="village_id">
                                    <option value="">Select Village</option>
                                    </select>
                                    @if ($errors->has('village_id'))
                                        <span class="red-text"><?php echo $errors->first('village_id', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-sm btn-success" id="submitButton">Search</button>
                                        </div>
                                        <div class="col-lg-2">
                                            <form action="{{ route('filter-tablet-distributer-baneficiary-export') }}" method="POST" target="__blank">
                                                @csrf
                                                <input type="hidden" name="dist_new_id" id="dist_new_id" value="">
                                                <input type="hidden" name="tal_new_id" id="tal_new_id" value="">
                                                <input type="hidden" name="vil_new_id" id="vil_new_id" value="">
                                                <input type="hidden" name="distributer_id" id="distributer_id" value="{{ $edit_id }}">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <div class="flex justify-between">
                                                        <div>
                                                            Export Excel <!-- Adding text inside the button -->
                                                        </div>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                          @elseif(session()->get('role_id')=='2')
                        <div class="row">

                        
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="taluka_id" id="taluka_id">
                                        <option value="">Select Taluka</option>
                                        @foreach ($taluka_data as $taluka_for_data)    
                                        <option value="{{ $taluka_for_data['location_id'] }}">{{ $taluka_for_data['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('taluka_id'))
                                        <span class="red-text"><?php echo $errors->first('taluka_id', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="village_id" id="village_id">
                                    <option value="">Select Village</option>
                                    </select>
                                    @if ($errors->has('village_id'))
                                        <span class="red-text"><?php echo $errors->first('village_id', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success" id="submitButton">
                                            Search
                                        </button>
                                </div>
                            </div>
                        </div>
                          @endif  

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @include('admin.layout.alert')
                                    <div class="table-responsive">
                                        <!-- <table id="table_data" class="table table-bordered"> -->
                                        <table id="order-listing" class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Gramsevak Name</th>
                                                    <th>District</th>
                                                    <th>Taluka</th>
                                                    <th>Grampanchayat Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_data['beneficiary_data'] as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item['full_name'] }}
                                                        </td>
                                                        <td>{{ $item['district'] }}</td>
                                                        <td>{{ $item['taluka'] }}</td>
                                                        <td>
                                                            @if($item['vid']=='999999')
                                                                {{ $item['gram_panchayat_name'] }}
                                                            @else
                                                            {{ $item['village'] }}
                                                            @endif
                                                        </td>

                                                        <td class="d-flex">
                                                                 
                                                            <a data-id="{{ $item['ben_id'] }}"
                                                                class="show-btn btn btn-sm btn-outline-primary m-1"><i
                                                                    class="fas fa-eye"></i></a>
                                                         

                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                $('#district_id').change(function(e) {
                    e.preventDefault();
                    var districtId = $('#district_id').val();
                    $("#dist_new_id").val(districtId);

                    if (districtId !== '') {
                        $.ajax({
                            url: '{{ route('taluka') }}',
                            type: 'GET',
                            data: {
                                districtId: districtId
                            },
                            success: function(response) {
                                if (response.taluka.length > 0) {
                                    $('#taluka_id').empty();
                                    $('#village_id').empty();
                                    $('#taluka_id').html('<option value="">Select Taluka</option>');
                                    $('#village_id').html('<option value="">Select Village</option>');
                                    $.each(response.taluka, function(index, taluka) {
                                        $('#taluka_id').append('<option value="' + taluka
                                            .location_id +
                                            '">' + taluka.name + '</option>');
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {

                $('#taluka_id').change(function(e) {
                    e.preventDefault();
                    var talukaId = $('#taluka_id').val();
                    $("#tal_new_id").val(talukaId);

                    if (talukaId !== '') {
                        $.ajax({
                            url: '{{ route('village') }}',
                            type: 'GET',
                            data: {
                                talukaId: talukaId
                            },
                            success: function(response) {
                                if (response.village.length > 0) {
                                    $('#village_id').empty();
                                    $('#village_id').html('<option value="">Select Village</option>');
                                    $.each(response.village, function(index, village) {
                                        $('#village_id').append('<option value="' + village
                                            .location_id +
                                            '">' + village.name + '</option>');
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>

<script>
            $(document).ready(function() {

                $('#village_id').change(function(e) {
                    e.preventDefault();
                    var villageId = $('#village_id').val();
                    $("#vil_new_id").val(villageId);
                });
            });
        </script>

<script>
            $(document).ready(function() {

                $('#submitButton').click(function(e) {
                    e.preventDefault();
                    var districtId = $('#district_id').val()
                    if(districtId==undefined){
                        districtId="";
                    }
                    var talukaId = $('#taluka_id').val();
                    var villageId = $('#village_id').val();
                    var editId = $('#edit_id').val();
// alert(editId);

                    if (districtId !== '' || talukaId !== '' || villageId !== '') {
                        $.ajax({
                            url: '{{ route('filter-tablet-distribution') }}',
                            type: 'GET',
                            data: {
                                districtId: districtId,
                                talukaId: talukaId,
                                villageId: villageId,
                                editId: editId,
                            },
                            // headers: {
                            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            // },
                            success: function(response) {
                                console.log(response);
                                if (response.labour_ajax_data.length > '0') {

                                    var table = $('#order-listing').DataTable();
                                    table.clear().draw();

                                    $.each(response.labour_ajax_data, function(index, labour_data) {

                                    if(labour_data.vid='999999')
                                    {
                                        var new_vil_name=labour_data.gram_panchayat_name
                                    }
                                    else
                                    {
                                        var new_vil_name=labour_data.village;
                                    }
                                        index++;
                                        table.row.add([ index,
                                            labour_data.full_name,
                                            labour_data.district,
                                            labour_data.taluka,
                                            new_vil_name,
                                            '<a onClick="getData(' + labour_data.id + ')" class="show-btn btn btn-sm btn-outline-primary m-1"><i class="fas fa-eye"></i></a>']).draw(false);
                                    });

                                    // $('#order-listing tbody').empty();
                                    
                                    // $.each(response.labour_attendance_ajax_data, function(index, labour_attendance_data) {
                                    //     console.log(labour_attendance_data.created_at);
                                    //     var lid=index + parseInt(1);
                                    //     $('#order-listing tbody').append('<tr><td>' + lid +'</td><td>' + labour_attendance_data.project_name + '</td><td>' + labour_attendance_data.full_name +'</td><td>' + labour_attendance_data.mobile_number + '</td><td>' + labour_attendance_data.mgnrega_card_id + '</td><td>' + labour_attendance_data.attendance_day+ '</td><td>' + labour_attendance_data.created_at + '</td></tr>');
                                    // });
                                }else{
                                    $('#order-listing tbody').empty();
                                    $('#order-listing tbody').append('<tr><td colspan="7" style="text-align:center;"><b>No Record Found</b></td></tr>');

                                    // alert("No Record Found");
                                }

                            }
                        });
                    }
                });
            });
        </script>

<script>

// $(document).ready(() => {
    function getData(data){
    $("#show_id").val(data);
    $("#showform").submit();
}
// });
</script>
     
        <form method="POST" action="{{ url('/show-distributer-baneficiary-details') }}" id="showform">
            @csrf
            <input type="hidden" name="show_id" id="show_id" value="">
            <input type="hidden" name="edit_id" id="edit_id"value="{{ $edit_id }}">
        </form>
        <!-- content-wrapper ends -->
    @endsection
