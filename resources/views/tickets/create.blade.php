@extends('templates.layout')

@section('content')
    <x-main-title>Tworzenie sprawy: </x-main-title>

<main>


<form action="/ticket" method="POST">

@csrf

<label>Temat:
    <input type="text" name="title" class="main__frame--topic" value="{{old('title')}}">
</label><br>

    @error('title')
    <p>{{$message}}</p>
    @enderror

    <label>Termin:
        <input type="datetime-local" name="deadline" class="main__frame--deadline" value="{{date('Y-m-d')}}T{{date('H:i')}}">
    </label><br>

    @error('deadline')
    <p>{{$message}}</p>
    @enderror

    <label>Priorytet:
        <select class="main__frame--select" name="priority">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </label>
    <br>

    @error('priority')
    <p>{{$message}}</p>
    @enderror

<label class="label_opis">Opis: <br/>
    <textarea name="description" class="main__frame--content" value="{{old('description')}}"> </textarea>
</label><br>

    @error('description')
    <p>{{$message}}</p>
    @enderror

<button type="submit">Zatwierdź</button>

</form>
</main>

@endsection
