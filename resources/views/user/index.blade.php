@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="alert alert-success" style="display: none" id="message"></div>
                <form method="post" action="{{ route('user_list.store') }}" id="userForm">
                    @csrf
                    <div class="mb-3">
                        <label for="surname" class="form-label">Введіть прізвище та імʼя</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Ваше прізвище та імʼя" value="{{ old('name') }}">
                        @error('name')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3" id="phoneFields">
                        <label for="phones" class="form-label">Телефон</label>
                        <div class="input-group">
                            <input type="tel" class="form-control" id="phones[]" name="phones[]"
                                   placeholder="09*0000000">
                            <button type="button" class="btn btn-success" onclick="addPhoneField()"><i
                                    class="fas fa-plus"></i></button>
                        </div>
                        @error('phones')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Додати</button>
                </form>
            </div>
        </div>
        <hr>
        @include('components.table')
    </div>
@endsection
