<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list answers']);
        Permission::create(['name' => 'view answers']);
        Permission::create(['name' => 'create answers']);
        Permission::create(['name' => 'update answers']);
        Permission::create(['name' => 'delete answers']);

        Permission::create(['name' => 'list awards']);
        Permission::create(['name' => 'view awards']);
        Permission::create(['name' => 'create awards']);
        Permission::create(['name' => 'update awards']);
        Permission::create(['name' => 'delete awards']);

        Permission::create(['name' => 'list bloodtypes']);
        Permission::create(['name' => 'view bloodtypes']);
        Permission::create(['name' => 'create bloodtypes']);
        Permission::create(['name' => 'update bloodtypes']);
        Permission::create(['name' => 'delete bloodtypes']);

        Permission::create(['name' => 'list bumnclasses']);
        Permission::create(['name' => 'view bumnclasses']);
        Permission::create(['name' => 'create bumnclasses']);
        Permission::create(['name' => 'update bumnclasses']);
        Permission::create(['name' => 'delete bumnclasses']);

        Permission::create(['name' => 'list bumnsectors']);
        Permission::create(['name' => 'view bumnsectors']);
        Permission::create(['name' => 'create bumnsectors']);
        Permission::create(['name' => 'update bumnsectors']);
        Permission::create(['name' => 'delete bumnsectors']);

        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list categorylearns']);
        Permission::create(['name' => 'view categorylearns']);
        Permission::create(['name' => 'create categorylearns']);
        Permission::create(['name' => 'update categorylearns']);
        Permission::create(['name' => 'delete categorylearns']);

        Permission::create(['name' => 'list cities']);
        Permission::create(['name' => 'view cities']);
        Permission::create(['name' => 'create cities']);
        Permission::create(['name' => 'update cities']);
        Permission::create(['name' => 'delete cities']);

        Permission::create(['name' => 'list coupons']);
        Permission::create(['name' => 'view coupons']);
        Permission::create(['name' => 'create coupons']);
        Permission::create(['name' => 'update coupons']);
        Permission::create(['name' => 'delete coupons']);

        Permission::create(['name' => 'list divisions']);
        Permission::create(['name' => 'view divisions']);
        Permission::create(['name' => 'create divisions']);
        Permission::create(['name' => 'update divisions']);
        Permission::create(['name' => 'delete divisions']);

        Permission::create(['name' => 'list educations']);
        Permission::create(['name' => 'view educations']);
        Permission::create(['name' => 'create educations']);
        Permission::create(['name' => 'update educations']);
        Permission::create(['name' => 'delete educations']);

        Permission::create(['name' => 'list eduhistories']);
        Permission::create(['name' => 'view eduhistories']);
        Permission::create(['name' => 'create eduhistories']);
        Permission::create(['name' => 'update eduhistories']);
        Permission::create(['name' => 'delete eduhistories']);

        Permission::create(['name' => 'list explanations']);
        Permission::create(['name' => 'view explanations']);
        Permission::create(['name' => 'create explanations']);
        Permission::create(['name' => 'update explanations']);
        Permission::create(['name' => 'delete explanations']);

        Permission::create(['name' => 'list exsums']);
        Permission::create(['name' => 'view exsums']);
        Permission::create(['name' => 'create exsums']);
        Permission::create(['name' => 'update exsums']);
        Permission::create(['name' => 'delete exsums']);

        Permission::create(['name' => 'list fieldofpositions']);
        Permission::create(['name' => 'view fieldofpositions']);
        Permission::create(['name' => 'create fieldofpositions']);
        Permission::create(['name' => 'update fieldofpositions']);
        Permission::create(['name' => 'delete fieldofpositions']);

        Permission::create(['name' => 'list genders']);
        Permission::create(['name' => 'view genders']);
        Permission::create(['name' => 'create genders']);
        Permission::create(['name' => 'update genders']);
        Permission::create(['name' => 'delete genders']);

        Permission::create(['name' => 'list interests']);
        Permission::create(['name' => 'view interests']);
        Permission::create(['name' => 'create interests']);
        Permission::create(['name' => 'update interests']);
        Permission::create(['name' => 'delete interests']);

        Permission::create(['name' => 'list jurnals']);
        Permission::create(['name' => 'view jurnals']);
        Permission::create(['name' => 'create jurnals']);
        Permission::create(['name' => 'update jurnals']);
        Permission::create(['name' => 'delete jurnals']);

        Permission::create(['name' => 'list kids']);
        Permission::create(['name' => 'view kids']);
        Permission::create(['name' => 'create kids']);
        Permission::create(['name' => 'update kids']);
        Permission::create(['name' => 'delete kids']);

        Permission::create(['name' => 'list knowledges']);
        Permission::create(['name' => 'view knowledges']);
        Permission::create(['name' => 'create knowledges']);
        Permission::create(['name' => 'update knowledges']);
        Permission::create(['name' => 'delete knowledges']);

        Permission::create(['name' => 'list learnings']);
        Permission::create(['name' => 'view learnings']);
        Permission::create(['name' => 'create learnings']);
        Permission::create(['name' => 'update learnings']);
        Permission::create(['name' => 'delete learnings']);

        Permission::create(['name' => 'list lpayments']);
        Permission::create(['name' => 'view lpayments']);
        Permission::create(['name' => 'create lpayments']);
        Permission::create(['name' => 'update lpayments']);
        Permission::create(['name' => 'delete lpayments']);

        Permission::create(['name' => 'list ltransactions']);
        Permission::create(['name' => 'view ltransactions']);
        Permission::create(['name' => 'create ltransactions']);
        Permission::create(['name' => 'update ltransactions']);
        Permission::create(['name' => 'delete ltransactions']);

        Permission::create(['name' => 'list maritals']);
        Permission::create(['name' => 'view maritals']);
        Permission::create(['name' => 'create maritals']);
        Permission::create(['name' => 'update maritals']);
        Permission::create(['name' => 'delete maritals']);

        Permission::create(['name' => 'list modules']);
        Permission::create(['name' => 'view modules']);
        Permission::create(['name' => 'create modules']);
        Permission::create(['name' => 'update modules']);
        Permission::create(['name' => 'delete modules']);

        Permission::create(['name' => 'list organizations']);
        Permission::create(['name' => 'view organizations']);
        Permission::create(['name' => 'create organizations']);
        Permission::create(['name' => 'update organizations']);
        Permission::create(['name' => 'delete organizations']);

        Permission::create(['name' => 'list positions']);
        Permission::create(['name' => 'view positions']);
        Permission::create(['name' => 'create positions']);
        Permission::create(['name' => 'update positions']);
        Permission::create(['name' => 'delete positions']);

        Permission::create(['name' => 'list questions']);
        Permission::create(['name' => 'view questions']);
        Permission::create(['name' => 'create questions']);
        Permission::create(['name' => 'update questions']);
        Permission::create(['name' => 'delete questions']);

        Permission::create(['name' => 'list quizzes']);
        Permission::create(['name' => 'view quizzes']);
        Permission::create(['name' => 'create quizzes']);
        Permission::create(['name' => 'update quizzes']);
        Permission::create(['name' => 'delete quizzes']);

        Permission::create(['name' => 'list religions']);
        Permission::create(['name' => 'view religions']);
        Permission::create(['name' => 'create religions']);
        Permission::create(['name' => 'update religions']);
        Permission::create(['name' => 'delete religions']);

        Permission::create(['name' => 'list reports']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'create reports']);
        Permission::create(['name' => 'update reports']);
        Permission::create(['name' => 'delete reports']);

        Permission::create(['name' => 'list reqknowledges']);
        Permission::create(['name' => 'view reqknowledges']);
        Permission::create(['name' => 'create reqknowledges']);
        Permission::create(['name' => 'update reqknowledges']);
        Permission::create(['name' => 'delete reqknowledges']);

        Permission::create(['name' => 'list reqknowstats']);
        Permission::create(['name' => 'view reqknowstats']);
        Permission::create(['name' => 'create reqknowstats']);
        Permission::create(['name' => 'update reqknowstats']);
        Permission::create(['name' => 'delete reqknowstats']);

        Permission::create(['name' => 'list sections']);
        Permission::create(['name' => 'view sections']);
        Permission::create(['name' => 'create sections']);
        Permission::create(['name' => 'update sections']);
        Permission::create(['name' => 'delete sections']);

        Permission::create(['name' => 'list socials']);
        Permission::create(['name' => 'view socials']);
        Permission::create(['name' => 'create socials']);
        Permission::create(['name' => 'update socials']);
        Permission::create(['name' => 'delete socials']);

        Permission::create(['name' => 'list speakers']);
        Permission::create(['name' => 'view speakers']);
        Permission::create(['name' => 'create speakers']);
        Permission::create(['name' => 'update speakers']);
        Permission::create(['name' => 'delete speakers']);

        Permission::create(['name' => 'list topics']);
        Permission::create(['name' => 'view topics']);
        Permission::create(['name' => 'create topics']);
        Permission::create(['name' => 'update topics']);
        Permission::create(['name' => 'delete topics']);

        Permission::create(['name' => 'list tribes']);
        Permission::create(['name' => 'view tribes']);
        Permission::create(['name' => 'create tribes']);
        Permission::create(['name' => 'update tribes']);
        Permission::create(['name' => 'delete tribes']);

        Permission::create(['name' => 'list universities']);
        Permission::create(['name' => 'view universities']);
        Permission::create(['name' => 'create universities']);
        Permission::create(['name' => 'update universities']);
        Permission::create(['name' => 'delete universities']);

        Permission::create(['name' => 'list valvisions']);
        Permission::create(['name' => 'view valvisions']);
        Permission::create(['name' => 'create valvisions']);
        Permission::create(['name' => 'update valvisions']);
        Permission::create(['name' => 'delete valvisions']);

        Permission::create(['name' => 'list wifhuses']);
        Permission::create(['name' => 'view wifhuses']);
        Permission::create(['name' => 'create wifhuses']);
        Permission::create(['name' => 'update wifhuses']);
        Permission::create(['name' => 'delete wifhuses']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
