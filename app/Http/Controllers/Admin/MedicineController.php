<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MedicineController as BaseMedicineController;

class MedicineController extends BaseMedicineController
{
    protected string $viewPrefix = 'admin.medicines';

    protected string $routePrefix = 'admin.medicines';
}
