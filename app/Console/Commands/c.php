<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Container\Container;
use App\Console\Utilities\ControllerUtilities;

class c extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:controller {name} {--r|resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new controll with resource view';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ControllerUtilities $controllerUtil)
    {
        $this->controller = $controllerUtil;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $controllerName = Str::studly($this->argument('name'));
        
        if ($this->options()['resource']) {

            $this->controller
                    ->make($controllerName , true);

            $this->controller
                    ->addViewResource(Str::lower($controllerName));

            $this->info('Resource view successfully created.');
            
        } else {
            $this->controller
                    ->make($controllerName , false);
        }
        
        $this->info('Successfully create new controller.');
    }
}
