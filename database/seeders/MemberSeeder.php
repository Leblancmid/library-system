<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $members = [
            ['name' => 'Maria Santos',      'email' => 'maria.santos@email.com',    'phone' => '+63 912 345 6001'],
            ['name' => 'Juan Dela Cruz',    'email' => 'juan.delacruz@email.com',   'phone' => '+63 917 234 5002'],
            ['name' => 'Ana Reyes',         'email' => 'ana.reyes@email.com',       'phone' => '+63 918 345 6003'],
            ['name' => 'Carlos Mendoza',    'email' => 'carlos.mendoza@email.com',  'phone' => '+63 919 456 7004'],
            ['name' => 'Rosa Garcia',       'email' => 'rosa.garcia@email.com',     'phone' => null             ],
            ['name' => 'Miguel Torres',     'email' => 'miguel.torres@email.com',   'phone' => '+63 912 567 8005'],
            ['name' => 'Elena Villanueva',  'email' => null,                        'phone' => '+63 917 678 9006'],
            ['name' => 'Pedro Ramos',       'email' => 'pedro.ramos@email.com',     'phone' => '+63 918 789 0007'],
            ['name' => 'Lucia Flores',      'email' => 'lucia.flores@email.com',    'phone' => '+63 919 890 1008'],
            ['name' => 'Antonio Cruz',      'email' => 'antonio.cruz@email.com',    'phone' => null             ],
            ['name' => 'Isabella Morales',  'email' => 'isabella.morales@email.com','phone' => '+63 912 901 2009'],
            ['name' => 'Diego Ramirez',     'email' => 'diego.ramirez@email.com',   'phone' => '+63 917 012 3010'],
            ['name' => 'Sofia Castillo',    'email' => 'sofia.castillo@email.com',  'phone' => '+63 918 123 4011'],
            ['name' => 'Andres Lim',        'email' => null,                        'phone' => '+63 919 234 5012'],
            ['name' => 'Carmen Aquino',     'email' => 'carmen.aquino@email.com',   'phone' => '+63 912 345 6013'],
            ['name' => 'Rafael Bautista',   'email' => 'rafael.bautista@email.com', 'phone' => '+63 917 456 7014'],
            ['name' => 'Gabriela Navarro',  'email' => 'gabriela.navarro@email.com','phone' => null             ],
            ['name' => 'Marco Domingo',     'email' => 'marco.domingo@email.com',   'phone' => '+63 918 567 8015'],
            ['name' => 'Patricia Ocampo',   'email' => 'patricia.ocampo@email.com', 'phone' => '+63 919 678 9016'],
            ['name' => 'Luis Aguilar',      'email' => 'luis.aguilar@email.com',    'phone' => '+63 912 789 0017'],
        ];

        foreach ($members as &$member) {
            $member['created_at'] = $now;
            $member['updated_at'] = $now;
        }

        DB::table('members')->insert($members);
    }
}