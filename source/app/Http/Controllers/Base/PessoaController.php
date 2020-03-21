<?php
namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use Models\Base\Pessoa;

class PessoaController extends Controller
{
    protected $folderView = 'pessoa';

    public function index(){
        $data = Pessoa::orderBy('nomeCompleto')->get();
        return view( $this->folderView.'.list', ['data' => $data] );
    }

    public function create(){
        $data = new Pessoa;
        return view( $this->folderView.'.form', ['data' => $data]);
    }

    public function edit(Pessoa $pessoa){
        // Show the form for editing the specified resource.  Using Implicit Binding.
        return view( $this->folderView.'.form', ['data' => $pessoa]);
    }

    public function store(Request $request){
        $formData = $request->all();

        $validationPessoa = Validator::make($formData['pessoa'], [
            'nomeCompleto' => 'required|max:255',
            'dataNascimento' => 'required|date_format:d/m/Y',
            'cpf' => [
                'size:11',
                'nullable',
                Rule::unique('pessoas', 'cirme'),
            ],
            'sexo' => 'in:masculino,feminino',
            'falecido' => 'boolean',
        ]);

        $validationEndereco = Validator::make($formData['endereco'], [
            'cep' => 'max:8' ,
            'municipio' => 'max:60',
            'distrito' => 'max:60',
            'bairro' => 'max:60',
            'logradouro' => 'max:255',
            'numero' => 'max:45',
            'complemento' => 'max:45'
        ]);

        if ($validationPessoa->fails() || $validationEndereco->fails()) {
            $errors = $validationPessoa->messages()->merge($validationEndereco->messages());

            return Redirect::route('pessoas.create')->withErrors($errors)->withInput();
        }else{
            $pessoa = new Pessoa;

            $formData['pessoa']['dataNascimento'] = Carbon::createFromFormat('d/m/Y', $request->pessoa['dataNascimento']);
            $formData['pessoa']['falecido'] = (isset($request->pessoa['falecido'])) ? true : false;

            $pessoa->fill($formData['pessoa']);
            $pessoa->save();

            $pessoa->endereco()->updateOrCreate(['cirme' => $pessoa->cirme], $formData['endereco']);

            return Redirect::route('pessoas.edit',  $pessoa)->with('status', 'success')->with('content', 'Registro criado com sucesso');
        }
    }

    public function update(Request $request, Pessoa $pessoa){
        $formData = $request->all();

        $validationPessoa = Validator::make($formData['pessoa'], [
            'nomeCompleto' => 'required|max:255',
            'dataNascimento' => 'required|date_format:d/m/Y',
            'cpf' => [
                'size:11',
                'nullable',
                Rule::unique('pessoas','cpf')->ignore($pessoa->cirme, 'cirme'),
            ],
            'sexo' => 'in:masculino,feminino',
            'falecido' => 'boolean',
        ]);

        $validationEndereco = Validator::make($formData['endereco'], [
            'cep' => 'max:8' ,
            'municipio' => 'max:60',
            'distrito' => 'max:60',
            'bairro' => 'max:60',
            'logradouro' => 'max:255',
            'numero' => 'max:45',
            'complemento' => 'max:45'
        ]);

        if ($validationPessoa->fails() || $validationEndereco->fails()) {
            $errors = $validationPessoa->messages()->merge($validationEndereco->messages());

            return Redirect::route('pessoas.create')->withErrors($errors)->withInput();
        }else{
            $formData['pessoa']['dataNascimento'] = Carbon::createFromFormat('d/m/Y', $request->pessoa['dataNascimento']);
            $formData['pessoa']['falecido'] = (isset($request->pessoa['falecido'])) ? true : false;

            $pessoa->fill($formData['pessoa']);
            $pessoa->save();

            $pessoa->endereco()->updateOrCreate(['cirme' => $pessoa->cirme], $formData['endereco']);

            return Redirect::route('pessoas.edit',  $pessoa)->with('status', 'success')->with('content', 'Registro atualizado com sucesso');
        }
    }

    public function forApiIndex(Request $request){
        $query = trim($request->search);
        //if (empty($query))
            //return response()->json([]);

        $results = Pessoa::where('falecido', '=', false)
            ->where('cirme', '=', $query)
            ->orWhere('nomeCompleto', 'like', '%'.$query.'%')
            ->orWhere('cpf', 'like', $query.'%')
            ->get();

        return response()->json([
            'data' => $results,
        ], 200);
    }
}
