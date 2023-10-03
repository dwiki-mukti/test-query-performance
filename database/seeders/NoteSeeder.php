<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\NoteCount;
use App\Models\User;
use App\Models\UserNoteCache;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # init faker
        $faker = Faker::create('id_ID');

        # inserting data
        for ($userIndex = 1; $userIndex <= 50; $userIndex++) {
            $name = $faker->name();
            $email = $faker->email();
            $password = bcrypt('password');
            $totalViewer = 0;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            for ($indexNote = 1; $indexNote <= 100; $indexNote++) {
                $title = $faker->sentence();
                $content = $faker->paragraph();
                $viewer = $faker->randomNumber(3);

                Note::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'content' => $content,
                    'viewer' => $viewer
                ]);
                UserNoteCache::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'title' => $title,
                    'content' => $content,
                    'viewer' => $viewer
                ]);
                $totalViewer += $viewer;
            }

            NoteCount::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'total_viewer' => $totalViewer
            ]);
        }
    }
}
