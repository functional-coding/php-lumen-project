<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    protected function getCommands()
    {
        $path = base_path('app/Console/Commands');
        $dir = new \RecursiveDirectoryIterator($path);
        $list = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator($list, '/.+\.php$/');
        $commands = parent::getCommands();

        foreach ($files as $file) {
            require_once $file->getPathname();
        }

        $classes = new \RegexIterator(new \ArrayIterator(get_declared_classes()), '/Commands/');
        $classes = iterator_to_array($classes);
        sort($classes);

        foreach ($classes as $class) {
            $reflect = new \ReflectionClass($class);

            if (!$reflect->isAbstract()) {
                array_push($commands, $class);
            }
        }

        return $commands;
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
    }
}
