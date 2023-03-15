<?php

namespace Gfoliver\Structure\Commands;

class MakeRepository extends Make
{
    protected $signature = 'make:repository';

    protected $description = 'Create a new repository';

    protected function getConstName(): string
    {
        return 'REPO';
    }

    public function handle()
    {
        $this->info('Creating a new repository!');
        $this->info('=============================');
        $this->newLine(2);

        $name = $this->ask('Repository name:');
        // turn name into StudlyCase
        $name = $this->studly($name);
        
        $environment = null;

        if ($this->hasMultipleEnvironments()) {
            $environments = $this->getEnvironments();
            $environment = $this->choice('Environment:', $environments);
        }

        $namespace = 'App\\Core\\' . ($environment ? $environment . '\\' : '') . 'Repositories';

        $this->save('IRepository.php', $environment, $namespace, 'I' . $name, 'Repositories/Contracts');
        $this->save('Repository.php', $environment, $namespace, $name, 'Repositories');

        $this->newLine(2);

        $this->info('All done!');
    }
}
