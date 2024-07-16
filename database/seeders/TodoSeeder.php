<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User,Todo};

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::where('email', 'fajar@gmail.com')->firstOrFail();

        $todo=new Todo();
        $todo->title="Test Todo";
        $todo->description="Test Todo Decription";
        $todo->user_id=$user->id;
        $todo->save();
    }
}
