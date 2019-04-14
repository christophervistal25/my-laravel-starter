<?php 
namespace App\Console\Utilities;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ViewUtilities {

    private $directory;

    private function setDirectory(string $directory)
    {
        $this->directory = $directory;
        return $this;
    }

    private function addView(string $name)
    {
        // Create a file with the corresponding name and directory
        fopen(
            resource_path('views/' . $this->directory . '/' . $name . '.blade.php')
        ,'w');

        return $this;
    }

    public function addViewResource(string $controllerName)
    {
        // Remove the string controller and change it to plural
        $directory = Str::plural(
            str_replace('controller', '', Str::lower($controllerName))
        );

        // Prepare a location
        $path = resource_path('views/') . $directory;

        // Make an directory
        File::makeDirectory($path, $mode = 0777, true, true);
        
        // Add view to the directory
        $this->setDirectory($directory)
             ->addView('index')
             ->addView('show')
             ->addView('edit')
             ->addView('delete');
    }

}

