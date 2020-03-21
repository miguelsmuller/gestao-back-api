<?php
namespace App\Http\Controllers\Trabalhista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Models\Base\Pessoa;
use Models\Trabalhista\VinculoProfissional;

class VinculoProfissionalController extends Controller
{
    protected $folderView = 'vinculo-profissional';

    public function list(){
        $vinculos = VinculoProfissional::orderBy('cirme')->get();

        return view( $this->folderView.'.list', ['vinculos' => $vinculos] );
    }

    public function view(Request $request, $cirme = null){
        $results = Pessoa::where('cirme', '=', $cirme)
            ->get();

        $vinculos = [
            'cirme' => $cirme,
            $results
        ];

        return view( $this->folderView.'.view', ['vinculos' => $vinculos] );
    }

    public function save(Request $request, $id = null){
        //
    }
}
