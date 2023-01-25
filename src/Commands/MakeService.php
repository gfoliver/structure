<?php

namespace Gfoliver\Structure\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    protected $signature = 'make:service';

    protected $description = 'Create a new service';

    public function handle()
    {
        $this->info('Creating a new service!');
        $this->info('=============================');
        $this->newLine(2);

        $name = $this->ask('Service name:');
        // read if core folder has environments


        // copy files from source to environment

        $this->info('All done!');
    }
}
