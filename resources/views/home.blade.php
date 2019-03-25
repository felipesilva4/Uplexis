@extends('layouts.app')

@section('content')


<div class="container">
    
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" ></div>

                <nav class="navbar navbar-light bg-light" style="background-color: red">
                    <a class="navbar-brand" href="#">
                        <img src="https://legaltechnobrasil.com.br/wp-content/uploads/2017/09/uplexis-legaltechnobrasil.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
                        Para capturar os dados, é necessário incluir o titulo inteiro da máteria
                    </a>
                </nav>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="navbar-form navbar-left" role="search" action="{!! url('/find') !!}" method="post" >

                        <div class="form-group">
                            {!! csrf_field() !!}
                            <input type="text" name="text" class="form-control" placeholder="Pesquisar">
                         <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Capturar">
                         </div>
                        @if  (isset($artigos))
                            <h5>Pesquisas salvas:</h5>
                            <hr>date_diff
                            @foreach($artigos as $artigo)
                                <p>{{ $artigo->title}}</p>
                                <a href={{$artigo->link}}>Visitar Blog</a>
                                <a href="{{route('artigos.remove' , ['id'=> $artigo->id])}}">deletar</a>
                                <hr>
                            @endforeach
                        @endif
                    </form>
                </div>
            </div>
        
    </div>
      


</div>
@endsection
