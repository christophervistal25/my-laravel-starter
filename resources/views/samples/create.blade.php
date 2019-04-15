@extends("templates.dashboard")
@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create</h6>
    </div>
    <div class="card-body">
        <!-- PLEASE DON'T FORGET TO FILL ACTION ATTRIBUTE -->
        <form action="" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Name : </label>
                <input type="text" name="name" class="form-control form-control-user form-control{{ $errors->has("name") ? " is-invalid" : "" }}" value="{{ old("name") }}" placeholder="Enter Name...">
                
                @if ($errors->has("name"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("name") }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group">
                <label>Email : </label>
                <input type="text" name="email" class="form-control form-control-user form-control{{ $errors->has("email") ? " is-invalid" : "" }}" value="{{ old("email") }}" placeholder="Enter Email...">
                
                @if ($errors->has("email"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("email") }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group">
                <label>Password : </label>
                <input type="text" name="password" class="form-control form-control-user form-control{{ $errors->has("password") ? " is-invalid" : "" }}" value="{{ old("password") }}" placeholder="Enter Password...">
                
                @if ($errors->has("password"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("password") }}</strong>
                </span>
                @endif
            </div>
            
            <input type="submit" value="Add" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection