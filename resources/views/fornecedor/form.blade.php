@extends('layouts.base')

@section('content')
<div class="site-interna">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ url('') }}">Página Inicial</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fornecedores</li>
        </ol>
    </nav>
    <form method="post" action="{{ isset($fornecedor->id) ? route('fornecedor.update', $fornecedor->id) : route('fornecedor.store') }}" enctype="multipart/form-data">
        {{ isset($fornecedor) ? method_field('PUT') : '' }}
        {{ csrf_field() }}
        <div class="jumbotron mt-3 p-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm col-12 mb-sm-0 mb-3">
                    <h2 class="m-0">{{ (isset($fornecedor)) ? 'Edição' : 'Criação' }} de Fornecedor</h2>
                </div>
                <div class="col-sm-auto col-12">
                    <button type="submit" class="btn btn-success mr-2">
                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                        <span>Salvar</span>
                    </button>
                    <a href="{{ route('fornecedor.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left mr-1"></i>
                        <span>Voltar</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="tipo_pessoa">Tipo Pessoa</label> <br />
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input tipo_pessoa mr-2" type="radio" name="tipo_pessoa"
                                id="tipo_pessoa_fisica" value="F"
                                    {{ (!isset($fornecedor)) ? 'checked="checked" ' : '' }}
                                    {{ ((isset($fornecedor)
                                            && $fornecedor->tipo_pessoa == 'F') || old('tipo_pessoa') == 'F') ? 'checked="checked" ' : '' }}
                                        required>
                            <label class="form-check-label" for="tipo_pessoa_fisica">Pessoa Física</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input tipo_pessoa mr-2" type="radio" name="tipo_pessoa"
                                id="tipo_pessoa_juridica" value="J"
                                    {{ ((isset($fornecedor)
                                            && $fornecedor->tipo_pessoa == 'J') || old('tipo_pessoa') == 'J') ? 'checked="checked" ' : '' }}
                                        required>
                            <label class="form-check-label" for="tipo_pessoa_juridica">Pessoa Jurídica</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nomePessoa"
                            placeholder="João da Silva" value="{{ (isset($fornecedor)) ? $fornecedor->nome : old('nome') }}" required>
                        <small id="nomePessoa" class="form-text text-muted">Digite o nome da pessoa.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="empresa_id">Empresa</label>
                        <select class="custom-select" id="empresa_id" name="empresa_id" aria-describedby="idEmpresa" required>
                            <option selected value="">Selecione</option>
                            @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}"{{ (isset($fornecedor) && $empresa->id == $fornecedor->empresa_id) ?
                                'selected=""' : (old('empresa_id')) == $empresa->id ? 'selected=""' : ''}}>
                                {{ $empresa->nome }}</option>
                            @endforeach
                        </select>
                        <small id="idEmpresa" class="form-text text-muted">Selecione a qual empresa pertence esse fornecedor.</small>
                    </div>
                </div>
                <div class="col-md-6 hidde-juridica"
                    {!! (isset($fornecedor) && $fornecedor->tipo_pessoa == 'J') ? ' style="display:none;"' : '' !!}>
                    <div class="form-group">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control" id="rg" name="rg" aria-describedby="rgPessoa"
                            placeholder="Número do RG" value="{{ (isset($fornecedor)) ? $fornecedor->rg : old('rg') }}" required>
                        <small id="rgPessoa" class="form-text text-muted">Digite o número do seu RG conforme seu documento de identidade.</small>
                    </div>
                </div>
                <div class="col-md-6 hidde-juridica"
                    {!! (isset($fornecedor) && $fornecedor->tipo_pessoa == 'J') ? ' style="display:none;"' : '' !!}>
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"
                            aria-describedby="dataNascimento" placeholder="00/00/0000"
                                value="{{ (isset($fornecedor)) ? $fornecedor->data_nascimento->format('Y-m-d') : old('data_nascimento') }}" required>
                        <small id="dataNascimento" class="form-text text-muted">Digite sua data de nascimento em formato 00/00/0000.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control mask-cpf" id="cpf" name="cpf"
                            aria-describedby="cpfPessoa" placeholder="000.000.000-00"
                                value="{{ (isset($fornecedor)) ? $fornecedor->cpf : old('cpf') }}">
                        <small id="cpfPessoa" class="form-text text-muted">Digite o CPF sem pontuação.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control mask-cnpj" id="cnpj" name="cnpj"
                            aria-describedby="cnpjPessoa" placeholder="00.000.000/0000-00"
                                value="{{ (isset($fornecedor)) ? $fornecedor->cnpj : old('cnpj') }}">
                        <small id="cnpjPessoa" class="form-text text-muted">Digite o CNPJ sem pontuação.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Telefone</label>
                        @php
                            $telefones = array();

                            if (isset($fornecedor)) {
                                $telefones = json_decode($fornecedor->telefone);
                            }
                        @endphp
                        <div class="telefones-lista">
                            @if (count($telefones))
                                @foreach ($telefones as $telefone)
                                <div class="campo_telefone{{ $loop->first ? ' campo_telefone_clone' : '' }} d-flex mb-2">
                                    <input type="text" class="form-control mask-phone" name="telefones[]"
                                    aria-describedby="telPessoa" placeholder="(00) 00000-0000"
                                        value="{{ $telefone }}">
                                    <a href="#" class="btn btn-danger ml-2 btn-remove">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                                @endforeach
                            @else
                            <div class="campo_telefone campo_telefone_clone d-flex mb-2">
                                <input type="text" class="form-control mask-phone" name="telefones[]" aria-describedby="telPessoa" placeholder="(00) 00000-0000">
                                <a href="#" class="btn btn-danger ml-2 btn-remove">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                        <small id="telPessoa" class="form-text text-muted">Digite o seu numéro de telefone, caso queira adcionar mais telefone clique no botão <strong>adicionar</strong>.</small>
                        <a href="#" class="btn btn-primary mt-3 btn-add-phone">
                            <i class="fa-solid fa-plus mr-1"></i>
                            <span>Adicionar Telefone</span>
                        </a>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">
                <i class="fa-solid fa-floppy-disk mr-1"></i>
                <span>Salvar</span>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('.tipo_pessoa').on('change', function(e) {
            e.preventDefault();

            let value = $(this).val();

            if (value == 'J') {
                $('.hidde-juridica')
                    .hide()
                    .prop('required', false);
            } else {
                $('.hidde-juridica')
                    .show()
                    .prop('required', true);
            }
        });

        $('.btn-add-phone').on('click', function(e) {
            e.preventDefault();

            let campo = $('.campo_telefone_clone').clone();

            campo
                .children('input')
                .val('')

            campo
                .removeClass('campo_telefone_clone')
                .appendTo('.telefones-lista');

            $('.mask-phone').mask(SPMaskBehavior, spOptions);
        });

        $('html').on('click', '.btn-remove', function(e) {
            e.preventDefault();

            console.log($(this));

            $(this)
                .parents('.campo_telefone')
                .remove();
        })
    })
</script>
@endsection