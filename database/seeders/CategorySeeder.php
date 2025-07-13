<?php

namespace Database\Seeders;

use App\Models\PackageCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   $categories = [
            ['name' => 'Student Visa', 'slug' => 'student-visa', 'description' => 'Visa packages for studying abroad.'],
            ['name' => 'Tourist Visa', 'slug' => 'tourist-visa', 'description' => 'Travel visa packages for tourism purposes.'],
            ['name' => 'Work Permit', 'slug' => 'work-permit', 'description' => 'Visa packages for working in foreign countries.'],
            ['name' => 'Family Visa', 'slug' => 'family-visa', 'description' => 'Visa packages for migrating with family members.'],
            ['name' => 'Medical Visa', 'slug' => 'medical-visa', 'description' => 'Visa packages for medical treatment abroad.'],
            ['name' => 'Immigration Services', 'slug' => 'immigration-services', 'description' => 'Full immigration support packages for permanent residency.'],
            ['name' => 'Schengen Visa', 'slug' => 'schengen-visa', 'description' => 'Visa packages for Schengen countries in Europe.'],
            ['name' => 'Canada Express Entry', 'slug' => 'canada-express-entry', 'description' => 'Express Entry visa packages for Canada immigration.'],
            ['name' => 'USA DV Lottery', 'slug' => 'usa-dv-lottery', 'description' => 'Assistance packages for USA DV Lottery application.'],
            ['name' => 'UK Skilled Worker Visa', 'slug' => 'uk-skilled-worker-visa', 'description' => 'Skilled worker visa packages for the United Kingdom.'],
            ['name' => 'Australia Student Visa', 'slug' => 'australia-student-visa', 'description' => 'Visa packages for higher education in Australia.'],
            ['name' => 'IELTS/Language Course', 'slug' => 'ielts-language-course', 'description' => 'Language training packages including IELTS preparation.'],
            ['name' => 'Embassy Appointment', 'slug' => 'embassy-appointment', 'description' => 'Services for booking embassy appointments.'],
            ['name' => 'Flight Ticket Booking', 'slug' => 'flight-ticket-booking', 'description' => 'International flight booking services.'],
            ['name' => 'Travel Insurance', 'slug' => 'travel-insurance', 'description' => 'Insurance packages for international travelers.'],
            ['name' => 'Hotel Booking', 'slug' => 'hotel-booking', 'description' => 'Hotel booking services for travel or study abroad.'],
            ['name' => 'Document Translation', 'slug' => 'document-translation', 'description' => 'Translation and verification services for visa-related documents.'],
            ['name' => 'Visa Consultancy', 'slug' => 'visa-consultancy', 'description' => 'Professional consultancy for any kind of visa processing.'],
            ['name' => 'Hajj & Umrah Packages', 'slug' => 'hajj-umrah-packages', 'description' => 'Religious travel packages for Hajj and Umrah.'],
            ['name' => 'Student Accommodation Abroad', 'slug' => 'student-accommodation-abroad', 'description' => 'Accommodation arrangement services for international students.'],
         ];

        //foreach 
            foreach($categories as $item){
                $originalSlug = $item['slug']; //main slug
                $slug = $originalSlug;
                $counter = 1;

                while(PackageCategory::withTrashed()->where('slug', $slug)->exists()){
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $originalName = Str::upper($item['name']);  // uppercase here
                $name = $originalName;
                $counterName = 1;

                while(PackageCategory::withTrashed()->where('name', $name)->exists()){
                    $name = $originalName . ' ' . $counterName; // name always uppercase maintained
                    $counterName++;
                }

                PackageCategory::create([
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $item['description'],
                    'status' => 'active',
                    'image' => null,
                ]);
            }

    }
}


#1.  php artisan make:seeder CategorySeeder
#2. Now going to Database Seeder.php and add CategorySeeder::class,
#3. terminal php artisan db:seed --class=DatabaseSeeder


