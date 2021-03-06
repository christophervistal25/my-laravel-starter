@extends("templates.dashboard")
@section("content")
<!-- INSERT THE MODAL NAME AT data-target ATTRIBUTE -->
<a href="#" data-toggle="modal" data-target="" class="float-right btn btn-info mb-3 shadow font-weight-bold">Add new item</a>
<div class="clearfix"></div>
<table id="items-table" class="table table-bordered">
    <thead class="text-center">
        <tr>
        <td class="text-capitalize">name</td><td class="text-capitalize">email</td><td class="text-capitalize">password</td>
        <td>ACTIONS</td>
        </tr>
    </thead>
    <tbody class="text-center">
            <!-- CHANGE THE MODEL NAME -->
            @foreach($modelname as $model) 
                <tr>
                    <td>{{$model->}}</td><td>{{$model->}}</td><td>{{$model->}}</td>    
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
                @csrf 
                <div class='form-group'>
                    <label for='#Name'>Name</label>
                    <input type='text' name='name' id='Name'>
                </div>
            
                <div class='form-group'>
                    <label for='#Email'>Email</label>
                    <input type='text' name='email' id='Email'>
                </div>
            
                <div class='form-group'>
                    <label for='#Password'>Password</label>
                    <input type='text' name='password' id='Password'>
                </div>
            
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
                    @csrf 
                <!-- ADD THE MODEL PRIMARY KEY HERE -->
                <div class='form-group'>
                    <input type='hidden'  id='primaryKey'>
                </div>
         
                <div class='form-group'>
                    <label for='#Name'>Name</label>
                    <input type='text' name='name' id='Name'>
                </div>
            
                <div class='form-group'>
                    <label for='#Email'>Email</label>
                    <input type='text' name='email' id='Email'>
                </div>
            
                <div class='form-group'>
                    <label for='#Password'>Password</label>
                    <input type='text' name='password' id='Password'>
                </div>
            
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
                    @csrf 
                <!-- ADD THE MODEL PRIMARY KEY HERE -->
                <h4 class='text-center'>Are you sure you want to delete?</h4>
                <div class='form-group'>
                    <input type='hidden'  id='primaryKey'>
                </div>
         
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
@endsection