<?php
namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * تنفيذ عملية زرع البيانات
     *
     * @return void
     */
    public function run()
    {
        // التحقق إذا كان هناك بيانات حقيقية في ملف JSON
        $filePath = storage_path('app/airports.json');

        if (file_exists($filePath)) {
            $this->command->info('استيراد بيانات المطارات من الملف...');

            // قراءة البيانات من الملف
            $airports = json_decode(file_get_contents($filePath), true);

            // حفظ البيانات في قاعدة البيانات
            foreach ($airports as $airport) {
                Airport::updateOrCreate(
                    ['iata_code' => $airport['iata_code']],
                    [
                        'name'      => $airport['name'] ?? '',
                        'city'      => $airport['city'] ?? '',
                        'country'   => $airport['country'] ?? '',
                        'latitude'  => $airport['latitude'] ?? null,
                        'longitude' => $airport['longitude'] ?? null,
                        'timezone'  => $airport['timezone'] ?? null,
                        'is_active' => $airport['is_active'] ?? true,
                    ]
                );
            }

            $this->command->info('تم استيراد بيانات المطارات الحقيقية بنجاح!');
        } else {
            // إذا لم يكن هناك ملف بيانات، استخدم Airport Factory لإنشاء بيانات وهمية
            $this->command->info('لم يتم العثور على ملف بيانات المطارات. سيتم إنشاء بيانات وهمية...');

            // زراعة المطارات المشهورة
            $commonAirports = [
                ['iata_code' => 'JFK', 'city' => 'New York', 'country' => 'United States', 'name' => 'John F. Kennedy International Airport'],
                ['iata_code' => 'LAX', 'city' => 'Los Angeles', 'country' => 'United States', 'name' => 'Los Angeles International Airport'],
                ['iata_code' => 'LHR', 'city' => 'London', 'country' => 'United Kingdom', 'name' => 'Heathrow Airport'],
                ['iata_code' => 'CDG', 'city' => 'Paris', 'country' => 'France', 'name' => 'Charles de Gaulle Airport'],
                ['iata_code' => 'DXB', 'city' => 'Dubai', 'country' => 'United Arab Emirates', 'name' => 'Dubai International Airport'],
                ['iata_code' => 'CAI', 'city' => 'Cairo', 'country' => 'Egypt', 'name' => 'Cairo International Airport'],
                ['iata_code' => 'RUH', 'city' => 'Riyadh', 'country' => 'Saudi Arabia', 'name' => 'King Khalid International Airport'],
                ['iata_code' => 'JED', 'city' => 'Jeddah', 'country' => 'Saudi Arabia', 'name' => 'King Abdulaziz International Airport'],
                ['iata_code' => 'IST', 'city' => 'Istanbul', 'country' => 'Turkey', 'name' => 'Istanbul Airport'],
                ['iata_code' => 'AUH', 'city' => 'Abu Dhabi', 'country' => 'United Arab Emirates', 'name' => 'Abu Dhabi International Airport'],
                // مطارات الشرق الأوسط المشهورة
                ['iata_code' => 'AMM', 'city' => 'Amman', 'country' => 'Jordan', 'name' => 'Queen Alia International Airport'],
                ['iata_code' => 'BEY', 'city' => 'Beirut', 'country' => 'Lebanon', 'name' => 'Beirut–Rafic Hariri International Airport'],
                ['iata_code' => 'DOH', 'city' => 'Doha', 'country' => 'Qatar', 'name' => 'Hamad International Airport'],
                ['iata_code' => 'KWI', 'city' => 'Kuwait City', 'country' => 'Kuwait', 'name' => 'Kuwait International Airport'],
                ['iata_code' => 'MCT', 'city' => 'Muscat', 'country' => 'Oman', 'name' => 'Muscat International Airport'],
                ['iata_code' => 'BAH', 'city' => 'Manama', 'country' => 'Bahrain', 'name' => 'Bahrain International Airport'],
            ];

            foreach ($commonAirports as $airport) {
                Airport::updateOrCreate(
                    ['iata_code' => $airport['iata_code']],
                    [
                        'name'      => $airport['name'],
                        'city'      => $airport['city'],
                        'country'   => $airport['country'],
                        'latitude'  => rand(-90, 90),
                        'longitude' => rand(-180, 180),
                        'timezone'  => 'UTC+' . rand(0, 12),
                        'is_active' => true,
                    ]
                );
            }

            // إنشاء مطارات إضافية عشوائية
            Airport::factory()->count(50)->create();

            $this->command->info('تم إنشاء بيانات وهمية للمطارات بنجاح!');
        }

        $this->command->info('عدد المطارات في قاعدة البيانات: ' . Airport::count());
    }
}