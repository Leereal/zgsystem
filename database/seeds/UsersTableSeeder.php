<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $adminRole = Role:: where('name','administrator')->first();
        $clientRole = Role:: where('name','client')->first();
        $chairmanRole = Role:: where('name','chairman')->first();
        $claimsRole = Role:: where('name','claims officer')->first();
        $sysAdminRole = Role:: where('name','system admin')->first();

        $admin = User::create([
        	'name'=>'Our Administrator',
        	'email'=>'admin@admin.com',
        	'password'=>bcrypt('admin'),
            'branch_id' => mt_rand(1,5)
        ]);
        $client = User::create([
        	'name'=>'Our Client',
        	'email'=>'client@admin.com',
        	'password'=>bcrypt('admin'),
            'branch_id' => mt_rand(1,5)
        ]);
        $chairman = User::create([
        	'name'=>'Our chairmane',
        	'email'=>'chairman@admin.com',
        	'password'=>bcrypt('admin'),
            'branch_id' => mt_rand(1,5)
        ]);
        $claims = User::create([
        	'name'=>'Our Claims',
        	'email'=>'claims@admin.com',
        	'password'=>bcrypt('admin'),
            'branch_id' => mt_rand(1,5)
        ]);
        $systemAdmin = User::create([
            'name'=>'Our System Admin',
            'email'=>'sysadmin@admin.com',
            'password'=>bcrypt('admin'),
            'branch_id' => mt_rand(1,5)
        ]);
        $Lee = User::create([
            'name'=>'Liberty Mutabvuri',
            'email'=>'leereal08@gmail.com',
            'password'=>bcrypt('mutabvuri'),
            'branch_id' => mt_rand(1,5)
        ]);

        $admin->roles()->attach($adminRole);
        $client->roles()->attach($clientRole);
        $chairman->roles()->attach($chairmanRole);
        $claims->roles()->attach($claimsRole);
 
        factory(User::class,20)->create();
    }
}
