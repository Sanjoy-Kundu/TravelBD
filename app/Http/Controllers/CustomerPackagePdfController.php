<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CustomerPackagePdfController extends Controller
{
    public function customerPackageGeneratePackagePdf($id)
    {
        // ✅ Customer এর সাথে Package এবং Category রিলেশনসহ ডাটা আনা
        $packageData = Customer::with(['packageCategory', 'package'])
            ->findOrFail($id);

        // ✅ View থেকে PDF তৈরি করা
        $pdf = Pdf::loadView('pdfs.customer.package_detail', compact('packageData'));

        // ✅ PDF ব্রাউজারে show করবে (stream) — চাইলে download এও করতে পারো
        return $pdf->stream("package_{$id}.pdf");

        // Download করতে চাইলে নিচের লাইন use করো:
        // return $pdf->download("package_{$id}.pdf");
    }
}
