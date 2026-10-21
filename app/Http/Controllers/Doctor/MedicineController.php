<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\MedicineController as BaseMedicineController;

class MedicineController extends BaseMedicineController
{
    protected string $viewPrefix = 'doctor.medicines';

    protected string $routePrefix = 'doctor.medicines';
}
