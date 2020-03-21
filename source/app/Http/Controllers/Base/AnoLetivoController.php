<?php
namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

use Models\Base\AnoLetivo;

class AnoLetivoController extends Controller
{
    protected $folderView = 'ano-letivo';

    public function index() {
        $data = AnoLetivo::orderBy('anoLetivo', 'desc')->get();
        return view( $this->folderView.'.list', ['data' => $data] );
    }

    public function create(){
        $data = new AnoLetivo;
        return view( $this->folderView.'.form', ['data' => $data]);
    }

    public function edit(AnoLetivo $anos_letivo){
        // Show the form for editing the specified resource.  Using Implicit Binding.
        return view( $this->folderView.'.form', ['data' => $anos_letivo]);
    }

    public function store(Request $request){
        $formData = $request->all();

        $formData['anoLetivo']['inativo'] = (isset($request->anoLetivo['inativo'])) ? true : false;

        $validation = Validator::make($formData['anoLetivo'], [
            'anoLetivo' => [
                'size:4',
                'required',
                Rule::unique('anosLetivos','anoLetivo'),
            ],
            'inativo' => [
                'boolean',
                'required',
                /* Rule::unique('anosLetivos')->where(function ($query) {
                    return $query->where('inativo', 0);
                }) */
            ]
        ]);

        if ($validation->fails()) {
            return Redirect::route('anos-letivos.create')->withErrors($validation)->withInput();
        }else{
            $anoLetivo = new AnoLetivo;
            $anoLetivo->fill($formData['anoLetivo']);
            $anoLetivo->save();

            return Redirect::route('anos-letivos.edit',  $anoLetivo)->with('status', 'success')->with('content', 'Registro criado com sucesso');
        }
    }

    public function update(Request $request, AnoLetivo $anos_letivo){
        $formData = $request->all();

        $formData['anoLetivo']['inativo'] = (isset($request->anoLetivo['inativo'])) ? true : false;

        $formValidation = Validator::make($formData['anoLetivo'], [
            'anoLetivo' => [
                'size:4',
                'required',
                Rule::unique('anosLetivos','anoLetivo')->ignore($anos_letivo->anoLetivo, 'anoLetivo'),
            ],
            'inativo' => [
                'boolean',
                'required',
            ]
        ]);

        if ($formValidation->fails()) {
            return Redirect::route('anos-letivos.edit', $anos_letivo)->withErrors($formValidation)->withInput();
        }else{
            $anos_letivo->fill($formData['anoLetivo']);
            $anos_letivo->save();

            return Redirect::route('anos-letivos.edit',  $anos_letivo)->with('status', 'success')->with('content', 'Registro atualizado com sucesso');
        }
    }
}
