<?php

namespace Database\Seeders;

use App\Models\Cities;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            'Ariyalur', 'Chengalpattu', 'Chennai', 'Coimbatore', 'Cuddalore', 'Dharmapuri', 'Dindigul',
            'Erode', 'Kallakurichi', 'Kancheepuram', 'Karur', 'Krishnagiri', 'Madurai', 'Mayiladuthurai',
            'Nagapattinam', 'Kanniyakumari', 'Nagercoil', 'Namakkal', 'Perambalur', 'Pudukottai',
            'Ramanathapuram', 'Ranipet', 'Salem', 'Sivagangai', 'Tenkasi', 'Thanjavur', 'Theni',
            'Thiruvallur', 'Thiruvarur', 'Thoothukudi', 'Trichirappalli', 'Thirunelveli', 'Tirupathur',
            'Tiruppur', 'Tiruvannamalai', 'The Nilgiris', 'Vellore', 'Viluppuram', 'Virudhunagar'
        ];

        foreach ($cities as $city) {
            Cities::create([
                'name' => $city,
            ]);
        }
    }
}
