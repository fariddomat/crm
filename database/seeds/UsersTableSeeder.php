<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name'=>'Super Admin',
            'email'=>'admin@crm.com',
            'password'=>bcrypt('admin'),
        ]);
        $user->attachRole('admin');


        $user1=User::create([
            'name'=>'Supervisor',
            'email'=>'supervisor@crm.com',
            'password'=>bcrypt('supervisor'),
        ]);
        $user1->attachRole('supervisor');

        $user2=User::create([
            'name'=>'Agent',
            'email'=>'agent@crm.com',
            'password'=>bcrypt('agent'),
        ]);
        $user2->attachRole('agent');


        $user3=User::create([
            'name'=>'Back office',
            'email'=>'back@crm.com',
            'password'=>bcrypt('back'),
        ]);
        $user3->attachRole('back_office');

    }
}
