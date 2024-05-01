<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{f csrf_token () }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/18c4a34d75.js" crossorigin="anonymous"></script>
    <title>Тестове завдання</title>
</head>
<body>
    @include('components.header')
    @yield('content')
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

        $('#addUser').on('submit', function (event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $('#addUser').serialize(),
                type: 'post',
                success: function (result) {
                    $('#message').css('display', 'block');
                    $('#message').html(result.message);
                    $('#addUser')[0].reset();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Помилка при відправці форми. Спробуйте ще раз.');
                }
            });
        });

        function updateUser(id) {
            $('#updateUser').on('submit', function (event) {
                let url = $(this).attr('action');
                $.ajax({
                    url: url +'/'+id,
                    data: $('#updateUser').serialize(),
                    type: 'PUT',
                    success: function (result) {
                        $('#message').css('display', 'block');
                        $('#message').html(result.message);
                        $('#addUser')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Помилка при відправці форми. Спробуйте ще раз.');
                    }
                });
            })
        }

        function deleteUser(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = $(this).attr('action');
            $.ajax({
                url: url + "/" + id,
                type: 'DELETE',
                success: function (result) {
                    alert($('#message').text());
                }
            });
        }

        function addPhoneField() {
            const phoneFields = document.getElementById("phoneFields");

            const newPhoneField = document.createElement("div");
            newPhoneField.className = "mb-3";
            newPhoneField.innerHTML = `
        <div class="input-group mt-3">
            <input type="tel" class="form-control" id="phones[]" name="phones[]" placeholder="09*0000000">
            <button type="button" class="btn btn-danger" onclick="removePhoneField(this)"><i class="fas fa-minus"></i></button>
            </div>
`;

            phoneFields.appendChild(newPhoneField);
        }

        function removePhoneField(button) {
            const phoneField = button.parentNode.parentNode;
            phoneField.parentNode.removeChild(phoneField);
        }
    </script>
</body>
</html>
