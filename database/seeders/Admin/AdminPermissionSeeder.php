<?php

namespace Database\Seeders\Admin;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arr = [
            'name' => 'admin_access',
        ];

        if (Schema::hasColumn('permissions', 'user_id')) {
            $arr['user_id'] = User::first()->id;
        }
        if (Schema::hasColumn('permissions', 'status_id')) {
            $arr['status_id'] = activeStatusId();
        }

        Permission::updateOrCreate(['name' => $arr['name']], $arr);
    }
}
