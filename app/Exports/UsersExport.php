<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\User;

class UsersExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    use Exportable;
    protected $register_user;

    public function collection()
    {
        $this->register_user = User::where('users.role_id', '<>', '1')
            ->select(
                'id',
                'email',
                'f_name',
                'm_name',
                'l_name',
                'number',
                'aadhar_no',
                'address',
                'district',
                'taluka',
                'village',
                'pincode',
                'is_active'
            )
            ->orderBy('id', 'desc')
            ->get();
// dd($this->register_user);
        return $this->register_user;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Email',
            'First Name',
            'Middle Name',
            'Last Name',
            'Number',
            'Aadhar Number',
            'Address',
            'District',
            'Taluka',
            'Village',
            'Pincode',
            'Active',
        ];
    }
}
