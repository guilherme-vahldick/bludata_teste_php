@extends('layouts.base')

@section('content')
<div class="site-interna">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ url('') }}">Página Inicial</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empresas</li>
        </ol>
    </nav>
    <form method="post" action="{{ isset($empresa->id) ? route('empresa.update', $empresa->id) : route('empresa.store') }}" enctype="multipart/form-data">
        {{ isset($empresa) ? method_field('PUT') : '' }}
        {{ csrf_field() }}
        <div class="jumbotron mt-3 p-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm col-12 mb-sm-0 mb-3">
                    <h2 class="m-0">{{ (isset($empresa)) ? 'Edição' : 'Criação' }} de Empresa</h2>
                </div>
                <div class="col-sm-auto col-12">
                    <button type="submit" class="btn btn-success mr-2">
                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                        <span>Salvar</span>
                    </button>
                    <a href="{{ route('empresa.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left mr-1"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nome">Nome Fantasia</label>
                        <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nomeFantasia"
                            placeholder="Empresa João e Maria" value="{{ (isset($empresa)) ? $empresa->nome : old('nome') }}" required>
                        <small id="nomeFantasia" class="form-text text-muted">Digite o nome fantasia por completo da sua empresa.</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="estado_id">Estado</label>
                        <select class="custom-select" id="estado_id" name="estado_id" aria-describedby="estadoEmpresa" required>
                            <option value="">Selecione</option>
                            @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}"{{ (isset($empresa) && $estado->id == $empresa->estado_id) ?
                                'selected=""' : (old('estado_id')) == $estado->id ? 'selected=""' : ''}}>
                                {{ $estado->nome }}</option>
                            @endforeach
                        </select>
                        <small id="estadoEmpresa" class="form-text text-muted">Selecione o estado em que a empresa se localiza.</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control mask-cnpj" id="cnpj" name="cnpj" aria-describedby="cnpjEmpresa"
                            placeholder="00.000.000/0000-00" value="{{ (isset($empresa)) ? $empresa->cnpj : old('cnpj') }}" required>
                        <small id="cnpjEmpresa" class="form-text text-muted">Digite o CNPJ sem pontuação.</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-floppy-disk mr-1"></i>
                <span>Salvar</span>
            </button>
        </div>
    </form>
</div>
@endsection