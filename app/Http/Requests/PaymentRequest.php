<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can adjust this logic as per your authentication needs
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1',
            // 'transaction_id' => 'required|string|unique:payments,transaction_id',
            // 'status' => 'required|string|in:pending,completed,failed',
            // 'currency' => 'required|string|max:3',
            // 'payment_type' => 'required|string',
            // 'payment_method' => 'required|string',
            // 'payment_to' => 'required|string',
            // 'payment_from' => 'required|string',
            // 'payment_for' => 'required|string',
            // 'expense_type' => 'nullable|string',
            // 'remarks' => 'nullable|string',
            // 'payment_date' => 'required|date',
        ];
    }
}
