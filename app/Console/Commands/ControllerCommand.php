<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Container\Container;
use App\Console\Utilities\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class ControllerCommand extends Command
{
    private const APP = "\App\\";
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
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
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
        $choices = $this->choice('Do you want to add a resource view for this controller?'
                                , ['No', 'Yes'],1);
        $resourceView = ($choices === 'Yes') ? true : false;

        if ($resourceView) {
            
            // Ask what is the name of model
            $model = $this->ask('Please input the name of the model');
            $except = [
                '.' , 
                '..' , 
                'Console' , 
                'Exceptions' , 
                'Http' , 
                'Providers' , 
            ];

            // Rebase and remove . and .. in array list of files
            $files = array_values(array_diff(scandir(app_path()), $except));

            $modelExists = in_array(Str::studly($model) . '.php' , $files);
            
            if ($modelExists) {
                
                $model = (self::APP . $model);

                $fillable = (new $model())->getFillable();
                
                $this->controller->view->setItems($fillable);

            } else {
                // Create a model
            }
        }

        $this->controller
                ->make($controllerName , $this->options()['resource'],$resourceView);

        $this->info('Successfully create new controller.');
    }
}
