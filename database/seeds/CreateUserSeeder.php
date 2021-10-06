<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
class CreateUserSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $user = User::create([
            'name' => 'Manar Mohammed',
            'email' => 'manor.moh6@gmail.com',
            'password' => Hash::make('adminasd123@@'),
            'roles_name' => ["Owner"],
            'status' => 'Active'
        ]);

        $role = Role::create(['name' => 'Owner']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
