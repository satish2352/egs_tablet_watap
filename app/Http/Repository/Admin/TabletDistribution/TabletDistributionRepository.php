<?php
namespace App\Http\Repository\Admin\TabletDistribution;

use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Carbon;
use Session;
use App\Models\{
	User,
	Permissions,
	RolesPermissions,
	Roles,
	GramSevakTabletDistribution
};
use Illuminate\Support\Facades\Mail;

class TabletDistributionRepository
{

	public function index() {

		$data_users = GramSevakTabletDistribution::leftJoin('tbl_area as district_user', 'gram_sevak_tablet_distribution.district_id', '=', 'district_user.location_id')
				->leftJoin('tbl_area as taluka_user', 'gram_sevak_tablet_distribution.taluka_id', '=', 'taluka_user.location_id')
				->leftJoin('tbl_area as village_user', 'gram_sevak_tablet_distribution.village_id', '=', 'village_user.location_id')
				->leftJoin('users', 'gram_sevak_tablet_distribution.user_id', '=', 'users.id')
				->where('gram_sevak_tablet_distribution.is_active','1')
				->select('gram_sevak_tablet_distribution.full_name','gram_sevak_tablet_distribution.id as ben_id','users.id','users.f_name','users.m_name','users.l_name',
				'district_user.name as district','taluka_user.name as taluka','village_user.name as village','gram_sevak_tablet_distribution.mobile_number',
				'gram_sevak_tablet_distribution.gram_panchayat_name','gram_sevak_tablet_distribution.village_id as vid')
				->get();
// dd($data_users);
		$sess_user_id=session()->get('user_id');
		$sess_user_type=session()->get('user_type');
		$sess_user_role=session()->get('role_id');
		return $data_users;
	}

	public function showTabletDistribution($id)
	{
		$data_gram_doc=[];
		try {

			$data_gram_doc['user_data'] = GramSevakTabletDistribution::leftJoin('tbl_area as district_user', 'gram_sevak_tablet_distribution.district_id', '=', 'district_user.location_id')
				->leftJoin('tbl_area as taluka_user', 'gram_sevak_tablet_distribution.taluka_id', '=', 'taluka_user.location_id')
				->leftJoin('tbl_area as village_user', 'gram_sevak_tablet_distribution.village_id', '=', 'village_user.location_id')
				->leftJoin('users', 'gram_sevak_tablet_distribution.user_id', '=', 'users.id')
				->where('gram_sevak_tablet_distribution.id',$id)
				->where('gram_sevak_tablet_distribution.is_active','1')
				->select('gram_sevak_tablet_distribution.full_name','users.id','users.f_name','users.m_name','users.l_name',
				'district_user.name as district','taluka_user.name as taluka','village_user.name as village',
				'gram_sevak_tablet_distribution.adhar_card_number','gram_sevak_tablet_distribution.gram_panchayat_name',
				'gram_sevak_tablet_distribution.mobile_number','gram_sevak_tablet_distribution.latitude',
				'gram_sevak_tablet_distribution.longitude','gram_sevak_tablet_distribution.aadhar_image',
				'gram_sevak_tablet_distribution.gram_sevak_id_card_photo',
				'gram_sevak_tablet_distribution.photo_of_beneficiary',
				'gram_sevak_tablet_distribution.photo_of_tablet_imei','gram_sevak_tablet_distribution.village_id as vid',
				'gram_sevak_tablet_distribution.created_at')
				->first();

			if ($data_gram_doc) {
				return $data_gram_doc;
			} else {
				return null;
			}
		} catch (\Exception $e) {
			return [
				'msg' => $e->getMessage(),
				'status' => 'error'
			];
		}
	}


	public function getDistributerBenificiaryList($reuest)
	{

		$data_all = [];

		$data_all['beneficiary_data'] = GramSevakTabletDistribution::leftJoin('tbl_area as district_user', 'gram_sevak_tablet_distribution.district_id', '=', 'district_user.location_id')
				->leftJoin('tbl_area as taluka_user', 'gram_sevak_tablet_distribution.taluka_id', '=', 'taluka_user.location_id')
				->leftJoin('tbl_area as village_user', 'gram_sevak_tablet_distribution.village_id', '=', 'village_user.location_id')
				->leftJoin('users', 'gram_sevak_tablet_distribution.user_id', '=', 'users.id')
				->where('gram_sevak_tablet_distribution.user_id', '=', base64_decode($reuest->edit_id))
				->where('gram_sevak_tablet_distribution.is_active','1')
				->select('gram_sevak_tablet_distribution.full_name','gram_sevak_tablet_distribution.id as ben_id','users.id','users.f_name','users.m_name','users.l_name',
				'district_user.name as district','taluka_user.name as taluka','village_user.name as village',
				'gram_sevak_tablet_distribution.adhar_card_number','gram_sevak_tablet_distribution.gram_panchayat_name',
				'gram_sevak_tablet_distribution.mobile_number','gram_sevak_tablet_distribution.latitude',
				'gram_sevak_tablet_distribution.longitude','gram_sevak_tablet_distribution.aadhar_image',
				'gram_sevak_tablet_distribution.gram_sevak_id_card_photo',
				'gram_sevak_tablet_distribution.photo_of_beneficiary',
				'gram_sevak_tablet_distribution.created_at','gram_sevak_tablet_distribution.village_id as vid')
				->orderBy('gram_sevak_tablet_distribution.id', 'desc')
				->get()
				->toArray();

			$data_all['count'] = count($data_all['beneficiary_data']);

			$data_all['distributer_data'] = User::where('users.id', '=', base64_decode($reuest->edit_id))
				->select(
					'users.f_name',
					'users.m_name',
					'users.l_name'
				)->first();
		$all_data = $data_all;


		return $all_data;
	}

}