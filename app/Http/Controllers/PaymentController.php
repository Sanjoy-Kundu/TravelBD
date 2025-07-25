<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
 public function paymentGetwayStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|exists:customers,id',
                'package_id' => 'required|exists:packages,id',
                'total_price' => 'required|numeric|min:0',
                'paid_amount' => 'required|numeric|min:0',
                'payment_method' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $received_by = Auth::id();

            $payment = Payment::where('customer_id', $request->customer_id)
                ->where('package_id', $request->package_id)
                ->whereNull('deleted_at')
                ->first();

            $paidAmountNew = floatval($request->paid_amount);
            $totalPrice = floatval($request->total_price);

            if ($payment) {
                $newPaidAmount = $payment->paid_amount + $paidAmountNew;

                // extra payment ceck 
                if ($newPaidAmount > $totalPrice) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Your outstanding due amount is ৳{{ number_format($payment->due_amount, 2) }}. Therefore, you cannot pay ৳{{ number_format($paidAmountNew, 2) }} at this time.",
                    ], 422);
                }

                $newDueAmount = $totalPrice - $newPaidAmount;
                $newStatus = ($newPaidAmount >= $totalPrice) ? 'paid' : 'partial';

                $payment->update([
                    'paid_amount' => $newPaidAmount,
                    'due_amount' => $newDueAmount > 0 ? $newDueAmount : 0,
                    'payment_method' => $request->payment_method,
                    'payment_date' => now(),
                    'received_by' => $received_by,
                    'status' => $newStatus,
                    'payment_note' => $request->payment_note ?? $payment->payment_note,
                ]);

                // Payment History Insert
                PaymentHistory::create([
                    'payment_id' => $payment->id,
                    'customer_id' => $request->customer_id,
                    'package_id' => $request->package_id,
                    'paid_amount' => $paidAmountNew,
                    'payment_method' => $request->payment_method,
                    'payment_date' => now(),
                    'note' => $request->payment_note ?? null,
                    'received_by' => $received_by,
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Payment updated successfully',
                    'payment' => $payment,
                ]);
            } else {
                // new payment history
                do {
                    $invoice_no = 'INV' . strtoupper(Str::random(6)) . date('YmdHis');
                } while (Payment::where('invoice_no', $invoice_no)->exists());

                $transaction_id = Str::uuid()->toString();
                $dueAmount = $totalPrice - $paidAmountNew;
                $status = ($paidAmountNew >= $totalPrice) ? 'paid' : 'partial';

                $payment = Payment::create([
                    'admin_id' => $received_by,
                    'customer_id' => $request->customer_id,
                    'package_id' => $request->package_id,
                    'transaction_id' => $transaction_id,
                    'invoice_no' => $invoice_no,
                    'total_price' => $totalPrice,
                    'paid_amount' => $paidAmountNew,
                    'due_amount' => $dueAmount > 0 ? $dueAmount : 0,
                    'payment_method' => $request->payment_method,
                    'currency' => 'BDT',
                    'payment_date' => now(),
                    'received_by' => $received_by,
                    'payment_note' => $request->payment_note ?? null,
                    'status' => $status,
                ]);

                // Payment History Insert
                PaymentHistory::create([
                    'payment_id' => $payment->id,
                    'customer_id' => $request->customer_id,
                    'package_id' => $request->package_id,
                    'paid_amount' => $paidAmountNew,
                    'payment_method' => $request->payment_method,
                    'payment_date' => now(),
                    'note' => $request->payment_note ?? null,
                    'received_by' => $received_by,
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Payment recorded successfully',
                    'payment' => $payment,
                    'due_amount' => $payment->due_amount,
                ]);
            }
        } catch (\Exception $e) {
            // 
            // \Log::error('Payment Store Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
}



}
