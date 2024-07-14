<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Contact};

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::where("email","fajar@gmail.com")->first();

        $contact=new Contact();
        $contact->name="Zainab Aznur";
        $contact->email="zainab@localhost";
        $contact->phone="08123456789";
        $contact->address="jalanin aja dulu";
        $contact->user_id=$user->id;
        $contact->save();
    }
}
