<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectId = DB::table('projects')
            ->insertGetId([
                'user_id' => 1,
                'name' => 'CC & SM',
                'price' => 4000000,
                'max_weight' => 100,
                'started_at' => now(),
                'finished_at' => now()
                    ->addDays(45),
                'created_at' => now(),
                'updated_at' => now()
            ]);

        // CC
        $tasks = [
            'CC - Config laravel & Orchid' => [
                'install & config orchid' => 5,
                'config fortify orchid' => 5,
                'custom login dengan tambahan username/email' => 5,
                'install islamdb/orchid-helper & islamdb/orchid-setting' => 1
            ],
            'CC - Database' => [
                'desain database' => 75,
                'buat semua migrasi & model' => 25,
                'buat trigger untuk isi kolom kode member secara otomatis (untuk export ke alat-alat)' => 20
            ],
            'CC - Seeding' => [
                'organization & member (ambil data dari excel)' => 20,
                'category (ambil data dari prismic)' => 10,
                'regio (ambil data dari prismic)' => 10,
                'tools (ambil data dari prismic)' => 20,
                'question & answer (ambil dan mapping data dari excel)' => 30,
                'test (ambil data dari notion)' => 15
            ],
            'CC - User' => [
                'tambahkan kolom username pada halaman user orchid' => 1,
                'ketika edit/add tambahkan username' => 5
            ]
        ];

        foreach (['CC - Organization #1', 'CC - Member', 'CC - Category', 'CC - Regio', 'CC - Tool', 'CC - Question', 'CC - Test', 'CC - Package (paket tes)'] as $t) {
            $tasks[$t] = [];
            foreach (['browse' => 5, 'read' => 5, 'edit' => 7.5, 'add' => 7.5, 'delete' => 1] as $item => $w) {
                $tasks[$t][$item] = $w;
            }
        }
        $tasks['CC - Organization #1']['tambahkan action untuk create database baru dengan template dari CC yang organization & member telah terisi'] = 50;
        $tasks['CC - Organization #1']['karena database diambil dari template CC maka hapus data yang tidak diperlukan'] = 10;
        $tasks['CC - Organization #2'] = [
            'tambahkan action untuk memanage lisensi' => 20,
            'tambahkan action untuk export member (vald)' => 10,
            'tambahkan action untuk menambahkan paket test' => 5
        ];
        $tasks['CC - Member']['ketika membuat member, buat user secara otomatis (perhatikan relasi one to one)'] = 5;
        $tasks['CC - Member']['mapping id dari vald (FDApi)'] = 75;
        $tasks['CC - Member']['mapping id dari vald (DBApi)'] = 75;
        $tasks['CC - Question']['impor pertanyaan dan jawaban (mapping)'] = 15;
        $tasks['CC - Question']['ketika edit/add bisa edit/add jawaban'] = 5;
        $tasks['CC - Test']['ketika add/edit bisa memilih beberapa tool'] = 5;
        $tasks['CC - Test']['ketika add/edit bisa memilih beberapa regio'] = 5;

        // SM
        $tasks['SM - Autentikasi'] = [
            'login satu portal (untuk semua organization)' => 25,
            'config supaya ambil dari database yang sesuai dengan user yang login' => 25
        ];
        $tasks['SM - Hak Akses (Role & Permission)'] = [
            'System Administrator (mempunyai semua hak akses)' => 7,
            'Sport Science (mendaftarkan member untuk mengikuti tes)' => 5,
            'Manager grup/squad/sub squad (memanage grup/squad/sub squad yang sesuai)' => 5,
            'Member (memiliki akses untuk melihat report dirinya sendiri)' => 5
        ];
        $tasks['SM - User'] = [
            'browse user (hanya untuk hak akses sytem administrator dan sport science)' => 10,
            'read user (hanya untuk hak akses sytem administrator dan sport science)' => 10,
            'edit user (hanya untuk hak akses sytem administrator dan sport science)' => 15,
            'add user (hanya untuk hak akses sytem administrator dan sport science)' => 15,
            'delete user (hanya untuk hak akses sytem administrator dan sport science)' => 1
        ];
        $tasks['SM - Organization'] = [
            'edit profil' => 15
        ];
        $tasks['SM - Grup/Squad/Sub Squad'] = [
            'browse' => 20,
            'add member' => 10,
            'add sub squad (bisa nested)' => 25,
            'edit list member' => 10,
            'delete' => 1,
            'Report grup/squad/sub squad (min, max, average, last)' => 25
        ];
        $tasks['SM - Member'] = [
            'report per individu' => 25,
            'browse tes yang diikuti' => 10,
            'tes soal/psikologi' => 35,
        ];
        $tasks['SM - Test'] = [
            'Mendaftarkan member' => 10,
            'read daftar member yang mengikuti tes' => 10,
            'isi data untuk manual tes' => 25,
            'upload hasil csv & olah data jika tes telah selesai' => 40,
            'ambil data api & olah data jika tes telah selesai' => 40
        ];

        $taskCounter = 1;
        foreach ($tasks as $task => $todos) {
            $taskId = DB::table('tasks')
                ->insertGetId([
                    'project_id' => $projectId,
                    'position' => $taskCounter++,
                    'name' => ucwords($task),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            $todoCounter = 1;
            $todoList = [];
            foreach ($todos as $todo => $weight) {
                $todoList[] = [
                    'task_id' => $taskId,
                    'position' => $todoCounter++,
                    'name' => ucfirst($todo),
                    'weight' => $weight,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            DB::table('todos')
                ->insert($todoList);
        }
    }
}
