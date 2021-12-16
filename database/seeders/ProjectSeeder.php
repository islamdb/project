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
            'CC - Config laravel & Orchid (Dev)' => [
                'Pasang & konfigurasi orchid' => 5,
                'Pasang & konfigurasi fortify dengan orchid' => 5,
                'Modifikasi login dengan menambahkan username/email' => 5,
                'Pasang islamdb/orchid-helper & islamdb/orchid-setting' => 0
            ],
            'CC - Database' => [
                'Desain database' => 60,
                'Buat semua migrasi & model' => 25
            ],
            'CC - Trigger, View & Store Procedure Database (Dev)' => [
                'Trigger & logic untuk isi kolom kode member secara otomatis' => 15,
                'View m_organization_vew' => 10,
                'View t_licence_view' => 10,
                'View m_meber_view' => 10,
                'View m_type_view' => 10,
                'View m_question_view' => 10,
                'View/Store procedure untuk report per member' => 20,
                'View/Store procedure untuk report group' => 20
            ],
            'CC - Seeding' => [
                'Organization dan Member (ambil data dari excel)' => 15,
                'Category (ambil data dari prismic)' => 10,
                'Regio (ambil data dari prismic)' => 10,
                'Tool (ambil data dari prismic)' => 15,
                'Question & answer (ambil dan mapping data dari excel)' => 20,
                'test (ambil data dari notion)' => 10
            ],
            'CC - User (Dev)' => [
                'Tambahkan kolom username pada halaman user orchid' => 1,
                'ketika edit/add tambahkan username' => 5
            ]
        ];

        foreach (['CC - Organization #1', 'CC - Member', 'CC - Category', 'CC - Regio', 'CC - Tool', 'CC - Question', 'CC - Test', 'CC - Package (paket tes)'] as $t) {
            $tasks[$t] = [];
            foreach (['Browse' => 5, 'Read' => 5, 'Edit' => 7.5, 'Add' => 7.5, 'Delete' => 1] as $item => $w) {
                $tasks[$t][$item] = $w;
            }
        }
        $tasks['CC - Organization #1']['Tambahkan aksi untuk membuat database baru dengan template dari CC yang organization & membernya telah terisi'] = 40;
        $tasks['CC - Organization #1']['Karena database diambil dari template CC maka hapus data yang tidak diperlukan'] = 10;
        $tasks['CC - Organization #2'] = [
            'Tambahkan aksi untuk mengelola lisensi' => 20,
            'Tambahkan aksi untuk expor member (vald)' => 10,
            'Tambahkan aksi untuk menambahkan paket tes' => 5
        ];
        $tasks['CC - Member']['Ketika membuat member, buat user secara otomatis (perhatikan relasi one to one)'] = 5;
        $tasks['CC - Member']['Mapping id dari vald (FDApi)'] = 50;
        $tasks['CC - Member']['Mapping id dari vald (DBApi)'] = 50;
        $tasks['CC - Question']['Impor pertanyaan dan jawaban (mapping)'] = 15;
        $tasks['CC - Question']['Ketika edit/add bisa edit/add jawaban'] = 5;
        $tasks['CC - Test']['Ketika add/edit bisa memilih beberapa tool'] = 5;
        $tasks['CC - Test']['Ketika add/edit bisa memilih beberapa regio'] = 5;

        // SM
        $task['SM - Preparation (Dev)'] = [
            'Pasang template' => 5,
            'Buat routing livewire dinamis seperti nuxt.js' => 7.5,
            'Konfigurasi SPA livewire dengan hotwire/turbolinks'
        ];
        $tasks['SM - Autentikasi'] = [
            'Login satu portal (untuk semua organization)' => 25,
            'Konfigurasi supaya mengambil dari database yang sesuai dengan user yang login' => 25
        ];
        $tasks['SM - Hak Akses & Perizinan'] = [
            'System Administrator (mempunyai semua hak akses)' => 7,
            'Sport Science (mendaftarkan member untuk mengikuti tes)' => 5,
            'Manager grup/squad/sub squad (memanage grup/squad/sub squad yang sesuai)' => 5,
            'Member (memiliki akses untuk melihat report dirinya sendiri)' => 5
        ];
        $tasks['SM - User'] = [
            'Browse user (hanya untuk hak akses sytem administrator dan sport science)' => 5 + 5,
            'Read user (hanya untuk hak akses sytem administrator dan sport science)' => 5 + 5,
            'Edit user (hanya untuk hak akses sytem administrator dan sport science)' => 7.5 + 5,
            'Add user (hanya untuk hak akses sytem administrator dan sport science)' => 7.5 + 5,
            'Delete user (hanya untuk hak akses sytem administrator dan sport science)' => 1
        ];
        $tasks['SM - Organization'] = [
            'Edit profil' => 12.5
        ];
        $tasks['SM - Grup/Squad/Sub Squad'] = [
            'Browse' => 5 + 5 + 2.5,
            'Add member' => 7.5 + 5,
            'Add sub squad (bisa nested)' => 7.5 + 2.5,
            'Edit list member' => 7.5 + 2.5,
            'Delete' => 1,
            'Report grup/squad/sub squad (min, max, average, last)' => 15
        ];
        $tasks['SM - Member'] = [
            'report per individu' => 25,
            'browse tes yang diikuti' => 5 + 5,
            'tes soal/psikologi' => 15,
        ];
        $tasks['SM - Test'] = [
            'Mendaftarkan member' => 5 + 5,
            'Read daftar member yang mengikuti tes' => 5 + 5,
            'Isi data untuk manual tes' => 25,
            'Upload hasil csv & olah data jika tes telah selesai' => 35,
            'Ambil data api & olah data jika tes telah selesai' => 35
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
