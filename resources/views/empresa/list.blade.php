@extends('layouts.base')

@section('content')
<div class="site-interna">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ url('') }}">Página Inicial</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empresas</li>
        </ol>
    </nav>
    <div class="jumbotron mt-3 p-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-sm col-12 mb-sm-0 mb-3">
                <h2 class="m-0">Empresas</h2>
            </div>
            <div class="col-sm-auto col-12">
                <a href="{{ route('empresa.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus mr-1"></i>
                    <span>Inserir Empresa</span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($empresas as $empresa)
                <tr>
                    <td scope="row"><strong>{{ $empresa->id }}</strong></td>
                    <td scope="row">{{ optional($empresa->estado)->nome }}</td>
                    <td scope="row">{{ $empresa->nome }}</td>
                    <td scope="row">{{ $empresa->cnpj }}</td>
                    <td scope="row">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('empresa.edit', $empresa->id) }}" class="btn btn-primary mr-3">
                                <i class="fa-solid fa-file-pen mr-1"></i>
                                <span>Editar</span>
                            </a>
                            <form method="post" action="{{ route('empresa.destroy', $empresa->id) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button href="#" class="btn btn-danger">
                                    <i class="fa-solid fa-trash mr-1"></i>
                                    <span>Excluir</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="alert alert-primary" role="alert">
                            Nenhuma empresa foi cadastrada ainda!
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $empresas->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection