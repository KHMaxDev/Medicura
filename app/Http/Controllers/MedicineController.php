<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\Medicamento;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

abstract class MedicineController extends Controller
{
    protected string $viewPrefix;

    protected string $routePrefix;

    public function index(): View
    {
        $medicamentos = Medicamento::query()->orderBy('nombre')->paginate(15);

        return view("{$this->viewPrefix}.index", compact('medicamentos'));
    }

    public function create(): View
    {
        return view("{$this->viewPrefix}.create");
    }

    public function store(MedicineRequest $request): RedirectResponse
    {
        Medicamento::query()->create($request->validated());

        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Medicamento registrado correctamente.');
    }

    public function show(Medicamento $medicine): View
    {
        return view("{$this->viewPrefix}.show", compact('medicine'));
    }

    public function edit(Medicamento $medicine): View
    {
        return view("{$this->viewPrefix}.edit", compact('medicine'));
    }

    public function update(MedicineRequest $request, Medicamento $medicine): RedirectResponse
    {
        $medicine->update($request->validated());

        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicamento $medicine): RedirectResponse
    {
        $medicine->delete();

        return redirect()->route("{$this->routePrefix}.index")->with('success', 'Medicamento eliminado correctamente.');
    }
}
