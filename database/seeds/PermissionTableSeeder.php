<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $permissions = [

            'Invoices',
            'All Invoices',
            'Paid Invoices',
            'Partially-Paid Invoices',
            'Non-Paid Invoices',
            'Invoices Archieve',
            'Reports',
            'Invoices Reports',
            'Clients Reports',
            'Users',
            'All Users',
            'Users Permissions',

            'Settings',
            'Products',
            'Sections',

            'Add Invoice',
            'Delete Invoice',
            'Export Excel',
            'Change Payment Status',
            'Edit Invoice',
            'Archive Invoice',
            'Print Invoice',
            'Add Attachment',
            'Delete Attachment',

            'Add User',
            'Edit User',
            'Delete User',

            'Show Permission',
            'Add Permission',
            'Edit Permission',
            'Delete Permission',

            'Add Product',
            'Edit Product',
            'Delete Product',

            'Add Section',
            'Edit Section',
            'Delete Section',
            'Notifications',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
