<?php

namespace Gfoliver\Structure\Commands;

use Illuminate\Console\Command;

abstract class Make extends Command
{
    const SOURCES_DIR = __DIR__ . '/../Sources/';

    protected $defaultFolders = ['.', '..', 'Constants', 'QueryFilters', 'Traits', 'Utils', 'Models'];

    protected abstract function getConstName(): string;

    protected function hasMultipleEnvironments()
    {
        // read if core folder has environments by checking if a folder Services os Repositories exists directly under the App/Core directory
        return !is_dir(app_path('Core/Services'));
    }

    protected function getEnvironments()
    {
        // read the Core folder and get the environments
        $environments = [];
        $corePath = app_path('Core');
        $directories = scandir($corePath);
        foreach ($directories as $directory) {
            if (! in_array($directory, $this->defaultFolders)) {
                $environments[] = $directory;
            }
        }

        return $environments;
    }

    protected function studly(string $value): string
    {
        return \str_replace(' ', '', \ucwords(\str_replace(['-', '_'], ' ', $value)));
    }

    protected function source(string $file): string
    {
        return self::SOURCES_DIR . $file;
    }

    protected function destination(string $environment, string $destination, string $name)
    {
        return app_path('Core/' . ($environment ? $environment . '/' : '') . $destination . '/' . $name . '.php');
    }

    protected function save(string $source, string $environment, string $namespace, string $name, string $destination)
    {
        $contents = file_get_contents($this->source($source));
        $contents = str_replace('NAMESPACENAME', $namespace, $contents);
        $contents = str_replace($this->getConstName() . 'NAME', $name, $contents);
        file_put_contents($this->destination($environment, $destination, $name), $contents);
    }
}
