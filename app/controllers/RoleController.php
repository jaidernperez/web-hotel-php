<?php

namespace App\Controllers;

use App\Models\RoleEntity;
use App\Repositories\RoleRepository;

class RoleController
{
    public function showRoles()
    {
        $roleRepository = new RoleRepository();
        return $roleRepository->show();
    }
}