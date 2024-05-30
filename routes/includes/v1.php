<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


use App\Helpers\HelpersTiss;
use App\Http\Controllers\Api\AdministradorController;
use App\Http\Controllers\Api\AtendimentoController;
use App\Http\Controllers\Api\ConvenioController;
use App\Http\Controllers\Api\EspecialidadeController;
use App\Http\Controllers\Api\FuncionarioController;
use App\Http\Controllers\Api\GuiaController;
use App\Http\Controllers\Api\LoteController;
use App\Http\Controllers\Api\MarcacaoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\ResponsavelController;
use App\Http\Controllers\Api\UnidadeController;
use App\Services\UfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/autenticacao', function (Request $request) {
    $user = false;
    $credentials = $request->only('email', 'password');
    $prefixes = [
        'administradores',
        'funcionarios'
    ];

    foreach ($prefixes as $prefix) {
        if (Auth::guard($prefix)->attempt($credentials) === true) {
            $user = Auth::guard($prefix)->user();
        }
    }

    if(!$user){
        return response()->json(['data' => 'Unauthorized'], 401);
    }


    $token = $user->createToken('token');

    return response()->json(['token' => $token->plainTextToken]);
});


Route::middleware('auth:sanctum')->group(function () {

    $prefixes = [
        'administradores' => AdministradorController::class,
        'atendimentos' => AtendimentoController::class,
        'convenios' => ConvenioController::class,
        'especialidades' => EspecialidadeController::class,
        'funcionarios' => FuncionarioController::class,
        'guias' => GuiaController::class,
        'lotes' => LoteController::class,
        'marcacoes' => MarcacaoController::class,
        'pacientes' => PacienteController::class,
        'responsaveis' => ResponsavelController::class,
        'unidades' => UnidadeController::class
    ];

    /*--- Rotas CRUD --- */

    foreach ($prefixes as $prefix => $controller) {
        Route::apiResource('/'.$prefix, $controller);
    }


    /*--- Sub Recursos ---*/

    Route::controller(PacienteController::class)->group(function () {
        Route::get('/pacientes/{idPaciente}/responsaveis', 'responsaveis');
    });

    Route::controller(MarcacaoController::class)->group(function () {
        Route::get('/marcacoes/{idMarcacao}/atendimentos', 'atendimentos');
        Route::get('/marcacoes/{idMarcacao}/atendimentos/{idAtendimento}', 'atendimentoById');

    });

    Route::controller(LoteController::class)->group(function () {
        Route::get('/lotes/{idConvenio}/{numeroLote}/xml', 'generateXML');
    });



    // /*--- Ufs ---*/
    // Route::get('/helpers/ufs', function () {
    //     return UfService::getUfs();
    // });

    /*--- Helpers Tiss ---*/

    Route::get('/helpers/tiss', function () {
        return HelpersTiss::getAll();
    });

});


