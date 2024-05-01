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
                        <form action="{{route('user_list.destroy', $user->id)}}"
                              onclick="deleteUser({{$user->id}})" method="post" id="delete">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" class="btn"><i class="fa-solid fa-trash"
                                                                 style="color: red"></i>
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
