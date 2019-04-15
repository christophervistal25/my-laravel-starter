<?php 
namespace App\Console\Utilities;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Console\Utilities\Abstracts\AbstractView;

class View extends AbstractView {

    private $directory;
    private $items = [];

    private function setDirectory(string $directory)
    {
        $this->directory = $directory;
        return $this;
    }

    public function setItems(array $items = [])
    {
        $this->items = $items;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addModalContent()
    {
         $content = null;

         array_walk($this->items, function ($value) use (&$content) {
            $label = Str::studly($value);
            $content .= "
                <div class='form-group'>
                    <label for='#".$label."'>".$label."</label>
                    <input type='text' name='".$value."' id='".$label."'>
                </div>
            ";
         });

        return $content;
    }

    public function addEditContent()
    {
         $content = "
                <!-- ADD THE MODEL PRIMARY KEY HERE -->
                <div class='form-group'>
                    <input type='hidden'  id='primaryKey'>
                </div>
         ";
         array_walk($this->items, function ($value) use (&$content) {
            $label = Str::studly($value);
            $content .= "
                <div class='form-group'>
                    <label for='#".$label."'>".$label."</label>
                    <input type='text' name='".$value."' id='".$label."'>
                </div>
            ";
         });

        return $content;
    }

     public function addDeleteContent()
    {
       $content = "
                <!-- ADD THE MODEL PRIMARY KEY HERE -->
                <h4 class='text-center'>Are you sure you want to delete?</h4>
                <div class='form-group'>
                    <input type='hidden'  id='primaryKey'>
                </div>
         ";
        return $content;
    }

    public function getindexViewContent()
    {
      return '@extends("templates.dashboard")
@section("content")
<!-- INSERT THE MODAL NAME AT data-target ATTRIBUTE -->
<a href="#" data-toggle="modal" data-target="" class="float-right btn btn-info mb-3 shadow font-weight-bold">Add new item</a>
<div class="clearfix"></div>
<table id="items-table" class="table table-bordered">
    <thead class="text-center">
        <tr>
        <td class="text-capitalize">' . implode($this->items , '</td><td class="text-capitalize">') . '</td>
        <td>ACTIONS</td>
        </tr>
    </thead>
    <tbody class="text-center">
            <!-- CHANGE THE MODEL NAME -->
            @foreach($modelname as $model) 
                <tr>
                    '.str_repeat('<td>{{$model->}}</td>', count($this->items)).'    
                    <!-- ADD THE EDIT AND DELETE MODAL NAME HERE -->
                    <td><a href="#">EDIT</a> | <a href="#">DELETE</a></td>
                </tr>
            @endforeach
    </tbody>
</table>
  <!-- Add Modal-->
    <div class="modal fade" id="modalName" tabindex="-1" role="dialog" aria-labelledby="modalName" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalName">Add new item</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          <!-- ADD FORM ACTION HERE -->
            <form action="">
                @csrf '.$this->addModalContent().'
          </div>
          <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>

 <!-- Edit Modal-->
    <div class="modal fade" id="editModalName" tabindex="-1" role="dialog" aria-labelledby="editModalName" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalName">Edit Item</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
               <!-- ADD FORM ACTION HERE -->
                <form action="">
                    @csrf '.$this->addEditContent().'
              </div>
          </div>
          <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary text-white" >Update</button>
                </form>
          </div>
        </div>
      </div>
    </div>

<!-- Delete Modal-->
    <div class="modal fade" id="deleteModalName" tabindex="-1" role="dialog" aria-labelledby="deleteModalName" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalNames">Delete an item</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body p-1">
                <form action="">
                    @csrf '.$this->addDeleteContent().'
              </div>
          </div>
          <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger text-white" >Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection';

    }



    public function getCreateViewContent()
    {
        $form_content = null;
        array_walk($this->items, function($value) use (&$form_content) {
            $form_content .= '
            <div class="form-group">
                <label>'.Str::studly($value).' : </label>
                <input type="text" name="'.$value.'" class="form-control form-control-user form-control{{ $errors->has("'.$value.'") ? " is-invalid" : "" }}" value="{{ old("'.$value.'") }}" placeholder="Enter '.Str::studly($value).'...">
                
                @if ($errors->has("'.$value.'"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("'.$value.'") }}</strong>
                </span>
                @endif
            </div>
            ';
        });

        $content =  '@extends("templates.dashboard")
@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create</h6>
    </div>
    <div class="card-body">
        <!-- PLEASE DON\'T FORGET TO FILL ACTION ATTRIBUTE -->
        <form action="" method="POST">
            @csrf
            '.$form_content.'
            <input type="submit" value="Add" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection';

        return $content;
    }

   

    public function getShowViewContent()
    {
      $form_content = null;
        array_walk($this->items, function($value) use (&$form_content) {
            $form_content .= '
            <div class="form-group">
                <!-- ADD MODEL ON EACH VALUE OF INPUT -->
                <label>'.Str::studly($value).' : </label>
                <input type="text" name="'.$value.'" class="form-control form-control-user form-control{{ $errors->has("'.$value.'") ? " is-invalid" : "" }}" value="{{ $model->'.$value.' }}" placeholder="Enter '.Str::studly($value).'...">
                
                @if ($errors->has("'.$value.'"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("'.$value.'") }}</strong>
                </span>
                @endif
            </div>
            ';
        });

        $content =  '@extends("templates.dashboard")
@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
        <form>
            '.$form_content.'
            <!-- ADD SOME ROUTE HERE -->
            <a href="#" class="btn btn-success">EDIT</a>
        </form>
    </div>
</div>
@endsection';
  return $content;
    }

    public function getUpdateContent()
    {

    }


    private function addView(string $name , string $content = null)
    {
        // Initialize Location for the file
        $location = resource_path('views/' . $this->directory . '/' . $name . '.blade.php') ;

        // Create a file with the corresponding name and directory
        $file = fopen($location,'w');

        // Add some content to the file
        fwrite($file,$content);

        return $this;
    }

    public function isViewResourceNeed(bool $resource , string $name)
    {
        $resource ? $this->addViewResource($name) : null;
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
             ->addView('index' , $this->getindexViewContent())
             ->addView('create' , $this->getCreateViewContent());
             // ->addView('delete');
    }

}

