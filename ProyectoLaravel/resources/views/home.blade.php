@extends('layouts.app')

@section('content')
<style>
 table th{
                padding-left:30px;
                padding-right:30px;
                border-bottom: 1px solid  #F86433;
                text-align: center;
            }
            table td{
                padding-left:30px;
                padding-right:30px;
                border-bottom: 1px solid  #ccc;
                text-align: center;
            }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    @if(auth()->user()->role =="ROLE_ADMIN")
                    <h2>Usuarios</h2>
                    <form action="{{ route('home') }}" method="GET" class="form-inline pull-right">
                    @csrf
                        <input type="text" name="name" class="form-control" placeholder="nombre">
                        <input type="text" name="surname" class="form-control" placeholder="apellidos">
                        <input type="text" name="email" class="form-control" placeholder="correo">
                        <input type="text" name="phone" class="form-control" placeholder="telefono">
                        <input type="submit" value="Buscar">
                    </form>
                    
                    <table class="table">
                        <tr>
                            <th>Nombres</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Programa</th>
                            <th>Llamado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($users as $user)
                      
                        <tr>
                            <td>{{ $user->name." ".$user->surname }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->calls }}</td>
                            <td>{{ $user->program()->get()[0]->name}}</td>
                            @if($user->calls == "no")
                                <td><a href="{{route('call',$user->id)}}">llamar</a></td>
                            @else 
                                <td></td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <h2>Hola te has apuntado a: {{auth()->user()->program()->get()[0]->name}}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
