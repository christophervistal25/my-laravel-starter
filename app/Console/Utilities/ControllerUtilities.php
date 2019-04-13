<?php 
namespace App\Console\Utilities;

use App\Console\Utilities\StringHelpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ControllerUtilities {

    // TODO extract all views related method to it's own class
    // TODO extract all resources related method to an abstract class
    // TODO extract all constant to an abstract class
    // TODO the only method that will appear is the make()
    // Todo make an trait for getNamespace method

    use StringHelpers;

    private const options = [
        'namespace'          => 'app\http\controllers',
        'controller'         => 'Controller',
        'illuminate_request' => 'use Illuminate\Http\Request;',
        'request_params'     => 'Request $request',
    ];

    private const docs = [
    'index' => '/**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */',
     
    'create' => '/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */',
   
     'store' => '/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */',
    
    'show' => '/** 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */',
    
    'edit' => '/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */',
    
    'update' => '/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */',
    
    'destroy' => '/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */',
    ];
    

    public function getNamespace()
    {
        return Str::title(self::options['namespace']);
    }

    private function indexMethod()
    {
        return "
    ".self::docs['index']."
     public function index() 
     {
        //
     }";
    }

    private function createMethod()
    {
        return "
    ".self::docs['create']."
    public function create()
    {
        //
    }";
    }

    private function storeMethod()
    {
        return "
    ".self::docs['store']."
    public function store(".self::options['request_params'].") 
    {
        //
    }";
    }

    private function showMethod() 
    {
        return "
     ".self::docs['show']."
    public function show(".'$id'.") 
    {
        //
    }";
    }

    private function editMethod()
    {
        return "
    ".self::docs['edit']."
    public function edit(".'$id'.") 
    {
        //
    }";
    }

    private function updateMethod()
    {
        return "
     ".self::docs['update']."
    public function update(".self::options['request_params'].",".'$id'.") 
    {
        //
    }";
    }

    private function destroyMethod()
    {
        return "
    ".self::docs['destroy']."
    public function delete(".'$id'.") 
    {
        //
    }";
    }

    private function addResourceMethods()
    {
        return $this->indexMethod() . $this->addCharacters("\n",2) .
               $this->createMethod() . $this->addCharacters("\n",2) . 
               $this->storeMethod() . $this->addCharacters("\n",2) .
               $this->showMethod() . $this->addCharacters("\n",2) .
               $this->editMethod() . $this->addCharacters("\n",2) .
               $this->updateMethod() . $this->addCharacters("\n",2) .
               $this->destroyMethod() . $this->addCharacters("\n",2) ;
    }

    public function make(string $class , bool $resource)
    {
        $namespace = $this->getNamespace();
        
        $contents = "<?php

namespace {$this->getNamespace()};

".self::options['illuminate_request']."

class {$class} extends ".self::options['controller']." {
    ".($resource ? $this->addResourceMethods() : "//")."
}";

    File::put("${namespace}/{$class}.php",
        $contents);
    }

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
