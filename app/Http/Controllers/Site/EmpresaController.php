<?php

namespace App\Http\Controllers\Site;

use App\Models\Empresa;
use App\Models\Estado;
use App\Models\Fornecedor;
use App\Http\Requests\CreateEmpresaRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class EmpresaController extends Controller
{
    protected $view = 'empresa.';

    public function index()
    {
        $empresas = Empresa::latest()->paginate(10);

        return view($this->view . 'list', ['empresas' => $empresas]);
    }

    public function create()
    {
        $estados = Estado::all();

        return view($this->view . 'form', compact('estados'));
    }

    public function store(CreateEmpresaRequest $request)
    {
        $inputs = $request->all();

        Empresa::create( $inputs );

        Session::flash('flash_message', 'Empresa cadastrada com sucesso!');
        return redirect()->route($this->view . 'index');
    }

    public function edit(Empresa $empresa)
    {
        $estados = Estado::all();
        return view($this->view . 'form', compact('empresa', 'estados'));
    }

    public function update(CreateEmpresaRequest $request, Empresa $empresa)
    {
        $inputs = $request->all();

        $empresa->update($inputs);

        Session::flash('flash_message', 'Empresa salva com sucesso!');
        return redirect()->route($this->view . 'index');
    }

    public function destroy(Empresa $empresa)
    {
        if (count($empresa->fornecedor)) {
            Session::flash('flash_message_error', 'Empresa não pode ser excluída, pois esta vinculada a um fornecedor!');
            return redirect()->route($this->view . 'index');
        }

        $empresa->delete();

        Session::flash('flash_message', 'Empresa removida com sucesso!');
        return redirect()->route($this->view . 'index');
    }
}
