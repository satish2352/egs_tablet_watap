@extends('admin.layout.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <?php $data_permission = getPermissionForCRUDPresentOrNot('list-users', session('permissions')); ?>
    <div class="main-panel">
        <div class="content-wrapper mt-7">
            <div class="page-header">
                <h3 class="page-title">
                All Beneficary List
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">All Beneficary</a></li>
                        <!-- <li class="breadcrumb-item active" aria-current="page">All Beneficary</li> -->
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
                                            <form action="{{ route('filter-tablet-distribution-all-export') }}" method="POST" target="__blank">
                                                @csrf
                                                <input type="hidden" name="dist_new_id" id="dist_new_id" value="">
                                                <input type="hidden" name="tal_new_id" id="tal_new_id" value="">
                                                <input type="hidden" name="vil_new_id" id="vil_new_id" value="">
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
                                        <table id="order-listing" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Gramsevak Name</th>
                                                    <th>District</th>
                                                    <th>Taluka</th>
                                                    <th>Village</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($gramsevaks as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->full_name }}
                                                        </td>
                                                        <td>{{ $item->district }}</td>
                                                        <td>{{ $item->taluka }}</td>
                                                        <td>{{ $item->village }}</td>

                                                        <td class="d-flex">
                                                                 
                                                            <a data-id="{{ $item->id }}"
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

                    if (districtId !== '' || talukaId !== '' || villageId !== '') {
                        $.ajax({
                            url: '{{ route('filter-tablet-distribution-all') }}',
                            type: 'GET',
                            data: {
                                districtId: districtId,
                                talukaId: talukaId,
                                villageId: villageId,
                            },
                            // headers: {
                            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            // },
                            success: function(response) {
                                if (response.labour_ajax_data.length > '0') {

                                    var table = $('#order-listing').DataTable();
                                    table.clear().draw();

                                    $.each(response.labour_ajax_data, function(index, labour_data) {
                                        index++;
                                        table.row.add([ index,
                                            labour_data.full_name,
                                            labour_data.district,
                                            labour_data.taluka,
                                            labour_data.village,
                                            '<a onClick="getData(' + labour_data.id + ')" class="show-btn btn btn-sm btn-outline-primary m-1"><i class="fas fa-eye"></i></a>']).draw(false);
                                    });
                                }else{
                                    $('#order-listing tbody').empty();
                                    $('#order-listing tbody').append('<tr><td colspan="7" style="text-align:center;"><b>No Record Found</b></td></tr>');

                                }

                            }
                        });
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#submitExportButton').click(function(e) {
                    e.preventDefault();
                    var districtId = $('#district_id').val()
                    if(districtId==undefined){
                        districtId="";
                    }
                    var talukaId = $('#taluka_id').val();
                    var villageId = $('#village_id').val();

                    if (districtId !== '' || talukaId !== '' || villageId !== '') {
                        $.ajax({
                            url: '{{ route('filter-tablet-distribution-all-export') }}',
                            type: 'POST',
                            data: {
                                districtId: districtId,
                                talukaId: talukaId,
                                villageId: villageId,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                               alert('done');

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
     
        <form method="POST" action="{{ url('/show-tablet-distribution') }}" id="showform">
            @csrf
            <input type="hidden" name="show_id" id="show_id" value="">
        </form>
        <!-- content-wrapper ends -->
    @endsection
