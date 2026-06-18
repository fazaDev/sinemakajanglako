<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Sinema Kajang Lako',
                'description' => 'Sinema Kajang Lako adalah komunitas film yang berfokus pada pengembangan sinema lokal di Jambi. Kami berkomitmen untuk mendukung sineas lokal melalui berbagai kegiatan seperti workshop, pemutaran film, dan kolaborasi proyek kreatif.',
                'vision' => 'Mewujudkan ekosistem film Jambi yang kreatif, berkelanjutan, berdaya saing, serta berakar pada budaya dan pengetahuan lokal.',
                'mission' => '-',
                'address' => 'Jl. Siswa II RT. 14 No. 130 Kel. Suka Karya Kec. Kota Baru Jambi, Jambi, Indonesia, 36127',
                'email' => 'offuce@sinemakajanglako.com',
                'phone' => '0813-2868-3562',
                'facebook' => 'https://www.facebook.com/profile.php?id=61587005482772',
                'instagram' => 'https://instagram.com/sinemakajanglako',
                'youtube' => 'https://youtube.com/@sinemakajanglako',
                'twitter' => 'https://x.com/sinemakajanglako',
                'tiktok' => 'https://tiktok.com/@sinemakajanglako',
            ]
        );
    }
}
