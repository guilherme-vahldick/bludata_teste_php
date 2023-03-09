<?php

namespace App\Http\Controllers\Site;

use App\Models\Empresa;
use App\Models\Estado;
use App\Models\Fornecedor;
use App\Http\Requests\CreateFornecedorRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class FornecedorController extends Controller
{
    protected $view = 'fornecedor.';

    // Valida se o fornecedor menor de idade de empresa do parana antes de salvar
    public function checkParana($inputs)
    {
        if ($inputs['tipo_pessoa'] == 'F') {
            $estado = Empresa::where('id', $inputs['empresa_id'])->value('estado_id');

            if ($estado == 18) {
                $data_nascimento = Carbon::create($inputs['data_nascimento']);

                if ( $data_nascimento->diffInYears(Carbon::now()) < 18 ) {
                    throw ValidationException::withMessages(['data_nascimento' => 'Não são permitidos fornecedores menores de idade para empresas do Paraná!']);
                }
            }
        }
    }

    public function index(Request $request)
    {
        $fornecedores = Fornecedor::latest();

        $fornecedores->when($request->filled('busca_nome'), function($q) use ($request) {
            return $q->where('nome', 'like', '%' . $request->busca_nome . '%');
        });

        $fornecedores->when($request->filled('busca_cpf'), function($q) use ($request) {
            return $q->where('cpf', 'like', '%' . $request->busca_cpf . '%');
        });

        $fornecedores->when($request->filled('busca_cnpj'), function($q) use ($request) {
            return $q->where('cnpj', 'like', '%' . $request->busca_cnpj . '%');
        });

        $fornecedores->when($request->filled('busca_data_cadastro'), function($q) use ($request) {
            return $q->whereDate('created_at', '=', $request->busca_data_cadastro);
        });

        return view($this->view . 'list', ['fornecedores' => $fornecedores->paginate(10)]);
    }

    public function create()
    {
        $estados = Estado::all();
        $empresas = Empresa::all();

        return view($this->view . 'form', compact('estados', 'empresas'));
    }

    public function store(CreateFornecedorRequest $request)
    {
        $inputs = $request->all();
        $estados = Estado::all();
        $empresas = Empresa::all();

        $inputs['telefone'] = json_encode($inputs['telefones']);

        $this->checkParana($inputs);

        Fornecedor::create( $inputs );

        Session::flash('flash_message', 'Fornecedor cadastrado com sucesso!');
        return redirect()->route($this->view . 'index');
    }

    public function edit(Fornecedor $fornecedor)
    {
        $estados = Fornecedor::all();
        $empresas = Empresa::all();

        return view($this->view . 'form', compact('fornecedor', 'estados', 'empresas'));
    }

    public function update(CreateFornecedorRequest $request, Fornecedor $fornecedor)
    {
        $inputs = $request->all();
        $inputs['telefone'] = json_encode($inputs['telefones']);

        $this->checkParana($inputs);

        $fornecedor->update($inputs);

        Session::flash('flash_message', 'Fornecedor salvo com sucesso!');
        return redirect()->route($this->view . 'index');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        Session::flash('flash_message', 'Fornecedor removido com sucesso!');
        return redirect()->route($this->view . 'index');
    }
}
