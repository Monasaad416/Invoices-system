<?php
  
namespace Database\Seeders;
  
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
           'invoices',
           'invoices_list',
           'paid_invoices',
           'unpaid_invoices',
           'archived_invoices',
           'reports',
           'invoices_reports',
           'customers_reports',
           'users',
           'users_list',
           'users_permissions',
           'settings',
           'products',
           'sections',
           'add_invoice',
           'edit_invoice',
           'delete_invoice',
           'export_invoice_to_excel',
           'change_status',
           'add_attachment',
           'delete_attachment',
           'add_user',
           'edit_user',
           'delete_user',
           'show_permissions',
           'add_permissions',
           'edit_permissions',
           'delete_permissions',
           'add_section',
           'edit_section',
           'delete_section',
           'add_product',
           'edit_product',
           'delete_product',
           'notifications',

        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}