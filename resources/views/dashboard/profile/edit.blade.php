@extends('layout.dashboard')

@section('title')
    Profile User
@endsection

@section('content')
    <form action="{{ route('dashboard.profile.update') }}" method="post">
        @method('patch')
        @csrf

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mt-3 w-2">
            {{ $error }}
        </div>
        @endforeach
    @endif

        <div class="form-group">
            <label for="exampleInputEmail1">First Name</label>
            <input type="text" name="first_name" value="{{ $user->profile->first_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp"  placeholder="Enter email" value="{{ $user->profile->last_name }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Birthday</label>
            <input type="date" name="birthday" class="form-control" id="exampleInputPassword1"
                placeholder="Phone Number" value="{{ $user->profile->birthday }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Street Adress</label>
            <input type="text" name="street_address"  class="form-control" id="exampleInputPassword1"
                placeholder="Street Adress" value="{{ $user->profile->street_address }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">State</label>
            <input type="text" name="state" class="form-control" id="exampleInputPassword1"
                placeholder="state" value="{{ $user->profile->state }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">postal_code</label>
            <input type="text" name="postal_code" class="form-control" id="exampleInputPassword1"
                placeholder="postal_code" value="{{ $user->profile->postal_code }}">
        </div>

        <div class="form-check">
            <label for="exampleInputPassword1">Gender</label>
        </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" @checked($user->profile->gender)>
        <label class="form-check-label" for="exampleRadios1">
            Male
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="female" @checked($user->profile->gender)>
        <label class="form-check-label" for="exampleRadios2">
            Female
        </label>
    </div>


        <label class="form-check-label" for="exampleRadios2">
            Countries
        </label>
        <select name="country" class="form-select" aria-label="Default select example">
            @foreach ($countries as $country)
            <option name='country'> {{ $country }} </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
