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
                <label>Test : </label>
                <input type="text" name="test" class="form-control form-control-user form-control{{ $errors->has("test") ? " is-invalid" : "" }}" value="{{ old("test") }}" placeholder="Enter Test...">
                
                @if ($errors->has("test"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("test") }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group">
                <label>Test2 : </label>
                <input type="text" name="test2" class="form-control form-control-user form-control{{ $errors->has("test2") ? " is-invalid" : "" }}" value="{{ old("test2") }}" placeholder="Enter Test2...">
                
                @if ($errors->has("test2"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("test2") }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group">
                <label>Test3 : </label>
                <input type="text" name="test3" class="form-control form-control-user form-control{{ $errors->has("test3") ? " is-invalid" : "" }}" value="{{ old("test3") }}" placeholder="Enter Test3...">
                
                @if ($errors->has("test3"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("test3") }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group">
                <label>Test4 : </label>
                <input type="text" name="test4" class="form-control form-control-user form-control{{ $errors->has("test4") ? " is-invalid" : "" }}" value="{{ old("test4") }}" placeholder="Enter Test4...">
                
                @if ($errors->has("test4"))
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $errors->first("test4") }}</strong>
                </span>
                @endif
            </div>
            
            <input type="submit" value="Add" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection