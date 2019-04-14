<?php 
namespace App\Console\Utilities;

use App\Console\Utilities\Abstracts\ControllerResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ControllerUtilities extends ControllerResource {

    private $view;

    public function __construct(ViewUtilities $view)
    {
        $this->view = $view;
    }
   
    public function make(string $class , bool $resource , bool $resourceView = false)
    {

        $namespace = self::options['namespace'];

        $hasADirectory = Str::contains($class , ['\\','/']);

        // Split the given name
        $directories = preg_split('~[\\\\/]~', $class);

        // Get the filename which is the last element of array
        // otherwise just assign the default classname
        $fileName = ($hasADirectory && is_array($directories))
                                    ? array_pop($directories) : $class;
        // Make a directory
        if ($hasADirectory) {
            $namespace =  self::options['namespace'] . DIRECTORY_SEPARATOR . implode($directories , DIRECTORY_SEPARATOR);
            
            File::isDirectory($namespace) or File::makeDirectory($namespace, 0777, true, true);
        } 

        // Prepare a content for the controller
        $contents = "<?php

namespace ".$namespace.";

".self::options['illuminate_request']."

class {$fileName} extends ".self::options['controller']." {
    ".($resource ? $this->addResourceMethods() : "//")."
}";
        
        // Make a file and put the prepared contents
        File::put($namespace . DIRECTORY_SEPARATOR . $fileName . ".php",
            $contents);

        if ($resourceView) {
            $this->view->addViewResource(Str::lower($fileName));
        }

    }

}
