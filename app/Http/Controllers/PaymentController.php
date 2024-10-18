<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->page : 1;
        $limit = $request->has('limit') ? $request->limit : 10;
        $payments = Payment::orderBy('created_at', 'desc')->forPage($page, $limit)->get();
        return response()->json([
            "message" => "success",
            "data" => $payments,
            "limit" => $limit,
            "page" => $page,
            "total" => $payments->count()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $user_details = Auth::user();
        $user_id = $user_details->id;
        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->amount = $request->amount;
        $payment->transaction_id = $request->has('transaction_id') ? $request->transaction_id : 'NA';
        $payment->status = $request->has('status') ? $request->status : 'pending';
        $payment->currency = $request->has('currency') ? $request->currency : 'INR';
        $payment->payment_type = $request->has('payment_type') ? $request->payment_type : '';
        $payment->payment_method = $request->has('payment_method') ? $request->payment_method : '';
        $payment->payment_to = $request->has('payment_to') ? $request->payment_to : '';
        $payment->payment_from = $request->has('payment_from') ? $request->payment_from : '';
        $payment->payment_for = $request->has('payment_for') ? $request->payment_for : '';
        $payment->expense_type = $request->has('expense_type') ? $request->expense_type : '';
        $payment->remarks = $request->has('remarks') ? $request->remarks : '';
        $payment->payment_date = $request->has('payment_date') ? $request->payment_date : Carbon::today();
        $payment->created_at = Carbon::now();
        $payment->updated_at = Carbon::now();
        $response = $payment->save();
        if ($response) {
            return response()->json(['message' => 'Payment created successfully', 'data' => $payment], 201);
        } else {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function getTotalPayment(Request $request)
    {
        $total_type = $request->has('total_type') ? $request->total_type : '';
        if (empty($total_type)) {
            return response()->json(['message' => 'total type is required'], 400);
        }
        if ($total_type == 'today') {
            $today_date = Carbon::today();
            $total = Payment::whereDate('payment_date', $today_date)->sum('amount');
            return response()->json(['message' => 'success', 'total' => $total], 200);
        }
    }
}
