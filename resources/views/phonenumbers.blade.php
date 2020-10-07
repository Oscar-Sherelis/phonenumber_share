<style>
.phonenumbers-section__content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 30vw;
}
input[type="text"] {
    padding: 10px;
    width: 10vw;
    border-radius: 14px;
    border: none;
}
input[type="text"]:focus {
    outline: 2px ridge rgb(185, 199, 199);
}
button[type="submit"] {
    padding: 10px;
    border-radius: 14px;
    border: none;
    color: #fff;
    background-color: rgb(23, 207, 17);
}
</style>
@extends('layouts.welcome')
@section('phonenumbers')
<div class="phonenumbers-section">
    <div class="phonenumbers-section__content">
        <div class="phonenumbers-section__content__phones">
            <h2>Phonenumbers</h2>
            <form action="" method="POST">
                <input type="text" placeholder="Enter new phonenumber" required>
                <button type="submit">Add new</button>
                @csrf
            </form>
            <div class="phones">
                @foreach ($phonenumbers as $phonenumber)
                <p>{{ $phonenumber->phonenumber }}</p>
                @endforeach
            </div>
        </div>
        <div class="phonenumbers-section__content__users">
            <h2>Users</h2>
            ...
        </div>
    </div>
</div>
@endsection
