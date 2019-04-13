<?php 
namespace App\Console\Utilities;

trait StringHelpers {

    public function addCharacters(string $character,int $count = 1)
    {
        return str_repeat($character, $count);
    }

}