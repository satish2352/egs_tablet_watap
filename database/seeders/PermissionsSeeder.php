<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permissions;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Dashboard',
                    'url' => 'dashboard',
                    'permission_name' => 'Dashboard',
                ]);Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Gender',
                    'url' => 'list-gender',
                    'permission_name' => 'Gender',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Role',
                    'url' => 'list-role',
                    'permission_name' => 'Role',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Document Types',
                    'url' => 'list-documenttype',
                    'permission_name' => 'Document Types',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Distributor',
                    'url' => 'list-users',
                    'permission_name' => 'Distributor',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Beneficiary',
                    'url' => 'list-gramsevak-tablet-distribution',
                    'permission_name' => 'Beneficiary',
                ]);              
    }
}
