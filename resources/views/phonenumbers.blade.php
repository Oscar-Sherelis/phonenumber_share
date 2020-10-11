<style>
.phonenumbers-section__content {
    display: flex;
    justify-content: space-between;
    width: 450px;
    overflow: auto;
}
input[type="number"] {
    padding: 10px;
    border-radius: 14px;
    border: none;
    min-width: 65%;
}
input[type="number"]:focus {
    outline: 2px ridge rgb(185, 199, 199);
}
button[type="submit"] {
    padding: 5px;
    border-radius: 14px;
    border: none;
    color: #fff;
}
.add {
    background-color: rgb(23, 207, 17);
}
.share {
    background-color: rgb(0,136,204)
}
.phones,
.users {
    background-color: #fff;
    padding: 10px;
    border-radius: 14px;
}
.phones-from-db,
.user {
    display: flex;
    align-items: center;
}
.phones-from-db span,
.user span{
    font-size: 24px;
    margin-right: 15px;
}
.phones-from-db button {
    background-color: #fff;
    border: none;
}
button img {
    width: 35px;
    height: 35px;
}
.add-phone-form {
    display: flex;
    justify-content: space-between;
}
/* .edit-form {
    display: none;
} */
</style>
@extends('layouts.welcome')
@section('phonenumbers')
<div class="phonenumbers-section">
    <div class="phonenumbers-section__content">
        <div class="phonenumbers-section__content__phones">
            <h2>Phonenumbers</h2>
            <form class="add-phone-form" action="" method="POST">
                <input type="number" placeholder="Add phonenumber" required>
                <button class="add" name="add" type="submit">Add new</button>
                @csrf
            </form>
            <div class="phones">
                @foreach ($phonenumbers as $phonenumber)
                <div class="phones-from-db">
                    <span>
                        {{ $phonenumber->phonenumber }}
                    </span> 
                    <button class="edit" name="edit" value="{{ $phonenumber->id }}">
                        <img src="{{ asset('/images/edit.svg') }}" title="Edit" alt="Edit">
                    </button>
                    <form action="phonenumbers/delete" method="POST">
                        <button name="delete" value="{{ $phonenumber->id }}" type="submit">
                            <img src="{{ asset('/images/del.svg') }}" title="Delete" alt="Delete">
                        </button>
                        @csrf
                    </form>
                </div>
                @endforeach
                <form class="edit-form">
                    <input type="number" name="changed_number" required>
                    <button type="submit" name="change">Change</button>
                    @csrf
                </form>
            </div>
        </div>
        <div class="phonenumbers-section__content__users">
            <h2>Users</h2>
            <div class="users">
                @foreach ($users as $user)
                <div class="user">
                    <span>{{ $user->name}}</span>
                    <button class="share" name="share" value="{{ $user->id }}" type="submit">
                        <img src="{{ asset('/images/share.svg') }}" title="Share" alt="Share">
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
