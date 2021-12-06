<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'employee_name' => 'Mg Mg',
                'email' => 'mgmg@gmail.com',
                'password' => 'mgmg1234',
                'profile' => 'profile.png',
                'position' => '0',
                'address' => 'yankin',
                'dob' => '1998-11-11',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Aung Aung',
                'email' => 'aungaung@gmail.com',
                'password' => 'agag1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hledan',
                'dob' => '1998-6-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Win Win',
                'email' => 'winwin@gmail.com',
                'password' => 'winwin1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'south okkalar',
                'dob' => '1998-2-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Hla Myint',
                'email' => 'hlamyint@gmail.com',
                'password' => 'hlamyint1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'dagon',
                'dob' => '1998-3-12',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Naing Lin',
                'email' => 'nainglin@gmail.com',
                'password' => 'nglin1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'magway',
                'dob' => '1998-6-12',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Kyaw Kyaw',
                'email' => 'kyawkyaw@gmail.com',
                'password' => 'kyawkyaw1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hlaing',
                'dob' => '1998-6-15',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Gary',
                'email' => 'gary@gmail.com',
                'password' => 'gary1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'insein',
                'dob' => '1998-5-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Alinkar',
                'email' => 'alinkar@gmail.com',
                'password' => 'alinkar1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hledan',
                'dob' => '1998-4-12',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Myo Myo',
                'email' => 'myomyo@gmail.com',
                'password' => 'myomyo1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'sanchaung',
                'dob' => '1998-6-23',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Zaw Zaw',
                'email' => 'zawzaw@gmail.com',
                'password' => 'zawzaw1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hledan',
                'dob' => '1998-6-14',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Phue Pwint',
                'email' => 'phuepwint@gmail.com',
                'password' => 'phuepwint1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'bahan',
                'dob' => '1998-2-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Akary',
                'email' => 'akary@gmail.com',
                'password' => 'akary1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'mandalay',
                'dob' => '1998-8-14',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Kalayar',
                'email' => 'kalayar@gmail.com',
                'password' => 'kalayar1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'yankin',
                'dob' => '1998-7-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Pyae Pyae',
                'email' => 'pyaepyae@gmail.com',
                'password' => 'pyaepyae1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hledan',
                'dob' => '1998-12-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Pwint Phyu',
                'email' => 'pwintphyu@gmail.com',
                'password' => 'pwintphyu1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'bago',
                'dob' => '1998-5-12',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Wai Yan',
                'email' => 'waiyan@gmail.com',
                'password' => 'waiyan1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hledan',
                'dob' => '1998-3-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Eaint Hmue',
                'email' => 'scm.eainthmue@gmail.com',
                'password' => 'ehtp1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hledan',
                'dob' => '1998-3-4',
                'phone' => '09430000123'
            ],
            [
                'employee_name' => 'Ei Tone',
                'email' => 'uiteitone@gmail.com',
                'password' => 'eitone1234',
                'profile' => 'profile.png',
                'position' => '1',
                'address' => 'hledan',
                'dob' => '1998-3-4',
                'phone' => '09430000123'
            ]
        ];
        DB::table('employees') -> truncate();

        foreach($employee as $value) {
            DB::table('employees')->insert([
                'employee_name' => $value['employee_name'],
                'email' => $value['email'],
                'password' => Hash::make($value['password']),
                'profile' => $value['profile'],
                'position' => $value['position'],
                'address' => $value['address'],
                'dob' => $value['dob'],
                'phone' => $value['phone'],
                'created_at'=>Date('Y-m-d H:i:s'),
                'updated_at'=>null,
                'deleted_at'=>null
            ]);
        }
    }
}
