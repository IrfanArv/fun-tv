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
            'player-list',
            'player-create',
            'player-edit',
            'player-delete',
            'rooms-list',
            'rooms-create',
            'rooms-edit',
            'rooms-delete',
            'trivia-quiz-list',
            'trivia-quiz-create',
            'trivia-quiz-edit',
            'trivia-quiz-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',

         ];
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
