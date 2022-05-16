<div class="row">
    <label class="col-sm-2 col-form-label" for="username">{{$submit}} User</label>
    <div class="col-sm-7">
        <input class="form-control" autoComplete='off' name="name" id="username" type="text" placeholder="username" value="{{ $user->name }}" required />
        @error('name')
            <div class="text-danger"> {{$message}} </div>
        @enderror
    </div>
</div>
<div class="row pt-3">
    <label class="col-sm-2 col-form-label" for="email">E - mail</label>
    <div class="col-sm-7">
        <input class="form-control" autoComplete='off' name="email" id="email" type="email" placeholder="E-mail" value="{{ $user->email }}" required />
        @error('email')
            <div class="text-danger"> {{$message}} </div>
        @enderror
    </div>
</div>

<div class="row pt-3">
    <label class="col-sm-2 col-form-label" for="password">password</label>
    <div class="col-sm-7">
        <input class="form-control" autoComplete='off' name="password" id="password" type="password" placeholder="password" value="{{ $user->password }}" required />
        @error('password')
            <div class="text-danger" >{{$message}}</div>
        @enderror
    </div>
</div>
<div class="card-footer ml-auto mr-auto">
    <button type="submit" class="btn btn-primary"> {{$submit}} </button>
</div>
