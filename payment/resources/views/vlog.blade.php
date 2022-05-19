<form method="Post" action="{{route('vlog.store')}}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="name" name="name" 
            placeholder="Enter name" required>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Vlog1</label>
        <input type="text" class="form-control" id="vlog1" placeholder="vlog1" name="vlog1">
        @error('vlog1')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="Password1">Vlog2</label>
        <input type="text" class="form-control" id="vlog2" placeholder="vlog2" name="vlog2">
        @error('vlog2')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="vlog1">Vlog3</label>
        <input type="text" class="form-control" id="vlog3" placeholder="vlog3" name="vlog3">
        @error('vlog3')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
