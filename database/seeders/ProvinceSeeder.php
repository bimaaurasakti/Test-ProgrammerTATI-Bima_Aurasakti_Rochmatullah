<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://wilayah.id/api/provinces.json');
        if ($response->successful()) {
            $provinces = $response->json()['data'];
            foreach ($provinces as $province) {
                Province::create([
                    'id' => $province['code'],
                    'name' => $province['name'],
                ]);
            }
        } else {
            $this->command->error('Failed to fetch provinces data.');
        }
    }
}
