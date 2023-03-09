@extends('layouts.base')

@section('content')
<div class="site-home">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Página Inicial</li>
        </ol>
    </nav>
    <div class="card">
        <img class="card-img-top" src="{{ asset('img/banner-bludata.jpg') }}" alt="Card image cap">
        <div class="card-body site-home__card">
            <h2 class="site-home__titulo">Avaliação de Conhecimentos</h2>
            <h3 class="site-home__sub-titulo">Programador PHP</h3>
            <p class="mb-3 mb-lg-2">
                Projeto desenvolvido como enunciado em <strong>08/03/2023</strong> por <strong>Guilherme Vahldick</strong>, utilizando framework <strong>Laravel 5.6</strong> e <strong>Bootstrap 4</strong>.
            </p>
            <p class="mb-3">
                Abaixo a lista dos cadastros de <strong>empresa</strong> e <strong>fornecedores</strong>:
            </p>
            <div class="d-flex">
                <a href="{{ route('empresa.index')}}" class="btn btn-primary mr-3">Cadastro de Empresa</a>
                <a href="{{ route('fornecedor.index') }}" class="btn btn-primary">Cadastro de Fornecedor</a>
            </div>
        </div>
    </div>
</div>
@endsection