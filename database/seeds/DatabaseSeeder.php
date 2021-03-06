<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Code_CategoriesTableSeeder::class);
        $this->call(CodesTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PrivilegesTableSeeder::class);
        $this->call(DepartmentTreesTableSeeder::class);
        $this->call(PrivilegeRoleMapsTableSeeder::class);
    }
}
