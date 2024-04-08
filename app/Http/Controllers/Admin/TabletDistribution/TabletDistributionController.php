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

        $taluka_data=TblArea::where('parent_id', $sess_user_working_dist)
                    ->orderBy('name', 'asc')
                    ->get(['location_id', 'name']);

    
                
        $gramsevaks = $this->service->index();
        return view('admin.pages.TabletDistribution.list-tablet-distribution',compact('gramsevaks','district_data','taluka_data'));
    }

    public function showTabletDistribution(Request $request)
    {
        try {


            $data_gram_doc_details = $this->service->showTabletDistribution($request->show_id);
            return view('admin.pages.gramsevak.show-gramsevak-doc', compact('data_gram_doc_details'));
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function updateGramDocumentStatus(Request $request){
        // $rules = [
        //     'is_approved' => 'required',
        //  ];       

        // $messages = [   
        //                 'is_approved.required' => 'Please enter email.',
        //                 // 'email.email' => 'Please enter valid email.',
        //                 // 'u_uname.required' => 'Please enter user uname.',
        //                 // 'password.required' => 'Please enter password.',
        //             ];


        try {
            
                $register_user = $this->service->updateGramDocumentStatus($request);
                if($register_user)
                {

                    $sess_user_id=session()->get('user_id');
                    $sess_user_type=session()->get('user_type');
                    $sess_user_role=session()->get('role_id');

                if($request->is_approved=='3' && $request['other_remark']!='')
                {    
                $history = new HistoryDocumentModel();
                $history->user_id = $sess_user_id; 
                $history->roles_id = $sess_user_role; 
                $history->gram_document_id = $request->edit_id;
                $history->is_approved = $request->is_approved;
                $history->reason_doc_id = $request->reason_doc_id; 
                $history->other_remark = $request->other_remark; 
                $history->save();
                }else if($request->is_approved=='3' && $request['other_remark']=='')
                {    
                    // Create a history record
                $history = new HistoryDocumentModel();
                $history->user_id = $sess_user_id; 
                $history->roles_id = $sess_user_role; 
                $history->gram_document_id = $request->edit_id;
                $history->is_approved = $request->is_approved;
                $history->reason_doc_id = $request->reason_doc_id; 
                $history->save();
                }
    
                $showId=$request->show_id;
                // dd($showId);
                    $msg = $register_user['msg'];
                    $status = $register_user['status'];
                    if($status=='success') {
                        // $user_doc_data = GramPanchayatDocuments::leftJoin('documenttype', 'documenttype.id', '=', 'tbl_gram_panchayat_documents.document_type_id')
                        // ->where('tbl_gram_panchayat_documents.user_id', $showId)
                        //     ->select('tbl_gram_panchayat_documents.id',
                        //     'tbl_gram_panchayat_documents.user_id',
                        //     'tbl_gram_panchayat_documents.document_type_id',
                        //     'tbl_gram_panchayat_documents.document_name',
                        //     'tbl_gram_panchayat_documents.document_pdf',
                        //     'tbl_gram_panchayat_documents.is_active',
                        //     'documenttype.document_type_name',
                        //     'tbl_gram_panchayat_documents.is_approved',
                        //     'tbl_gram_panchayat_documents.is_resubmitted',
                        //     'tbl_gram_panchayat_documents.reason_doc_id',
                        //     'tbl_gram_panchayat_documents.other_remark',
                        //     )
                        //     ->get();
                        //     return response()->json(['labour_attendance_ajax_data' => $user_doc_data]);

                        return true;
                    }
                    else {
                        return false;
                    }
                }
                
            // }

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with(['msg' => $e->getMessage(), 'status' => 'error']);
        }

    }

    public function ListGrampanchayatDocuments()
    {
        try {

            $dynamic_registrationstatus = Registrationstatus::where('is_active', 1)
            ->where('id', '!=', 1)
            ->select('id','status_name')
            ->get()
            ->toArray();

            $dynamic_reasons = DocumentReasons::where('is_active', 1)
            ->select('id','reason_name')
            ->get()
            ->toArray();
            $data_gram_doc_details = $this->service->ListGrampanchayatDocuments();
            return view('admin.pages.gramsevak.list-grampanchayat-doc', compact('data_gram_doc_details','dynamic_registrationstatus','dynamic_reasons'));
        } catch (\Exception $e) {
            return $e;
        }
    }


  
   

   
}