<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
// use App\Models\User;
use App\Models\ {
    Roles,
    Permissions,
    TblArea,
    User,
    GramSevakTabletDistribution
};

class DistributerBenificiaryExport implements FromCollection, WithHeadings,ShouldAutoSize
// class UsersExportFilter implements FromCollection,ShouldAutoSize
{
    use Exportable;
    protected $register_user;

    protected $data_output;

    public function __construct($request)
    {
        // dd($request);
        $districtId = $request->input('dist_new_id');
        $talukaId = $request->input('tal_new_id');
        $villageId = $request->input('vil_new_id');
        $DistributerId = $request->input('distributer_id');

            $query_user = User::where('users.role_id','3')
                ->select('id');
                if (!empty($districtId)) {
                    $query_user->where('users.user_district', $districtId);
                }
                if (!empty($districtId)) {

                    $query_user->where('users.user_taluka', $talukaId);
                }
                if (!empty($districtId)) {
                    $query_user->where('users.user_village', $villageId);
                }

               $data_user_output=$query_user->get();

        $query = GramSevakTabletDistribution::leftJoin('tbl_area as district_user', 'gram_sevak_tablet_distribution.district_id', '=', 'district_user.location_id')
        ->leftJoin('tbl_area as taluka_user', 'gram_sevak_tablet_distribution.taluka_id', '=', 'taluka_user.location_id')
        ->leftJoin('tbl_area as village_user', 'gram_sevak_tablet_distribution.village_id', '=', 'village_user.location_id')
        ->leftJoin('users', 'gram_sevak_tablet_distribution.user_id', '=', 'users.id')
        ->where('gram_sevak_tablet_distribution.user_id', '=', $DistributerId)
        ->where('gram_sevak_tablet_distribution.is_active','1')
        ->select('gram_sevak_tablet_distribution.full_name','users.f_name','users.m_name','users.l_name',
                'district_user.name as district','taluka_user.name as taluka','village_user.name as village',
                'gram_sevak_tablet_distribution.adhar_card_number','gram_sevak_tablet_distribution.gram_panchayat_name',
                'gram_sevak_tablet_distribution.mobile_number','gram_sevak_tablet_distribution.latitude',
                'gram_sevak_tablet_distribution.longitude',
                'gram_sevak_tablet_distribution.created_at')
        ->orderBy('gram_sevak_tablet_distribution.id', 'desc');
        if ($request->filled('dist_new_id')) {
            // dd('dist');
            $query->where('gram_sevak_tablet_distribution.district_id', $districtId);
        }
        if ($request->filled('tal_new_id')) {
            // dd('tal');
            $query->where('gram_sevak_tablet_distribution.taluka_id', $talukaId);
        }
        if ($request->filled('vil_new_id')) {
            // dd('vil');
            $query->where('gram_sevak_tablet_distribution.village_id', $villageId);
        }
        
        //   $data_output = 
        $this->data_output = $query->get();
    }

    public function collection()
    {
        // return $this->data_output;

        $data = $this->data_output->map(function ($item) {
            $fullName = $item->f_name . ' ' . $item->m_name . ' ' . $item->l_name;
            $item->fullName = $fullName;
            unset($item->f_name);
            unset($item->m_name);
            unset($item->l_name);
            return [
                'Distributer Name' => $fullName,
                'Gramsevak Name' => $item->full_name,
                'District' => $item->district,
                'Taluka' => $item->taluka,
                'Village' => $item->village,
                'Aadhar Number' => $item->adhar_card_number,
                'Grampanchayat Name' => $item->gram_panchayat_name,
                'Mobile Number' => $item->mobile_number,
                'Latitude' => $item->latitude,
                'Longitude' => $item->longitude,
                'Created Date' => $item->created_at,
            ];
        });
    
        return $data;
    }

    public function headings(): array
    {
        return [
            'Distributer Name',
            'Gramsevak Name',
            'District',
            'Taluka',
            'Village',
            'Aadhar',
            'Grampanchayat Name',
            'Mobile Number',
            'Latitude',
            'Longitude',
            'Created Date',
        ];
    }
}
