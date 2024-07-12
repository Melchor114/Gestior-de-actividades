<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTareaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255|unique:tareas,nombre',
            'descripcion' => 'nullable|string|max:500',
            'fecha' => 'required|date',
            'hora' => 'nullable|date_format:H:i',
            'prioridad' => 'required|numeric|between:0.0,10.0',
        ];
    }
}
