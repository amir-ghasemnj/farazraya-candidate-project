<?php

namespace App\Http\Requests\Room;

use App\Http\Requests\Traits\WithFailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoomReserveRequest extends FormRequest
{
    use WithFailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => 'required|integer|min:1|exists:rooms,id',
            'capacity' => 'required|integer|min:1',
        ];
    }
}
