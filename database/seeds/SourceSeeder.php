<?php

use App\Source;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sources = ['LinkedIn', 'Facebook', 'Google', 'website', 'Friend', 'Other'];

        foreach ($sources as $source) {
            Source::create(['name' => $source]);
        }
    }
}
