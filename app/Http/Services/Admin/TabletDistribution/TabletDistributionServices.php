<?php
namespace App\Http\Services\Admin\TabletDistribution;

use App\Http\Repository\Admin\TabletDistribution\TabletDistributionRepository;


use App\Models\
{ 
    User,
    Labour 
};
use Carbon\Carbon;
use Config;
use Storage;

class TabletDistributionServices
{

	protected $repo;

    /**
     * TopicService constructor.
     */
    public function __construct() {
        $this->repo = new TabletDistributionRepository();
    }

    public function index() {
        $data_gramsevaks = $this->repo->index();
        return $data_gramsevaks;
    }

    public function showTabletDistribution($id){
        try {
            return $this->repo->showTabletDistribution($id);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateGramDocumentStatus($request) {
        $user_register_id = $this->repo->updateGramDocumentStatus($request);
        return ['status'=>'success','msg'=>'Data Updated Successful.'];
    }

    public function ListGrampanchayatDocuments(){
        try {
            return $this->repo->ListGrampanchayatDocuments();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getDistributerBenificiaryList($request) {
        $all_data = $this->repo->getDistributerBenificiaryList($request);
        return $all_data;
    }


}