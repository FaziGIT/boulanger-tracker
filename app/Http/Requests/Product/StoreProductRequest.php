<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'url' => [
                'required',
                'url',
                'regex:#^https://www\.boulanger\.com(?!.*https://www\.boulanger\.com)#i',
                Rule::unique('products', 'url')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            'frequency' => [Rule::in(array_keys(Product::arrayFrequencies))]
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'url.required' => 'Le champ URL est obligatoire.',
            'url.url' => 'Le champ URL doit être une URL valide.',
            'url.regex' => 'L\'URL doit commencer par https://www.boulanger.com.',
            'url.unique' => 'Vous avez déjà ajouté ce produit.',
            'frequency.in' => 'La fréquence doit être l\'une des valeurs suivantes : ' . implode(', ', array_keys(Product::arrayFrequencies)) . '.',
        ];
    }
}
