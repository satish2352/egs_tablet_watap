@extends('admin.layout.master')

@section('content')
    <?php $data_permission = getPermissionForCRUDPresentOrNot('list-role', session('permissions'));
    ?>
    <div class="main-panel">
        <div class="content-wrapper mt-7">
            <div class="page-header">
                <h3 class="page-title">
                    Labour Duration Report
                   

                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('list-role') }}">Reports</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Labour Duration Report</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                          <div class="d-flex pt-5 pb-3">

                            {{-- <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="district" id="district">
                                        <option value="">Select District</option>
                                        <option value="1">Nashik</option>
                                        <option value="2">Pune</option>
                                        <option value="3">Mumbai</option>
                                    </select>
                                    @if ($errors->has('district'))
                                        <span class="red-text"><?php //echo $errors->first('district', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="taluka" id="taluka">
                                        <option value="">Select Taluka</option>
                                        <option value="11">Nashik</option>
                                        <option value="22">Sinnar</option>
                                        <option value="33">Igatpuri</option>
                                        <option value="44">Pune</option>
                                        <option value="55">Haveli</option>
                                        <option value="66">Maval</option>
                                    </select>
                                    @if ($errors->has('taluka'))
                                        <span class="red-text"><?php //echo $errors->first('taluka', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="village" id="village">
                                        <option value="">Select Village</option>
                                        <option value="Aadgav">Aadgav</option>
                                        <option value="Adgaon">Adgaon</option>
                                        <option value="Ahergaon">Ahergaon</option>
                                        <option value="Ahilyapur">Ahilyapur</option>
                                        <option value="Akole">Akole</option>
                                        <option value="Akrale">Akrale</option>
                                        <option value="Ambad">Ambad</option>
                                        <option value="Ane">Ane</option>
                                        <option value="Anjaneri">Anjaneri</option>
                                        <option value="Antroli">Antroli</option>
                                    </select>
                                    @if ($errors->has('village'))
                                        <span class="red-text"><?php //echo $errors->first('village', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="skill_id" id="skill_id">
                                        <option value="">Select Skill</option>
                                        <option value="">Select Skill</option>
                                        <option value="Carpentry">Carpentry</option>
                                        <option value="Plumbing">Plumbing</option>
                                        <option value="Electrician">Electrician</option>
                                        <option value="Masonry">Masonry</option>
                                        <option value="Painting">Painting</option>
                                        <option value="Welding">Welding</option>
                                    </select>
                                    @if ($errors->has('skill_id'))
                                        <span class="red-text"><?php //echo $errors->first('skill_id', ':message'); ?></span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="m_name">From Date</label>&nbsp<span class="red-text">*</span>
                                    <input type="date" class="form-control" name="m_name" id="m_name"
                                        placeholder="" >
                                    @if ($errors->has('m_name'))
                                        <span class="red-text"><?php echo $errors->first('m_name', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="m_name">To Date</label>&nbsp<span class="red-text">*</span>
                                    <input type="date" class="form-control" name="m_name" id="m_name"
                                        placeholder="" >
                                    @if ($errors->has('m_name'))
                                        <span class="red-text"><?php echo $errors->first('m_name', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="m_name">Skill</label>&nbsp<span class="red-text">*</span>
                                    <select class="form-control" name="skill_id" id="skill_id">
                                        <option value="">Select Skill</option>
                                        <option value="">Select Skill</option>
                                        <option value="Carpentry">Carpentry</option>
                                        <option value="Plumbing">Plumbing</option>
                                        <option value="Electrician">Electrician</option>
                                        <option value="Masonry">Masonry</option>
                                        <option value="Painting">Painting</option>
                                        <option value="Welding">Welding</option>
                                    </select>
                                    @if ($errors->has('skill_id'))
                                        <span class="red-text"><?php echo $errors->first('skill_id', ':message'); ?></span>
                                    @endif
                                </div>
                            </div>
                          </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    @include('admin.layout.alert')
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Date of Birth</th>
                                                    <th>Mobile Number</th>
                                                    <th>Landline Number</th>
                                                    <th>Mgnrega Card Id</th>
                                                    <th>Latitude</th>
                                                    <th>Longitude</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($getOutput as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ strip_tags($item->full_name) }}</td>
                                                        <td>{{ strip_tags($item->name) }}</td> 
                                                      <td>{{ strip_tags($item->date_of_birth) }}</td> 
                                                      <td>{{ strip_tags($item->mobile_number) }}</td> 
                                                      <td>{{ strip_tags($item->landline_number) }}</td> 
                                                      <td>{{ strip_tags($item->mgnrega_card_id) }}</td> 
                                                      <td>{{ strip_tags($item->latitude) }}</td> 
                                                      <td>{{ strip_tags($item->longitude) }}</td> 
                                                    </tr>
                                                @endforeach --}}

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
       
    @endsection
