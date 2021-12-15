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

        $tasks = [
            'CC - Config laravel & Orchid' => [
                'install & config orchid' => 3,
                'config fortify orchid' => 3,
                'custom login dengan tambahan username/email' => 5,
                'install islamdb/orchid-helper & islamdb/orchid-setting' => 1
            ],
            'CC - Database' => [
                'desain database' => 50,
                'buat semua migrasi & model' => 10,
                'buat trigger untuk isi kolom kode member secara otomatis (untuk export ke alat-alat)' => 10
            ],
            'CC - Seeding' => [
                'user' => 10,
                'role' => 10,
                'organization' => 10,
                'member' => 10,
                'category' => 10,
                'regio' => 10,
                'tools' => 10,
                'package' => 10,
                'question' => 10,
                'test' => 10
            ],
            'CC - User' => [
                'tambahkan kolom username pada halaman' => 5,
                'ketika edit/add tambahkan username' => 5
            ]
        ];

        foreach (['CC - Organization #1', 'CC - Member', 'CC - Category', 'CC - Regio', 'CC - Tool', 'CC - Question', 'CC - Test', 'CC - Package (paket tes)'] as $t) {
            $tasks[$t] = [];
            foreach (['browse' => 2, 'read' => 5, 'edit' => 5, 'add' => 5, 'delete' => 1] as $item => $w) {
                $tasks[$t][$item] = $w;
            }
        }

        $tasks['CC - Organization #1']['tambahkan action untuk create database baru yang organization & member telah terisi'] = 50;
        $tasks['CC - Organization #2'] = [
            'tambahkan action untuk memanage lisensi' => 2.5,
            'tambahkan action untuk export member (vald)' => 10,
            'tambahkan action untuk menambahkan paket test' => 15
        ];
        $tasks['CC - Member']['ketika membuat member, buat user secara otomatis (perhatikan relasi one to one)'] = 5;
        $tasks['CC - Member']['mapping id dari vald (FDApi)'] = 50;
        $tasks['CC - Member']['mapping id dari vald (DBApi)'] = 50;
        $tasks['CC - Question']['impor pertanyaan dan jawaban (mapping)'] = 15;
        $tasks['CC - Question']['ketika edit/add bisa edit/add jawaban'] = 5;
        $tasks['CC - Test']['ketika add/edit bisa memilih beberapa tool'] = 5;
        $tasks['CC - Test']['ketika add/edit bisa memilih beberapa regio'] = 5;

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
