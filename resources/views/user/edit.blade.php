@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="{{route('user_list.index')}}" class="btn btn-warning mb-3">Повернутись назад</a>
                <form action="{{route('user_list.update', $userList->id)}}" method="post" id="userForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="surname" class="form-label">Введіть прізвище та імʼя</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Ваше прізвище та імʼя" value="{{ $userList->name }}">
                        @error('name')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3" id="phoneFields">
                        <label for="phones" class="form-label">Телефон</label>
                        @foreach($userList->phones as $phone)
                        <div class="input-group mt-3">
                            <input type="tel" class="form-control" id="phones[]" name="phones[]" value="{{$phone->phone_num}}">
                        </div>
                        @endforeach
                        @error('phones')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" onclick="updateUser({{$userList->id}})">Змінити</button>
                </form>
            </div>
        </div>
    </div>
@endsection

