@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Add Roles</div>
                  <div class="card-body">
 
                    @if($user[0]->type == 'Admin') 
                      <form action="{{ route('usertype.store') }}" method="POST">
                          @csrf
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">user type</label>
                              <div class="col-md-6">
                                  <input type="text" id="user_type" class="form-control" name="user_type" required>
                                  @if ($errors->has('user_type'))
                                      <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Add
                              </button>
                          </div>
                      </form>

                    
                    @else
                    
                        You Don't Have Permission!
                
                    @endif
                        

                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection