<?php
namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Link;
use App\Models\ModelPermission;
use App\Models\ModelRole;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class InstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = (new Admin);
        $Admin->setName('Admin');
        $Admin->setEmail('admin@admin.com');
        $Admin->setPassword('123456');
        $Admin->save();
        $Role = new Role();
        $Role->setName('Admin');
        $Role->setNameAr('مدير');
        $Role->save();
        $Role->refresh();
        $PermissionsAndLinks = [
            'AppManagement'=>[
                'name'=>'App Management',
                'name_ar'=>'إدارة التطبيق',
                'key'=>'app_managements',
                'Children'=>[
                    'Admins'=>[
                        'name'=>'Employees',
                        'name_ar'=>'الموظفين',
                        'key'=>'employees',
                        'icon'=>'group'
                    ],
                    'Roles'=>[
                        'name'=>'Roles',
                        'name_ar'=>'الأدوار',
                        'key'=>'roles',
                        'icon'=>'accessibility'
                    ],
                    'Permissions'=>[
                        'name'=>'Permissions',
                        'name_ar'=>'الصلاحيات',
                        'key'=>'permissions',
                        'icon'=>'vpn_key'
                    ],
                ]
            ],
            'AppContent'=>[
                'name'=>'App Content',
                'name_ar'=>'محتوى التطبيق',
                'key'=>'app_content',
                'Children'=>[
                    'Posts'=>[
                        'name'=>'Posts',
                        'name_ar'=>'البوستات',
                        'key'=>'posts',
                        'icon'=>'category'
                    ],
                ]
            ],
            'UsersManagements'=>[
                'name'=>'Users Managements',
                'name_ar'=>'إدارة المستخدمين',
                'key'=>'user_managements',
                'Children'=>[
                    'Users'=>[
                        'name'=>'Users',
                        'name_ar'=>'المستخدمين',
                        'key'=>'users',
                        'icon'=>'group'
                    ],
                ]
            ],
        ];

        foreach ($PermissionsAndLinks as $object){
            $Permission = new Permission();
            $Permission->setName($object['name']);
            $Permission->setNameAr($object['name_ar']);
            $Permission->setKey($object['key']);
            $Permission->save();
            $Permission->refresh();
            $Link = new Link();
            $Link->setName($object['name']);
            $Link->setNameAr($object['name_ar']);
            $Link->setUrl($object['key']);
            $Link->setPermissionId($Permission->getId());
            $Link->save();
            $Link->refresh();
            foreach ($object['Children'] as $child){
                $CPermission = new Permission();
                $CPermission->setName($child['name']);
                $CPermission->setNameAr($child['name_ar']);
                $CPermission->setKey($child['key']);
                $CPermission->setParentId($Permission->getId());
                $CPermission->save();
                $CLink = new Link();
                $CLink->setName($child['name']);
                $CLink->setNameAr($child['name_ar']);
                $CLink->setUrl($child['key']);
                $CLink->setIcon($child['icon']);
                $CLink->setParentId($Link->getId());
                $CLink->setPermissionId($CPermission->getId());
                $CLink->save();
            }
        }
        foreach (Permission::all() as $permission){
            $RolePermission = new RolePermission();
            $RolePermission->setPermissionId($permission->getId());
            $RolePermission->setRoleId($Role->getId());
            $RolePermission->save();
        }
        foreach (Role::all() as $role){
            $ModelRole = new ModelRole();
            $ModelRole->setModelId($Admin->getId());
            $ModelRole->setRoleId($role->getId());
            $ModelRole->save();
        }
        foreach (Permission::all() as $permission){
            $ModelPermission = new ModelPermission();
            $ModelPermission->setModelId($Admin->getId());
            $ModelPermission->setPermissionId($permission->getId());
            $ModelPermission->save();
        }
        Artisan::call('passport:install');
    }
}
