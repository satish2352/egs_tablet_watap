<?php

namespace App\Http\Controllers\Admin\TabletDistribution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\TabletDistribution\TabletDistributionServices;
use App\Models\ {
    Roles,
    Permissions,
    TblArea,
    User,
    GramSevakTabletDistribution
};
use Validator;
use session;
use Config;

class TabletDistributionController extends Controller {
    /**
     * Topic constructor.
     */
    public function __construct()
    {
        $this->service = new TabletDistributionServices();
    }

    public function index()
    {

        $sess_user_id=session()->get('user_id');
		$sess_user_type=session()->get('user_type');
		$sess_user_role=session()->get('role_id');
		$sess_user_working_dist=session()->get('working_dist');
        
        $district_data = TblArea::where('parent_id', '2')
                    ->orderBy('name', 'asc')
                    ->get(['location_id', 'name']);

    
                
        $gramsevaks = $this->service->index();
        return view('admin.pages.TabletDistribution.list-tablet-distribution',compact('gramsevaks','district_data'));
    }

    public function showTabletDistribution(Request $request)
    {
        try {


            $data_gram_doc_details = $this->service->showTabletDistribution($request->show_id);
            // dd($data_gram_doc_details);
            return view('admin.pages.TabletDistribution.show-tablet-distribution', compact('data_gram_doc_details'));
        } catch (\Exception $e) {
            return $e;
        }
    }



  

    public function getFilterTabletDistribution(Request $request)
    {
       $districtId = $request->input('districtId');
        $talukaId = $request->input('talukaId');
        $villageId = $request->input('villageId');
        $editId = $request->input('editId');

            $query_user = User::where('users.role_id','3')
                ->select('id');
                if ($request->filled('districtId')) {
                    $query_user->where('users.user_district', $districtId);
                }
                if ($request->filled('talukaId')) {
                    $query_user->where('users.user_taluka', $talukaId);
                }
                if ($request->filled('villageId')) {
                    $query_user->where('users.user_village', $villageId);
                }

               $data_user_output=$query_user->get();

        $query = GramSevakTabletDistribution::leftJoin('tbl_area as district_user', 'gram_sevak_tablet_distribution.district_id', '=', 'district_user.location_id')
				->leftJoin('tbl_area as taluka_user', 'gram_sevak_tablet_distribution.taluka_id', '=', 'taluka_user.location_id')
				->leftJoin('tbl_area as village_user', 'gram_sevak_tablet_distribution.village_id', '=', 'village_user.location_id')
				->leftJoin('users', 'gram_sevak_tablet_distribution.user_id', '=', 'users.id')
				->where('gram_sevak_tablet_distribution.user_id', '=', $editId)
                ->select('gram_sevak_tablet_distribution.full_name','gram_sevak_tablet_distribution.id',
				'district_user.name as district','taluka_user.name as taluka','village_user.name as village',
                'gram_sevak_tablet_distribution.mobile_number')
				->orderBy('gram_sevak_tablet_distribution.id', 'desc');
        if ($request->filled('districtId')) {
            $query->where('gram_sevak_tablet_distribution.district_id', $districtId);
        }
        if ($request->filled('talukaId')) {
            $query->where('gram_sevak_tablet_distribution.taluka_id', $talukaId);
        }
        if ($request->filled('villageId')) {
            $query->where('gram_sevak_tablet_distribution.village_id', $villageId);
        }
        
          $data_output = $query->get();
		  
          
                return response()->json(['labour_ajax_data' => $data_output]);

    }

    public function getDistributerBenificiaryList(Request $request){
        $district_data = TblArea::where('parent_id', '2')
                    ->orderBy('name', 'asc')
                    ->get(['location_id', 'name']);

        $edit_id=base64_decode($request->edit_id);            

        $all_data = $this->service->getDistributerBenificiaryList($request);
        return view('admin.pages.TabletDistribution.list-distributer-benificary',compact('all_data','district_data','edit_id'));
    }

    public function showDistributiorBenificiaryDetails(Request $request)
    {
        try {
            $data_gram_doc_details = $this->service->showTabletDistribution($request->show_id);
            $showid=base64_encode($request->show_id);
            $editId=base64_encode($request->edit_id);
            return view('admin.pages.TabletDistribution.show-distributer-baneficiary-details', compact('data_gram_doc_details','showid','editId'));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getFilterTabletDistributionAll(Request $request)
    {
       $districtId = $request->input('districtId');
        $talukaId = $request->input('talukaId');
        $villageId = $request->input('villageId');

            $query_user = User::where('users.role_id','3')
                ->select('id');
                if ($request->filled('districtId')) {
                    $query_user->where('users.user_district', $districtId);
                }
                if ($request->filled('talukaId')) {
                    $query_user->where('users.user_taluka', $talukaId);
                }
                if ($request->filled('villageId')) {
                    $query_user->where('users.user_village', $villageId);
                }

               $data_user_output=$query_user->get();

        $query = GramSevakTabletDistribution::leftJoin('tbl_area as district_user', 'gram_sevak_tablet_distribution.district_id', '=', 'district_user.location_id')
				->leftJoin('tbl_area as taluka_user', 'gram_sevak_tablet_distribution.taluka_id', '=', 'taluka_user.location_id')
				->leftJoin('tbl_area as village_user', 'gram_sevak_tablet_distribution.village_id', '=', 'village_user.location_id')
				->leftJoin('users', 'gram_sevak_tablet_distribution.user_id', '=', 'users.id')
				->where('gram_sevak_tablet_distribution.is_active','1')
                ->select('gram_sevak_tablet_distribution.full_name','gram_sevak_tablet_distribution.id',
				'district_user.name as district','taluka_user.name as taluka','village_user.name as village',
                'gram_sevak_tablet_distribution.mobile_number')
				->orderBy('gram_sevak_tablet_distribution.id', 'desc');
        if ($request->filled('districtId')) {
            $query->where('gram_sevak_tablet_distribution.district_id', $districtId);
        }
        if ($request->filled('talukaId')) {
            $query->where('gram_sevak_tablet_distribution.taluka_id', $talukaId);
        }
        if ($request->filled('villageId')) {
            $query->where('gram_sevak_tablet_distribution.village_id', $villageId);
        }
        
          $data_output = $query->get();
		  
          
                return response()->json(['labour_ajax_data' => $data_output]);

    }

  
}