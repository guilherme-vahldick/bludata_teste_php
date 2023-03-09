@extends('layouts.base')

@section('content')
<div class="site-interna">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ url('') }}">Página Inicial</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fornecedores</li>
        </ol>
    </nav>
    <div class="jumbotron mt-3 p-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-sm col-12 mb-sm-0 mb-3">
                <h2 class="m-0">Fornecedores</h2>
            </div>
            <div class="col-sm-auto col-12">
                <a href="{{ route('fornecedor.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus mr-1"></i>
                    <span>Inserir Fornecedor</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body pb-2">
            <h6 class="mb-2">Filtrar por:</h6>
            <form method="get" class="form-inline mb-3">
                <div class="form-group mb-2 mr-2">
                    <input type="text" class="form-control" id="busca_nome" name="busca_nome"
                        value="{{ app('request')->input('busca_nome') ? app('request')->input('busca_nome') : '' }}" placeholder="Nome">
                </div>
                <div class="form-group mb-2 mr-2">
                    <input type="text" class="form-control mask-cpf" id="busca_cpf" name="busca_cpf"
                        value="{{ app('request')->input('busca_cpf') ? app('request')->input('busca_cpf') : '' }}" placeholder="CPF">
                </div>
                <div class="form-group mb-2 mr-2">
                    <input type="text" class="form-control mask-cnpj" id="busca_cnpj" name="busca_cnpj"
                        value="{{ app('request')->input('busca_cnpj') ? app('request')->input('busca_cnpj') : '' }}" placeholder="CNPJ">
                </div>
                <div class="form-group mb-2 mr-2">
                    <input type="date" class="form-control mask-data" id="busca_data_cadastro" name="busca_data_cadastro"
                    value="{{ app('request')->input('busca_data_cadastro') ? app('request')->input('busca_data_cadastro') : '' }}" placeholder="Data do Cadastro">
                </div>
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fa-solid fa-magnifying-glass mr-1"></i>
                    <span>Filtrar</span>
                </button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF/CNPJ</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Data do Cadastro</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fornecedores as $fornecedor)
                <tr>
                    <td scope="row"><strong>{{ $fornecedor->id }}</strong></td>
                    <td scope="row">{{ $fornecedor->nome }}</td>
                    <td scope="row">
                        {{ $fornecedor->cpf }}
                        {!! $fornecedor->cpf && $fornecedor->cnpj ? '/<br />' : '' !!}
                        {{ $fornecedor->cnpj }}
                    </td>
                    <td scope="row">{{ $fornecedor->empresa->nome }}</td>
                    <td scope="row">{{ optional($fornecedor->data_nascimento)->format('d/m/Y') }}</td>
                    <td scope="row">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('fornecedor.edit', $fornecedor->id) }}" class="btn btn-primary mr-3">
                                <i class="fa-solid fa-file-pen mr-1"></i>
                                <span>Editar</span>
                            </a>
                            <form method="post" action="{{ route('fornecedor.destroy', $fornecedor->id) }}">
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
                            Nenhum fornecedor foi encontrado!
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $fornecedores->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
</div>
@endsection