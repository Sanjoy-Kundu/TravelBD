<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            // ------- Student Visa (category_id: 1) -------
            [
                'category_id' => 1,
                'title' => 'USA Student Visa - Basic',
                'slug' => Str::slug('USA Student Visa - Basic'),
                'short_description' => 'Basic package for USA student visa.',
                'long_description' => 'Includes admission assistance, visa processing and embassy guidance.',
                'price' => 350000,
                'currency' => 'BDT',
                'duration' => '4 Years',
                'inclusions' => 'University Application, Visa, Consultancy',
                'exclusions' => 'Airfare, Food, Personal Expenses',
                'visa_processing_time' => '2 Months',
                'documents_required' => 'Passport, Academic Certificate, IELTS',
                'seat_availability' => 20,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'title' => 'Canada Student Visa - Standard',
                'slug' => Str::slug('Canada Student Visa - Standard'),
                'short_description' => 'Standard package for Canada student visa.',
                'long_description' => 'Support for university application, SOP, visa file and more.',
                'price' => 450000,
                'currency' => 'BDT',
                'duration' => '4 Years',
                'inclusions' => 'University Admission, Visa File Prep, Medical',
                'exclusions' => 'Flight, Personal Cost',
                'visa_processing_time' => '3 Months',
                'documents_required' => 'Passport, Bank Statement, NID',
                'seat_availability' => 15,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'title' => 'UK Student Visa - Premium',
                'slug' => Str::slug('UK Student Visa - Premium'),
                'short_description' => 'Premium student visa package with full support.',
                'long_description' => 'Includes full document handling, visa, interview training and post-arrival support.',
                'price' => 600000,
                'currency' => 'BDT',
                'duration' => '3 Years',
                'inclusions' => 'University Admission, Visa, Training',
                'exclusions' => 'Food, Flight',
                'visa_processing_time' => '1 Month',
                'documents_required' => 'Passport, Academic, IELTS, Financials',
                'seat_availability' => 19,
                'status' => 'active',
            ],

            // ------- Tourist Visa (category_id: 2) -------
            [
                'category_id' => 2,
                'title' => 'Thailand Tourist Visa - Basic',
                'slug' => Str::slug('Thailand Tourist Visa - Basic'),
                'short_description' => 'Entry-level package for Thailand tourism.',
                'long_description' => 'Includes visa processing, document prep and 3-night hotel.',
                'price' => 80000,
                'currency' => 'BDT',
                'duration' => '15 Days',
                'inclusions' => 'Visa, Hotel Booking, Travel Guide',
                'exclusions' => 'Flight Ticket, Food',
                'visa_processing_time' => '10 Days',
                'documents_required' => 'Passport, NID, Bank Statement',
                'seat_availability' => 50,
                'status' => 'active',
            ],
            [
                'category_id' => 2,
                'title' => 'Malaysia Tourist Visa - Standard',
                'slug' => Str::slug('Malaysia Tourist Visa - Standard'),
                'short_description' => 'Comfortable tourist package to Malaysia.',
                'long_description' => 'Visa support with insurance, hotel and invitation letter.',
                'price' => 120000,
                'currency' => 'BDT',
                'duration' => '20 Days',
                'inclusions' => 'Visa, Insurance, Hotel',
                'exclusions' => 'Food, Flight',
                'visa_processing_time' => '12 Days',
                'documents_required' => 'Passport, NID, Photo',
                'seat_availability' => 115,
                'status' => 'active',
            ],
            [
                'category_id' => 2,
                'title' => 'Singapore Tourist Visa - Premium',
                'slug' => Str::slug('Singapore Tourist Visa - Premium'),
                'short_description' => 'Premium tour package for Singapore.',
                'long_description' => 'Includes hotel, visa, pickup and sightseeing arrangements.',
                'price' => 180000,
                'currency' => 'BDT',
                'duration' => '1 Week',
                'inclusions' => 'Visa, Hotel, City Tour, Guide',
                'exclusions' => 'Flight',
                'visa_processing_time' => '7 Days',
                'documents_required' => 'Passport, Photo, NID, Income Source',
                'seat_availability' => 120,
                'status' => 'active',
            ],

            // ------- Work Permit (category_id: 3) -------
            [
                'category_id' => 3,
                'title' => 'Qatar Work Visa – Construction Helper',
                'slug' => Str::slug('Qatar Work Visa – Construction Helper'),
                'short_description' => '2-year work visa for Qatar construction sector.',
                'long_description' => 'Includes MOFA paper, visa, medical and consultancy.',
                'price' => 260000,
                'currency' => 'BDT',
                'duration' => '2 Years',
                'inclusions' => 'Visa, Contract Paper, Medical, Consultancy',
                'exclusions' => 'Food, Flight',
                'visa_processing_time' => '20 Days',
                'documents_required' => 'Passport, NID, 4 Copy Photo',
                'seat_availability' => 250,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'title' => 'Saudi Arabia Work Visa – Light Driver',
                'slug' => Str::slug('Saudi Arabia Work Visa – Light Driver'),
                'short_description' => 'Driver job with legal contract in KSA.',
                'long_description' => 'Light driver position, includes visa, ticket, and contract.',
                'price' => 300000,
                'currency' => 'BDT',
                'duration' => '2 Years',
                'inclusions' => 'Visa, Ticket, Contract, Consultancy',
                'exclusions' => 'Medical Test, Food',
                'visa_processing_time' => '25 Days',
                'documents_required' => 'Passport, Driving License, NID',
                'seat_availability' => 540,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'title' => 'Italy Agriculture Work Visa (Seasonal)',
                'slug' => Str::slug('Italy Agriculture Work Visa (Seasonal)'),
                'short_description' => 'Seasonal work visa for Italy agriculture jobs.',
                'long_description' => 'Valid 6-month visa under Flussi Quota – includes sponsorship & embassy support.',
                'price' => 900000,
                'currency' => 'BDT',
                'duration' => '6 Months',
                'inclusions' => 'Sponsorship, Visa File, Embassy Slot',
                'exclusions' => 'Flight, Accommodation',
                'visa_processing_time' => '2.5 Months',
                'documents_required' => 'Passport, Police Clearance, Family Info',
                'seat_availability' => 350,
                'status' => 'active',
            ],

            // ------- Family Visa (category_id: 4) -------
            [
                'category_id' => 4,
                'title' => 'UAE Family Visa – Spouse & Child',
                'slug' => Str::slug('UAE Family Visa – Spouse & Child'),
                'short_description' => 'Family sponsorship visa for UAE residents.',
                'long_description' => 'Sponsor spouse and children under UAE visa with full document processing.',
                'price' => 180000,
                'currency' => 'BDT',
                'duration' => '2 Years',
                'inclusions' => 'Medical, Emirates ID File, Visa',
                'exclusions' => 'Flight, Personal Expenses',
                'visa_processing_time' => '10–15 Days',
                'documents_required' => 'Marriage Certificate, Birth Certificate, Passport',
                'seat_availability' => 18,
                'status' => 'active',
            ],
            [
                'category_id' => 4,
                'title' => 'Canada Dependent Visa – Spouse',
                'slug' => Str::slug('Canada Dependent Visa – Spouse'),
                'short_description' => 'PR holder can sponsor spouse with this visa.',
                'long_description' => 'Complete file submission support with biometric booking.',
                'price' => 480000,
                'currency' => 'BDT',
                'duration' => 'Permanent',
                'inclusions' => 'Visa File, PCC, Biometrics Guidance',
                'exclusions' => 'Airfare, Settlement Cost',
                'visa_processing_time' => '2–4 Months',
                'documents_required' => 'PR Card, Marriage Certificate, Passport',
                'seat_availability' => 20,
                'status' => 'active',
            ],
            [
                'category_id' => 4,
                'title' => 'UK Family Visa – Dependent Child',
                'slug' => Str::slug('UK Family Visa – Dependent Child'),
                'short_description' => 'Visa for dependent children under ILR holders.',
                'long_description' => 'Assistance in visa file, IHS surcharge payment and VFS appointment.',
                'price' => 620000,
                'currency' => 'BDT',
                'duration' => '5 Years',
                'inclusions' => 'IHS Fee Setup, Visa File, Guidance',
                'exclusions' => 'Travel, Housing',
                'visa_processing_time' => '2 Months',
                'documents_required' => 'Passport, Birth Certificate, ILR Copy',
                'seat_availability' => 50,
                'status' => 'active',
            ],

            // ------- Medical Visa (category_id: 5) -------
            [
                'category_id' => 5,
                'title' => 'India Medical Visa – Apollo Hospital',
                'slug' => Str::slug('India Medical Visa – Apollo Hospital'),
                'short_description' => 'Medical visa for treatment in Apollo Hospital, India.',
                'long_description' => 'Includes hospital invitation letter, visa application, and appointment.',
                'price' => 25000,
                'currency' => 'BDT',
                'duration' => '3 Months',
                'inclusions' => 'Medical Letter, Visa Support, Guidance',
                'exclusions' => 'Flight, Treatment Cost',
                'visa_processing_time' => '7 Days',
                'documents_required' => 'Passport, Doctor Prescription, NID',
                'seat_availability' => 40,
                'status' => 'active',
            ],
            [
                'category_id' => 5,
                'title' => 'Thailand Medical Visa – Bumrungrad Hospital',
                'slug' => Str::slug('Thailand Medical Visa – Bumrungrad Hospital'),
                'short_description' => 'Visa for advanced medical treatment in Bangkok.',
                'long_description' => 'Fast-track visa processing with appointment at top Thai hospital.',
                'price' => 110000,
                'currency' => 'BDT',
                'duration' => '1 Month',
                'inclusions' => 'Visa, Appointment, Medical Translator',
                'exclusions' => 'Accommodation, Food, Medicines',
                'visa_processing_time' => '6–8 Days',
                'documents_required' => 'Medical File, Passport',
                'seat_availability' => 40,
                'status' => 'active',
            ],
            [
                'category_id' => 5,
                'title' => 'Singapore Medical Visa – Oncology Specialist',
                'slug' => Str::slug('Singapore Medical Visa – Oncology Specialist'),
                'short_description' => 'Visa support for cancer treatment in Singapore.',
                'long_description' => 'Includes direct hospital coordination and appointment with specialist.',
                'price' => 240000,
                'currency' => 'BDT',
                'duration' => '1 Month',
                'inclusions' => 'Visa, Medical Letter, Translation',
                'exclusions' => 'Ticket, Stay, Full Treatment',
                'visa_processing_time' => '5 Days',
                'documents_required' => 'Doctor Referral, Passport, Photo',
                'seat_availability' => 35,
                'status' => 'active',
            ],
        ];

        foreach ($packages as $package) {
            $slug = Str::slug($package['title']);
            $count = Package::where('slug', 'like', "{$slug}%")->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $package['slug'] = $slug;

            Package::create($package);
        }
    }
}



#1.php artisan make:seeder PackageSeeder
#2. registration to DatabaseSeeder
#3.php artisan db:seed --class=PackageSeeder
