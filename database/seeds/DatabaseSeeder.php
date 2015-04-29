<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        $this->call('GenreTableSeeder');
        $this->command->info('Genre table seeded!');

        $this->call('RadioTableSeeder');
        $this->command->info('Radio table seeded!');

    }

}