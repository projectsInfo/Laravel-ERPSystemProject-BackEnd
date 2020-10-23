<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'mobile' => '01012316954',
            'address' => 'admin',
            'gender' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $count = 2;
        factory(User::class, $count)->create();
        

        $count = 2;
        factory(Client::class, $count)->create();

        DB::table('permissions')->insert([
            'name' => 'department',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Mange-user',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'warehouse',
            'guard_name' => 'web',
        ]);

        
        // DB::table('cities')->insert([
        //     'name' => 'Cairo',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Alexandria',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Giza',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Shubra el-Khema',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Port Said',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Suez',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El Mahalla el Kubra',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El Mansoura',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Tanta',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Asyut',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Fayoum',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Zagazig',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ismailia',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Khusus',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Aswan',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Damanhur',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Minya',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Damietta',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Luxor',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Qena',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Beni Suef',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sohag',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Shibin el-Kom',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Hurghada',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Banha',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kafr al-Sheikh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Mallawi',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El Arish',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Belbeis',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => '10th of Ramadan City',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Marsa Matruh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Mit Ghamr',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kafr el-Dawwar',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Qalyub',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Desouk',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abu Kabir',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Girga',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Akhmim',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Matareya',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Edko',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Bilqas',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Zifta',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Samalut',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Menouf',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Senbellawein',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Tahta',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Bush',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ashmoun',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Manfalut',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Senuris',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Beni Mazar',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Faqous',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Talkha',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Armant',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Maghagha',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Manzala',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Dairut',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kom Ombo',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kafr al-Zayat',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abu Tig',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Qis',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Edfu',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Rosetta',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Esna',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Dikirnis',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abnub',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Tima',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Beila',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Kanater al-Khiria',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Fashn',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Mansha',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Kareen',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Gamalia',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Fuwa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Minya al-Qamh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kharga',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Qus',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Khanka',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abu Qirqas',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Biba',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Samannoud',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Minyet al-Nasr',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Shibin al-Qanater',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ibshawai',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sherbin',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Drib Nigm',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Basyoun',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sers el-Lyan',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Dishna',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Hamool',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Farshut',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Tala',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ash-Shuhada',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Tamiya',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Mashtul el-Sook',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sadat City',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Ghanayem',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Itsa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Baliyana',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Hosh Issa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Matai',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Juhayna',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sidi Salem',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Naj Hammadi',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Quesna',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Hehya',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abul Matamir',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El Ubour',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Badari',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Kanayat',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'At-Tall al-Kabir',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Delengat',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Hammam',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Tukh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Bagour',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Etay el-Barud',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Deir Mawas',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Baltim',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abu Hammad',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abu Hummus',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Nabaroh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sharm el-Sheikh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Daraw',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Maragha',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sumusta al-Waqf',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Wasta',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ihnasiya',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kom Hamadah',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Quseir',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Qallin',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Birkat al-Sab',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Safaga',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ezbet el-Borg',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Faraskur',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Ibrahimiya',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Santa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ras Gharib',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sahel Selim',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Dar as-Salam',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Rafah',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Mit Salsil',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Husseinieh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kafr el-Batikh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kafr Saqr',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Bani Ubayd',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Qantara',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Metoubes',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Rahmaniyah',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Shubrakhit',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Mahmoudiyah',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Waqf',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'New Damietta City',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Qaha',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kotoor',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Abu Suweir-el-Mahatta',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kafr Shukr',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Kafr Saad',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Qift',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Fayed',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Saqultah',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Wadi al-Natrun',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Naqadah',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'As-Sarw',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Awlad Saqr',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sidi Barrani',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Basaliyah Bahri',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Badr',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Sedfa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Qantara ash-Sharqiya',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ar-Ruda',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Mut',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Tur',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'New Salhia',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ash-Shaykh Zawid',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Riyadh',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'New Beni Suef',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Aga',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Ad-Dabah',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Zarqa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'As-Sibaiyah Gharb',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Siwa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'El-Idwa',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Yusuf as-Siddiq',
        // ]);
        
        // DB::table('cities')->insert([
        //     'name' => 'Al-Bayadiyah',
        // ]);
        
        

        
       
    }
}
