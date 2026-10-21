<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InstitutionRequest;
use App\Models\Institucion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InstitutionController extends Controller
{
    public function index(): View
    {
        $instituciones = Institucion::query()->orderBy('nombre')->paginate(15);

        return view('admin.institutions.index', compact('instituciones'));
    }

    public function create(): View
    {
        return view('admin.institutions.create');
    }

    public function store(InstitutionRequest $request): RedirectResponse
    {
        Institucion::query()->create($request->validated());

        return redirect()->route('admin.institutions.index')->with('success', 'Institución registrada correctamente.');
    }

    public function show(Institucion $institution): View
    {
        return view('admin.institutions.show', compact('institution'));
    }

    public function edit(Institucion $institution): View
    {
        return view('admin.institutions.edit', compact('institution'));
    }

    public function update(InstitutionRequest $request, Institucion $institution): RedirectResponse
    {
        $institution->update($request->validated());

        return redirect()->route('admin.institutions.index')->with('success', 'Institución actualizada correctamente.');
    }

    public function destroy(Institucion $institution): RedirectResponse
    {
        $institution->delete();

        return redirect()->route('admin.institutions.index')->with('success', 'Institución eliminada correctamente.');
    }

    public function pdf()
    {
        $instituciones = Institucion::query()->orderBy('nombre')->get();

        return Pdf::loadView('pdf.institutions', compact('instituciones'))
            ->setPaper('letter', 'landscape')
            ->download('instituciones.pdf');
    }
}
