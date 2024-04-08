<?php

namespace App\Http\Controllers\Api\TabletDistribution;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\ {
	GramSevakTabletDistribution,
};
use Illuminate\Support\Facades\Config;



class GramSevakTabletDistributionController extends Controller
{
    public function add(Request $request ){

        $all_data_validation = [
            'full_name' => 'required',
            'district_id' => 'required', 
            'taluka_id' => 'required',
            'village_id' => 'required',
            'gram_panchayat_name' => 'required', 
            'mobile_number' => ['required', 'digits:10'], 
            'adhar_card_number' => ['required', 'digits:12'], 
            'latitude' => ['required', 'between:-90,90'], // Latitude range
            'longitude' => ['required', 'between:-180,180'], // Longitude range
            'aadhar_image' => 'required|image|mimes:jpeg,png,jpg,gif|min:10|max:2048',  
            'gram_sevak_id_card_photo' => 'required|image|mimes:jpeg,png,jpg,gif|min:10|max:2048', 
            'photo_of_beneficiary' => 'required|image|mimes:jpeg,png,jpg,gif|min:10|max:2048',
            'photo_of_tablet_imei' => 'required|image|mimes:jpeg,png,jpg,gif|min:10|max:2048',
        ];
      
        $validator = Validator::make($request->all(), $all_data_validation);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 200);
        }

        try {
            // Check if the user exists
            $user = Auth::user();

            $labour_data = new GramSevakTabletDistribution();
            $labour_data->user_id = $user->id; // Assign the user ID

            $labour_data->full_name = $request->full_name;
            $labour_data->gram_panchayat_name = $request->gram_panchayat_name;
            $labour_data->district_id = $request->district_id;
            $labour_data->taluka_id = $request->taluka_id;
            $labour_data->village_id = $request->village_id;
            $labour_data->mobile_number = $request->mobile_number;
            $labour_data->adhar_card_number = $request->adhar_card_number;
            $labour_data->latitude = $request->latitude;
            $labour_data->longitude = $request->longitude;


            $labour_data->save();

            $last_insert_id = $labour_data->id;
            $imageAadhar = $last_insert_id . '_' . rand(100000, 999999) . '_aadhar.' . $request->aadhar_image->extension();
            $gram_sevak_id_card_photo = $last_insert_id . '_' . rand(100000, 999999) . '_profile.' . $request->gram_sevak_id_card_photo->extension();
            $photo_of_beneficiary = $last_insert_id . '_' . rand(100000, 999999) . '_voter.' . $request->photo_of_beneficiary->extension();
            $photo_of_tablet_imei = $last_insert_id . '_' . rand(100000, 999999) . '_photo_of_tablet_imei.' . $request->photo_of_tablet_imei->extension();

            $path = Config::get('DocumentConstant.USER_GRAMSEVAK_ADD');

            uploadImage($request, 'aadhar_image', $path, $imageAadhar);
            uploadImage($request, 'gram_sevak_id_card_photo', $path, $gram_sevak_id_card_photo);
            uploadImage($request, 'photo_of_beneficiary', $path, $photo_of_beneficiary);
            uploadImage($request, 'photo_of_tablet_imei', $path, $photo_of_tablet_imei);

            // Update the image paths in the database
            $labour_data->aadhar_image =  $imageAadhar;
            $labour_data->gram_sevak_id_card_photo = $gram_sevak_id_card_photo;
            $labour_data->photo_of_beneficiary =  $photo_of_beneficiary;
            $labour_data->photo_of_tablet_imei =  $photo_of_tablet_imei;
            $labour_data->save();

            // Include image paths in the response
            $labour_data->aadhar_image = $labour_data->aadhar_image;
            $labour_data->gram_sevak_id_card_photo = $labour_data->gram_sevak_id_card_photo;
            $labour_data->photo_of_tablet_imei = $labour_data->photo_of_tablet_imei;

            return response()->json([
                'status' => 'True',
                'message' => 'Tablet distribution information added successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
   
    public function getAllTabletDistributionList(Request $request){
    
        try {

            $page = isset($request["start"]) ? $request["start"] : 1;
            $rowperpage = isset($request["length"])? $request["length"] : 10; // Rows display per pa]e

            $start = ($page - 1) * $rowperpage;

            $data_output = [];
            $user = Auth::user()->id;
            
            $basic_query_object = GramSevakTabletDistribution::leftJoin('tbl_area as district_labour', 'gram_sevak_tablet_distribution.district_id', '=', 'district_labour.location_id')
                ->leftJoin('tbl_area as taluka_labour', 'gram_sevak_tablet_distribution.taluka_id', '=', 'taluka_labour.location_id')
                ->leftJoin('tbl_area as village_labour', 'gram_sevak_tablet_distribution.village_id', '=', 'village_labour.location_id')
                ->where('gram_sevak_tablet_distribution.user_id', $user);
                

            if ($request->has('district_id')) {
                $basic_query_object->where('district_labour.location_id', $request->input('district_id'));
            }
            if ($request->has('taluka_id')) {
                $basic_query_object->where('taluka_labour.location_id', $request->input('taluka_id'));
            }
            if ($request->has('village_id')) {
                $basic_query_object->where('village_labour.location_id', $request->input('village_id'));
            }

            $basic_query_object = $basic_query_object->distinct('gram_sevak_tablet_distribution.id');

                $totalRecords = $basic_query_object->select('gram_sevak_tablet_distribution.id')->get()->count();

                $data_output  = $basic_query_object
                ->select(
                    'gram_sevak_tablet_distribution.id',
                    'gram_sevak_tablet_distribution.full_name',
                    'gram_sevak_tablet_distribution.district_id',
                    'district_labour.name as district_name',
                    'gram_sevak_tablet_distribution.taluka_id',
                    'taluka_labour.name as taluka_name',
                    'gram_sevak_tablet_distribution.village_id',
                    'village_labour.name as village_name',
                    'gram_sevak_tablet_distribution.mobile_number',
                    'gram_sevak_tablet_distribution.latitude',
                    'gram_sevak_tablet_distribution.longitude',
                    'gram_sevak_tablet_distribution.gram_sevak_id_card_photo',
                    'gram_sevak_tablet_distribution.aadhar_image',
                    'gram_sevak_tablet_distribution.photo_of_beneficiary',
                    'gram_sevak_tablet_distribution.photo_of_tablet_imei',
    
                    
                    )->skip($start)
                ->take($rowperpage)
                ->get();

                foreach ($data_output as $labour) {
                    // Append image paths to the output data
                    $labour->gram_sevak_id_card_photo = Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') . $labour->gram_sevak_id_card_photo;
                    $labour->aadhar_image = Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') . $labour->aadhar_image;
                    $labour->photo_of_beneficiary = Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') . $labour->photo_of_beneficiary;
                    $labour->photo_of_tablet_imei = Config::get('DocumentConstant.USER_GRAMSEVAK_VIEW') . $labour->photo_of_tablet_imei;

                }

                if(sizeof($data_output)>1) {
                    $totalPages = round($totalRecords/sizeof($data_output));
                } else {
                    $totalPages = 1;
                }
               
          
            return response()->json(['status' => 'true', 'message' => 'All data retrieved successfully', "iTotalRecords" => $totalRecords, "totalPages"=>$totalPages, 'data' => $data_output], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Data get failed', 'error' => $e->getMessage()], 500);
        }

    }
   
    public function updateLabourFirstForm(Request $request){
    try {
        $user = Auth::user();
        // $labour_id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'gender_id' => 'required',
            'district_id' => 'required',
            'taluka_id' => 'required',
            'village_id' => 'required',
            'mobile_number' => ['required', 'digits:10'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 200);
        }

        // Find the labour data to update
        $labour_data = GramSevakTabletDistribution::where('id', $request->id)->first();

        if (!$labour_data) {
            return response()->json(['status' => 'error', 'message' => 'Data not found'], 200);
        }


        // Update labour details
        $labour_data->user_id = $user->id;

        $labour_data->full_name = $request->full_name;
        $labour_data->gram_panchayat_name = $request->gram_panchayat_name;
        $labour_data->district_id = $request->district_id;
        $labour_data->taluka_id = $request->taluka_id;
        $labour_data->village_id = $request->village_id;
        $labour_data->mobile_number = $request->mobile_number;
        $labour_data->adhar_card_number = $request->adhar_card_number;
        $labour_data->latitude = $request->latitude;
        $labour_data->longitude = $request->longitude;

        $labour_data->save();

        return response()->json(['status' => 'true', 'message' => 'Labour updated successfully', 'data' => $labour_data], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 'false', 'message' => 'Labour update failed', 'error' => $e->getMessage()], 500);
    }
   }

    public function mgnregaCardIdAlreadyExist(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'adhar_card_number' => 'required',
                'mobile_number' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 'false', 'message' => 'Validation failed', 'errors' => $validator->errors()], 200);
            }
    
            $GramSevakTabletDistribution = GramSevakTabletDistribution::where('adhar_card_number', $request->adhar_card_number)->first();

            if (!$GramSevakTabletDistribution) {
                return response()->json(['status' => 'error', 'message' => 'Labour not found'], 200);
            }

           
    
            if (($GramSevakTabletDistribution->mobile_number == $request->mobile_number ) || ($GramSevakTabletDistribution->adhar_card_number == $request->adhar_card_number ) ) {
                return response()->json(['status' => 'true', 'message' => 'Adhar  card ID  Or Mobile Number already exists'], 200);
            } else {
                return response()->json(['status' => 'false', 'message' => 'Adhar  card ID  Or Mobile Number does not exist'], 200);
            }
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Update failed','error' => $e->getMessage()], 500);
        }
    }

    
}
