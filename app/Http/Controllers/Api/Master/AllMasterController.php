<?php
namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\ {
	Gender,
    Maritalstatus,
    Skills,
    RelationModel,
    Documenttype,
    Registrationstatus,
    Reasons,
    DocumentReasons,
    TblArea
};

class AllMasterController extends Controller
    {
    public function getAllMasters(){
        try {
            $data = [];
            $data['gender'] = Gender::where('is_active', true)->orderBy('id', 'asc')->get();
            $data['maritalstatus'] = Maritalstatus::where('is_active', true)->orderBy('id', 'asc')->get();
            $data['skills'] = Skills::where('is_active', true)->orderBy('id', 'asc')->get();
            $data['relation'] = RelationModel::where('is_active', true)->orderBy('id', 'asc')->get();
            $data['documenttype'] = Documenttype::where('is_active', true)->orderBy('id', 'asc')->get();
            $data['registrationstatus'] = Registrationstatus::where('is_active', true)
            ->whereNotIn('id', [1])
            ->orderBy('id', 'asc')->get();
            $data['reasons'] = Reasons::where('is_active', true)->orderBy('id', 'asc')->get();
            $data['documentreasons'] = DocumentReasons::where('is_active', true)->orderBy('id', 'asc')->get();
            return response()->json(['status' => 'success', 'message' => 'All data retrieved successfully', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function getAllMastersUpdated(){
        try {
            $areas =  TblArea::where(['is_new'=> '1'])->get();

            foreach ($areas as $data) {
                'is_visible' => (string) $area->is_visible,
                'location_id' => (string) $area->location_id,
                'location_type' => (string) $area->location_type,
                'parent_id' => (string) $area->parent_id,
                'is_new' => (string) $area->is_new,
                $data->is_active = $data->is_active ? "1" : "0";
            }
            
            return response()->json(['status' => 'success', 'message' => 'All data retrieved successfully', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

}


