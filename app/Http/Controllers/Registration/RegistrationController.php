<?php

namespace App\Http\Controllers\Registration;

use App\Domains\Registration\Services\RegistrationService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Registration\RegistrationRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;

class RegistrationController extends AbstractController
{
    protected $requestValidate = RegistrationRequest::class;

    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
    }

    public function term($id)
    {
        $registration = $this->service->find($id);
        if (! $registration) {
            return $this->sendError('Registro não encontrado.', 404);
        }

        $user = $registration->user;
        $animal = $registration->animal;

        if (! $user || ! $animal) {
            return $this->sendError('Dados incompletos para gerar o termo.', 400);
        }

        $data = [
            'name' => $user->name ?? 'N/A',
            'cpf' => $user->document ?? 'N/A',
            'cellphone' => $user->cellphone ?? $user->telephone ?? 'N/A',
            'address' => $user->address->street ?? 'N/A',
            'animal_name' => $animal->name ?? 'N/A',
            'animal_species' => Arr::get($animal->species, 'label', 'N/A'),
            'animal_sex' => Arr::get($animal->gender, 'label', 'N/A'),
            'animal_size' => Arr::get($animal->size, 'label', 'N/A'),
            'animal_birthdate' => $animal->birth_date ? $animal->birth_date->format('d/m/Y') : 'N/A',
            'animal_color' => $animal->color ?? 'N/A',
        ];

        logger()->info('Generating PDF with data: ', $data);

        $pdf = Pdf::loadView('pdf.term-castra-mobile', $data);

        $output = $pdf->output();

        return Response::make($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="relatorio.pdf"',
        ]);
    }
}
