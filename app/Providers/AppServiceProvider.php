<?php

namespace App\Providers;

use App\Models\Administrador;
use App\Models\Especialidade;
use App\Repositories\AdministradorRepository;
use App\Repositories\AtendimentoRepository;
use App\Repositories\ConvenioRepository;
use App\Repositories\Eloquent\EloquentAdministradorRepository;
use App\Repositories\Eloquent\EloquentAtendimentoRepository;
use App\Repositories\Eloquent\EloquentConvenioRepository;
use App\Repositories\Eloquent\EloquentEspecialidadeRepository;
use App\Repositories\Eloquent\EloquentFuncionarioRepository;
use App\Repositories\Eloquent\EloquentGuiaRepository;
use App\Repositories\Eloquent\EloquentLoteRepository;
use App\Repositories\Eloquent\EloquentMarcacaoRepository;
use App\Repositories\Eloquent\EloquentPacienteRepository;
use App\Repositories\Eloquent\EloquentResponsavelRepository;
use App\Repositories\Eloquent\EloquentUnidadeRepository;
use App\Repositories\EspecialidadeRepository;
use App\Repositories\FuncionarioRepository;
use App\Repositories\GuiaRepository;
use App\Repositories\LoteRepository;
use App\Repositories\MarcacaoRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\ResponsavelRepository;
use App\Repositories\UnidadeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        AdministradorRepository::class => EloquentAdministradorRepository::class,
        AtendimentoRepository::class => EloquentAtendimentoRepository::class,
        ConvenioRepository::class => EloquentConvenioRepository::class,
        EspecialidadeRepository::class => EloquentEspecialidadeRepository::class,
        FuncionarioRepository::class => EloquentFuncionarioRepository::class,
        GuiaRepository::class => EloquentGuiaRepository::class,
        LoteRepository::class => EloquentLoteRepository::class,
        MarcacaoRepository::class => EloquentMarcacaoRepository::class,
        PacienteRepository::class => EloquentPacienteRepository::class,
        ResponsavelRepository::class => EloquentResponsavelRepository::class,
        UnidadeRepository::class => EloquentUnidadeRepository::class,
    ];


    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
