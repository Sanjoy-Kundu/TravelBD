<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8" />
    <title>Package Details</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; direction: ltr; }
        h1, h2 { color: #004085; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #007bff; color: white; }
        .header { text-align: center; margin-bottom: 40px; }
        .logo { height: 60px; }
        .footer { position: fixed; bottom: 10px; width: 100%; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Company Logo" class="logo" />
        <h1>Package Full Details</h1>
        <p>{{ date('d-M-Y H:i A') }}</p>
    </div>

    <h2>Customer Information</h2>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $packageData->name ?? 'N/A' }}</td>
            <th>Email</th>
            <td>{{ $packageData->email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $packageData->phone ?? 'N/A' }}</td>
            <th>Passport No</th>
            <td>{{ $packageData->passport_no ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Age</th>
            <td>{{ $packageData->age ?? 'N/A' }}</td>
            <th>Gender</th>
            <td>{{ $packageData->gender ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $packageData->date_of_birth ?? 'N/A' }}</td>
            <th>NID Number</th>
            <td>{{ $packageData->nid_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Company Name</th>
            <td>{{ $packageData->company_name ?? 'N/A' }}</td>
            <th>PIC</th>
            <td>{{ $packageData->pic ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Country</th>
            <td colspan="3">{{ $packageData->country ?? 'N/A' }}</td>
        </tr>
    </table>

    <h2>Package Details</h2>
    <table>
        <tr>
            <th>Package Title</th>
            <td>{{ $packageData->package->title ?? 'N/A' }}</td>
            <th>Category</th>
            <td>{{ $packageData->package_category->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Duration</th>
            <td>{{ $packageData->duration ?? 'N/A' }}</td>
            <th>Seat Availability</th>
            <td>{{ $packageData->seat_availability ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ number_format($packageData->price, 2) ?? 'N/A' }}</td>
            <th>Discount</th>
            <td>{{ $packageData->package_discount ?? '0' }}%</td>
        </tr>
        <tr>
            <th>Discounted Price</th>
            <td>{{ number_format($packageData->package_discounted_price, 2) ?? 'N/A' }}</td>
            <th>Passenger Price</th>
            <td>{{ number_format($packageData->passenger_price, 2) ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Coupon Code</th>
            <td>{{ $packageData->coupon_code ?: 'N/A' }}</td>
            <th>Coupon Discount</th>
            <td>{{ $packageData->coupon_discount ?? '0' }}</td>
        </tr>
        <tr>
            <th>After Coupon Price</th>
            <td>{{ number_format($packageData->coupon_use_discounted_price, 2) ?? 'N/A' }}</td>
            <th>MRP</th>
            <td>{{ number_format($packageData->mrp, 2) ?? 'N/A' }}</td>
        </tr>
    </table>

    <h2>Additional Details</h2>
    <table>
        <tr>
            <th>Inclusions</th>
            <td>{{ $packageData->inclusions ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Exclusions</th>
            <td>{{ $packageData->exclusions ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Documents Required</th>
            <td>{{ $packageData->documents_required ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Visa Processing Time</th>
            <td>{{ $packageData->visa_processing_time ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Medical Center</th>
            <td>{{ $packageData->medical_center ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Medical Date</th>
            <td>{{ $packageData->medical_date ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Medical Result</th>
            <td>{{ $packageData->medical_result ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Visa Online Status</th>
            <td>{{ $packageData->visa_online ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Calling Status</th>
            <td>{{ $packageData->calling ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Training Status</th>
            <td>{{ $packageData->training ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>E-Visa Status</th>
            <td>{{ $packageData->e_vissa ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>BMET Status</th>
            <td>{{ $packageData->bmet ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Fly Status</th>
            <td>{{ $packageData->fly ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>{{ $packageData->payment ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>{{ $packageData->payment_method ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Account Number</th>
            <td>{{ $packageData->account_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Approval Status</th>
            <td>{{ $packageData->approval ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Generated on {{ date('d-M-Y H:i A') }}</p>
    </div>
</body>
</html>
