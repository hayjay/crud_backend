 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Welcome!</title>
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Todo App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            
          </ul>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
            @csrf
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
          </form>
        </div>
      </nav>


      <div class="row mt-4">
        <div class="col-sm-8">
          @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
              {{ session()->get('success') }}
            </div>
          @elseif(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
          @endif
         
          <form method="POST" action="{{ route('store_todo') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">

              <div class="col-lg-7">

                <div class="form-group">
                  <label for="exampleInputEmail1">Todo: </label>
                  <input type="text" placeholder="Please enter your todo here" class="form-control" name="todo" value="{{ old('todo') }}" id="" aria-describedby="">
                  @if ($errors->has('todo')) <small id="emailHelp" class="form-text text-muted">{{ $errors->first('todo') }}.</small> @endif
                </div>

              </div>
              <div class="col-sm-3">

                <div class="form-group">
                  <label for="exampleInputEmail1">Status: </label>
                  <select name="status" id="inputStatus" class="form-control" required="required">
                    <option value="">Select One</option>
                    @if(isset($statuses))
                      @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                      @endforeach
                    @endif
                  </select>
                  @if ($errors->has('status')) <small id="emailHelp" class="form-text text-muted">{{ $errors->first('status') }}.</small> @endif
                </div>

              </div>
              <div class="col-sm-2 mt-4">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>

            </div>
            
          </form>
        </div>
        
      </div>

       <div class="row mt-4">
        <div class="col-sm-7">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Todo</th>
                  <th>Status</th>
                  <th>Created By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($todos as $todo)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo['name'] }}</td>
                    <td>{{ $todo['status'] }}</td>
                    <td>{{ $todo['owner']. "(Me)" }}</td>
                    <td><a href="#modal-id{{ $todo['id'] }}" data-toggle="modal">Update</a></td>
                  </tr>

                  <div class="modal fade" id="modal-id{{ $todo['id'] }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          {{-- <h4 class="modal-title">Update </h4> --}}
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ route('update_todo', ['todo' => $todo['id'] ]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put') 
                            {{ csrf_field() }}
                           
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Todo: </label>
                                  <input type="text" placeholder="Please enter your todo here" class="form-control" name="todo" value="{{ $todo['name'] ?? old('todo') }}" id="" aria-describedby="">
                                  @if ($errors->has('todo')) <small id="emailHelp" class="form-text text-muted">{{ $errors->first('todo') }}.</small> @endif
                                </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Status: </label>
                                    <select name="status" id="inputStatus" class="form-control" required="required">
                                      <option value="">Select One</option>
                                      @if(isset($statuses))
                                        @foreach($statuses as $status)
                                          <option value="{{ $status->id }}" @if($todo['status'] == $status->name) selected="" @endif>{{ $status->name }}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                    @if ($errors->has('status')) <small id="emailHelp" class="form-text text-muted">{{ $errors->first('status') }}.</small> @endif
                                  </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <br>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>