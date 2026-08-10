<table>
    @foreach($users as $user)
    <tr>
    <td> {{$user->name}} </td>
    <td> {{$user->role->name}}</td>
    </tr>
    @endforeach
</table>