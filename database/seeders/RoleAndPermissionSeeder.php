<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Réinitialisation du cache des rôles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Création des rôles de base du Sprint 1
        Role::create(['name' => 'Administrateur']);
        Role::create(['name' => 'Magasinier']);
        Role::create(['name' => 'Commercial']);
    }
}