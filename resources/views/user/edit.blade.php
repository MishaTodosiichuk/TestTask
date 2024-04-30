@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                @if (session ('status'))
                    <div class="alert alert-success">
                        {{session ('status')}}
                    </div>
                @endif
                <a href="{{route('user_list.index')}}" class="btn btn-warning mb-3">Повернутись назад</a>
                <form action="{{route('user_list.store')}}" method="post" id="userForm">
                    @csrf
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
                    <button type="submit" class="btn btn-primary mt-3">Змінити</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#userForm').submit(function (event) {
                var name = $('#name').val();
                if (name.trim() === '') {
                    alert('Будь ласка, введіть прізвище та імʼя');
                    event.preventDefault();
                }

                var phones = $('input[name^="phones"]');
                var phoneEmpty = false;
                phones.each(function () {
                    var phone = $(this).val().trim();
                    if (phone === '') {
                        phoneEmpty = true;
                        return false;
                    } else if (phone.length < 10 || phone.length > 20) {
                        alert('Телефон повинен містити від 10 до 20 символів');
                        event.preventDefault();
                        return false;
                    }
                });

                if (phoneEmpty) {
                    alert('Будь ласка, заповніть всі поля для телефону');
                    event.preventDefault();
                }
            });
        });
    </script>

@endsection

