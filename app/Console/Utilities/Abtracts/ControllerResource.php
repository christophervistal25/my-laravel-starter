<?php 
namespace App\Console\Utilities\Abstracts;
use App\Console\Utilities\StringHelpers;
abstract class ControllerResource {
    
    use StringHelpers;

    public const options = [
        'namespace'          => 'App\Http\Controllers',
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

    protected function indexMethod()
    {
        return "
    ".self::docs['index']."
     public function index() 
     {
        //
     }";
    }

    protected function createMethod()
    {
        return "
    ".self::docs['create']."
    public function create()
    {
        //
    }";
    }

    protected function storeMethod()
    {
        return "
    ".self::docs['store']."
    public function store(".self::options['request_params'].") 
    {
        //
    }";
    }

    protected function showMethod() 
    {
        return "
     ".self::docs['show']."
    public function show(".'$id'.") 
    {
        //
    }";
    }

    protected function editMethod()
    {
        return "
    ".self::docs['edit']."
    public function edit(".'$id'.") 
    {
        //
    }";
    }

    protected function updateMethod()
    {
        return "
     ".self::docs['update']."
    public function update(".self::options['request_params'].",".'$id'.") 
    {
        //
    }";
    }

    protected function destroyMethod()
    {
        return "
    ".self::docs['destroy']."
    public function delete(".'$id'.") 
    {
        //
    }";
    }

    protected function addResourceMethods()
    {
        return $this->indexMethod()   . $this->addCharacters("\n",2).
               $this->createMethod()  . $this->addCharacters("\n",2). 
               $this->storeMethod()   . $this->addCharacters("\n",2).
               $this->showMethod()    . $this->addCharacters("\n",2).
               $this->editMethod()    . $this->addCharacters("\n",2).
               $this->updateMethod()  . $this->addCharacters("\n",2).
               $this->destroyMethod() . $this->addCharacters("\n",2);
    }

}

