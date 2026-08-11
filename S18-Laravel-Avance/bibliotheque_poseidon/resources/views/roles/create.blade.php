<h1>Ajouter un rôle</h1>
@if(session('success'))
<div>
{{session('success')}}
</div>
@endif
<form action="{{route('roles.store')}}" method="POST">
@csrf 
<label for="name">Nom du role</label>
<input type="text" name="name" id="name" value="{{old('name')}}">
@error('name')
<div> {{$message}} </div>
@enderror

<button type="submit">Créer</button>
</form>