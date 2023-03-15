<?php

namespace Gfoliver\Structure\Commands;

class Organize extends \Illuminate\Console\Command
{
    protected $signature = 'organize';

    protected $description = 'Organize the project structure';

    public function handle()
    {
        $this->info('Organizing project structure!');
        $this->info('=============================');
        $this->newLine(2);
        // create a folder Core inside app
        $this->createFolder('app', 'Core');

        // ask if the app has multiple environments
        $multipleEnvironments = $this->ask('Does the app have multiple environments? (Y/n)', 'y');

        if ($multipleEnvironments == 'y')
        {
            $environments = [];
            // while the input isnt empty keep asking and appending to $environments array
            while ($environment = $this->ask('Environment name (leave empty to finish)'))
            {
                $environments[] = $environment;
            }

            foreach ($environments as $environment)
            {
                // capitalize environment name
                $environment = ucfirst(strtolower($environment));
                $this->createFolder('app', $environment);
                $this->buildEnvironmentStructure($environment);
            }
        }
        else
        {
            $this->buildEnvironmentStructure();
        }

        $this->info('All done!');
    }

    protected function buildEnvironmentStructure($environment = null)
    {
        $base = 'app/Core';
        if ($environment)
        {
            $base .= '/' . $environment;
        }

        $this->createFolder($base, 'Services');
        $this->createFolder($base . '/Services', 'Contracts');
        $this->createFolder($base, 'Repositories');
        $this->createFolder($base . '/Repositories', 'Contracts');
    }

    protected function createFolder($path, $folder)
    {
        $path = base_path($path);
        if (!file_exists($path . '/' . $folder))
        {
            $fullPath = $path . '/' . $folder;
            mkdir($fullPath, 0777, true);
            $this->info('Folder ' . $fullPath . ' created');
        }
        else {
            $this->info('Folder ' . $folder . ' already exists');
        }
    }
}
