<?php
namespace App\Http\Controllers\Trabalhista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Models\Trabalhista\Cargo;

class CargoController extends Controller
{
    protected $folderView = 'cargo';

    public function index(){
        $data = Cargo::orderBy('nome')->get();
        return view( $this->folderView.'.list', ['data' => $data] );
    }

    public function create(){
        $data = new Cargo;
        return view( $this->folderView.'.form', ['data' => $data]);
    }

    public function edit(Cargo $cargo){
        // Show the form for editing the specified resource.  Using Implicit Binding.
        return view( $this->folderView.'.form', ['data' => $cargo]);
    }

    public function store(Request $request){
        $formData = $request->all();

        $validation = Validator::make($formData['cargo'], []);

        if ($validation->fails()) {
            return Redirect::route('cargo.create')->withErrors($validation)->withInput();
        }else{
            $cargo = new Cargo;
            $cargo->fill($formData['cargo']);
            $cargo->save();

            return Redirect::route('cargos.edit',  $cargo)->with('status', 'success')->with('content', 'Registro criado com sucesso');
        }
    }

    public function update(Request $request, Cargo $cargo){
        $formData = $request->all();

        $formValidation = Validator::make($formData['cargo'], []);

        if ($formValidation->fails()) {
            return Redirect::route('cargo.edit', $cargo)->withErrors($formValidation)->withInput();
        }else{
            $cargo->fill($formData['cargo']);
            $cargo->save();

            return Redirect::route('cargos.edit',  $cargo)->with('status', 'success')->with('content', 'Registro atualizado com sucesso');
        }
    }

    public function forApiIndex(Request $request){
        $query = trim($request->search);
        //if (empty($query))
            //return response()->json([]);

        $results = Cargo::where('inativo', '=', false)
            ->Where('nome', 'like', '%'.$query.'%')
            ->get();

        return response()->json([
            'data' => $results,
        ], 200);
    }
}
