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
                <form action="{{route('user_list.store')}}" method="post" id="userForm">
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
                            <input type="tel" class="form-control" id="phones[]" name="phones[]" placeholder="09*0000000">
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
        <div class="row">
            <div class="col">
                <table class="table table-hover table-bordered" style="text-align: center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Прізвище та імʼя</th>
                        <th scope="col">Телефони</th>
                        <th scope="col" colspan="2">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>
                                @foreach($user->phones as $phone)
                                    <span>{{$phone['phone_num']}}</span><br>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{route('user_list.destroy', $user->id)}}" method="post" id="delete">
                                    @csrf
                                    @method ('DELETE')
                                    <button type="submit" class="btn"><i class="fa-solid fa-trash" style="color: red"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{route('user_list.edit', $user->id)}}" class="btn" style="color: green"><i
                                        class="fa-solid fa-pen"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links('pagination::bootstrap-4') }}
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

                var phones = $('input[name^="phones"]')
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
                })

                if (phoneEmpty) {
                    alert('Будь ласка, заповніть всі поля для телефону');
                    event.preventDefault();
                }
            });
        });
    </script>
    <script>
        function addPhoneField() {
            const phoneFields = document.getElementById("phoneFields");

            const newPhoneField = document.createElement("div");
            newPhoneField.className = "mb-3";
            newPhoneField.innerHTML = `
            <div class="input-group mt-3">
                <input type="tel" class="form-control" id="phones[]" name="phones[]" placeholder="09*0000000">
                <button type="button" class="btn btn-danger" onclick="removePhoneField(this)"><i class="fas fa-minus"></i></button>
                @error('phones')
            <div class="alert alert-danger mt-4">
{{ $message }}
            </div>
@enderror
            </div>
`;

            phoneFields.appendChild(newPhoneField);
        }

        function removePhoneField(button) {
            const phoneField = button.parentNode.parentNode;
            phoneField.parentNode.removeChild(phoneField);
        }
    </script>


@endsection
