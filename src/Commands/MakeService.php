<?php

namespace Gfoliver\Structure\Commands;

class MakeService extends Make
{
    protected $signature = 'make:service';

    protected $description = 'Create a new service';

    protected function getConstName(): string
    {
        return 'SERVICE';
    }

    public function handle()
    {
        $this->info('Creating a new service!');
        $this->info('=============================');
        $this->newLine(2);

        $name = $this->ask('Service name:');
        // turn name into StudlyCase
        $name = $this->studly($name);
        // if the name doesnt include Service, add it
        if (!str_contains($name, 'Service')) {
            $name .= 'Service';
        }

        $environment = null;

        if ($this->hasMultipleEnvironments()) {
            $environments = $this->getEnvironments();
            $environment = $this->choice('Environment:', $environments);
        }

        $namespace = 'App\\Core\\' . ($environment ? $environment . '\\' : '') . 'Services';

        $this->save('IService.php', $environment, $namespace, 'I' . $name, 'Services/Contracts');
        $this->save('Service.php', $environment, $namespace, $name, 'Services');

        $this->newLine(2);

        $this->info('All done!');
    }
}
