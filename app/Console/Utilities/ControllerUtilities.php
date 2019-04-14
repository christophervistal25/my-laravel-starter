<?php 
namespace App\Console\Utilities;

use App\Console\Utilities\Abstracts\ControllerResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ControllerUtilities extends ControllerResource {

    // TODO if the resource is true and resource view also set to true
    // then add a return view each method in controller.
    // TODO add Route model binding for controller resource methods.
    // TODO add abstract class for View insert all constants values on it.
    // TODO if the view already has a content ask first the user if it wants to override it.

    private $view;

    public function __construct(ViewUtilities $view)
    {
        $this->view = $view;
    }

    private function contentForController(array $controller = [])
    {   
        return "<?php

namespace ".$controller['namespace'].";

".self::options['illuminate_request']."

class {$controller['name']} extends ".self::options['controller']." {
    ".($controller['resource'] ? $this->addResourceMethods() : "//")."
}";
    }
   
    public function make(string $class , bool $resource , bool $resourceView = false)
    {

        $namespace = self::options['namespace'];

        $hasADirectory = Str::contains($class , ['\\','/']);

        // Split the given name by / or \
        $directories = preg_split('~[\\\\/]~', $class);

        // Get the filename which is the last element of array
        // otherwise just assign the default classname
        $fileName = ($hasADirectory && is_array($directories))
                                    ? array_pop($directories) : $class;
        if ($hasADirectory) {

            $namespace =  self::options['namespace'] .
                          DIRECTORY_SEPARATOR .
                          implode($directories , DIRECTORY_SEPARATOR);

            File::isDirectory($namespace) or File::makeDirectory($namespace, 0777, true, true);
        } 

        // Make a file and put the controller contents 
        // depending on user inputted options
        File::put($namespace . DIRECTORY_SEPARATOR . $fileName . ".php",
            $this->contentForController([
                'namespace' => $namespace,
                'name'      => $fileName,
                'resource'  => $resource
        ]));

        // Will check if views for controller is need
        $this->view->isViewResourceNeed($resourceView , Str::lower($fileName));

    }

}
