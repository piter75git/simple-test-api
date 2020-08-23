<?php

declare(strict_types = 1);

use App\Models\Programme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProgrammesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $directory = public_path(Programme::STORAGE);

        if (! File::exists($directory)){
            File::makeDirectory($directory, $mode = 0755, $recursive = true);
        }

        // need to be create one by one because of using the time
        // of previously saved to create the next one

        $i = 100;

        while ($i--) {
            factory(Programme::class)->create();
        }
    }
}
