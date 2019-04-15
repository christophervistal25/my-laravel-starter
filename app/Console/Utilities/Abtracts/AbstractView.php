<?php 
namespace App\Console\Utilities\Abstracts;

abstract class AbstractView {
    abstract public function setItems(array $items = []);
    abstract public function getindexViewContent();
    abstract public function getCreateViewContent();
    abstract public function getShowViewContent();
    abstract public function getUpdateContent();
}
