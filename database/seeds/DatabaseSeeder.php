<?php

use Illuminate\Database\Seeder;
use App\KriteriaPenilaian;
use App\KriteriaNilai;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // Basic roles data
        App\Role::insert([
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'karyawan'],
        ]);
    
        // Basic permissions data
        App\Permission::insert([
            ['name' => 'access.backend'],
            
            ['name' => 'create.user'],
            ['name' => 'edit.user'],
            ['name' => 'delete.user'],

            ['name' => 'create.rencanakerja'],
            ['name' => 'edit.rencanakerja'],
            ['name' => 'delete.rencanakerja'],

            ['name' => 'create.aktifitaskerja'],
            ['name' => 'edit.aktifitaskerja'],
            ['name' => 'delete.aktifitaskerja'],
        ]);
    
        // Add a permission to a role
        $role = App\Role::where('name', 'admin')->first();
        $role->addPermission('access.backend');
        $role->addPermission('create.user');
        $role->addPermission('edit.user');    
        $role->addPermission('delete.user');

        $karyawan = App\Role::where('name', 'karyawan')->first();
        $karyawan->addPermission('create.aktifitaskerja');
        $karyawan->addPermission('edit.aktifitaskerja');
        $karyawan->addPermission('delete.aktifitaskerja');
        // ... Add other role permission if necessary
    
        // Create a user, and give roles
        $user = App\User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'name' => 'Admin Aja',
            'password' => bcrypt('password'),
            'isactive' => 1,
        ]);
        $user->assignRole('admin');

        $user1 = App\User::create([
            'username' => 'fauzankamil',
            'email' => 'fzn.aidiel@gmail.com',
            'name' => 'Fauzan Kamil',
            'password' => bcrypt('fauzankamil'),
            'jabatan' => 'Project Manager',
            
        ]);
        $user1->assignRole('karyawan');

        $user2 = App\User::create([
            'username' => 'restu',
            'email' => 'dcrestu@gmail.com',
            'name' => 'Restu DC',
            'password' => bcrypt('restu'),
        ]);
        $user2->assignRole('karyawan');

        $user3 = App\User::create([
            'username' => 'muhamadanjar',
            'email' => 'arvanria@gmail.com',
            'name' => 'Muhamad Anjar',
            'password' => bcrypt('password'),
        ]);
        $user3->assignRole('karyawan');

        $user4 = App\User::create([
            'username' => 'yuliyati',
            'email' => 'uwiyuli37@gmail.com',
            'name' => 'Yuliyati',
            'password' => bcrypt('yuliyati'),
            'tgl_masuk' => '2016-08-24',
            'nik' => '3202076912920000'
        ]);
        $user4->assignRole('karyawan');

        $user5 = App\User::create([
            'username' => 'virdi',
            'email' => 'virdi@example.com',
            'name' => 'Moh. Virdian',
            'password' => bcrypt('virdi'),
            'jabatan' => 'PO Training SUAV dan Survey Drone',
        ]);
        $user5->assignRole('karyawan');

        $user6 = App\User::create([
            'username' => 'agung',
            'email' => 'agung@example.com',
            'name' => 'Agung Bimo',
            'password' => bcrypt('agung'),

        ]);
        $user6->assignRole('karyawan');

        $user7 = App\User::create([
            'username' => 'ersa',
            'email' => 'ersa@example.com',
            'name' => 'Herlambang Sampurno',
            'password' => bcrypt('ersa'),
            'nik' => '3271060901930010',
            'jabatan' => 'Asisten Planner',
            'tgl_masuk' => '2016-06-14'

        ]);
        $user7->assignRole('karyawan');

        $user8 = App\User::create([
            'username' => 'icha',
            'email' => 'icha@example.com',
            'name' => 'Riska Arini',
            'password' => bcrypt('icha'),
            'nik' => '3271044612880000',
            'jabatan' => 'HRD',
            'tgl_masuk' => '2013-03-11'

        ]);
        $user8->assignRole('karyawan');

        $user9 = App\User::create([
            'username' => 'fajar',
            'email' => 'fajar@example.com',
            'name' => 'Fajar Eriskmoko',
            'password' => bcrypt('fajar'),
            'tgl_masuk' => '2016-01-01'

        ]);
        $user9->assignRole('karyawan');

        $user10 = App\User::create([
            'username' => 'lutfi',
            'email' => 'lutfi@example.com',
            'name' => 'Lutfi',
            'password' => bcrypt('lutfi'),
            'tgl_masuk' => '2015-05-01'

        ]);
        $user10->assignRole('karyawan');
        
        $user11 = App\User::create([
            'username' => 'dayu',
            'email' => 'dayu@example.com',
            'name' => 'Eneng Dayu',
            'password' => bcrypt('dayu'),
        ]);
        $user11->assignRole('karyawan');

        $user12 = App\User::create([
            'username' => 'wiwit',
            'email' => 'wiwit@example.com',
            'name' => 'Wiwit Widiyanto',
            'password' => bcrypt('wiwit'),
        ]);
        $user12->assignRole('karyawan');

        $user13 = App\User::create([
            'username' => 'yayuk',
            'email' => 'yayuk@example.com',
            'name' => 'Yayuk Fidha S',
            'password' => bcrypt('yayuk'),
        ]);
        $user13->assignRole('karyawan');
        
        
        $kriteria = KriteriaPenilaian::insert([
            ['kriteria' => 'KEJUJURAN','nilai' => 0],
            ['kriteria' => 'LOYALITAS','nilai' => 0],
            ['kriteria' => 'KREATIVITAS & KECERDASAN','nilai' => 0],
            ['kriteria' => 'WAWASAN','nilai' => 0],
            ['kriteria' => 'BERANI MENGAMBIL KEPUTUSAN','nilai' => 0],
            ['kriteria' => 'BERPIKIR & BERTINDAK SISTEMATIS','nilai' => 0],
            ['kriteria' => 'KETEGASAN','nilai' => 0],
            ['kriteria' => 'D I S I P L I N','nilai' => 0],
            ['kriteria' => 'CEKATAN / GESIT','nilai' => 0],
            ['kriteria' => 'PEDULI & RESPONSIF','nilai' => 0],
            ['kriteria' => 'TIDAK SUKA MENUNDA WAKTU','nilai' => 0],
            ['kriteria' => 'KETELITIAN DALAM BEKERJA','nilai' => 0],
        ]);
       

        $nilai = KriteriaNilai::insert([
            ['kode' => 'BS','ket' => 'Bagus Sekali','nilai' => 5],
            ['kode' => 'B','ket' => 'Bagus','nilai' => 4],
            ['kode' => 'C','ket' => 'Cukup','nilai' => 3],
            ['kode' => 'K','ket' => 'Kurang','nilai' => 2],
            ['kode' => 'KS','ket' => 'Kurang Sekali','nilai' => 1]
        ]);



    }
}
