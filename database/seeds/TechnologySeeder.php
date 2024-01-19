<?php

use App\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $programmingLanguages = [
                'JavaScript',
                'Python',
                'Java',
                'C#',
                'Ruby',
                'TypeScript',
                'Swift',
                'Go',
                'Kotlin',
                'Rust',
                'PHP',
                'C++',
                'Objective-C',
                'Dart',
                'Scala',
                'Haskell',
                'Perl',
                'Lua',
                'R',
                'Shell Scripting'
            ];

            foreach ($programmingLanguages as $language) {
                $this->insertOrUpdateTechnology($language);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Insert or update a technology record.
     *
     * @param string $language
     * @return void
     */
    private function insertOrUpdateTechnology($language)
    {
        try {
            // Try to insert the record
            Technology::create([
                'name' => $language,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (QueryException $e) {
            // Log duplicate entry error and continue to the next iteration
            if ($e->errorInfo[1] == 1062) { // MySQL error code for duplicate entry
                Log::warning("Skipped duplicate entry for language: $language");
            } else {
                Log::error($e->getMessage());
            }
        }
    }
}
