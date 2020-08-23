<?php

declare(strict_types = 1);

use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $directory = public_path(Channel::STORAGE);

        if (! File::exists($directory)){
            File::makeDirectory($directory, $mode = 0755, $recursive = true);
        }

        factory(Channel::class, 5)->create();
    }
}
