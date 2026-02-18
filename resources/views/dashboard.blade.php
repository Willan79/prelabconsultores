{{--
|--------------------------------------------------------------------------
| Vista: Panel Administrativo
|--------------------------------------------------------------------------
| Descripción:
| Muestra gráficos decorativos.
| generados con Chart.js (empresas, auditorías y documentos).
|
|--------------------------------------------------------------------------
--}}

@extends('layouts.app_admin')

@section('contenido')
    <main class="graficos container-fluid d-flex flex-column justify-content-center">

        <header class="text-center mb-4">
            <h2 class="fw-bold">Dashboard de Indicadores</h2>
            <p class="text-muted">Resumen visual del estado del sistema</p>
        </header>

        <div class="row g-4 px-4">

            <!-- Gráfico: Empresas -->
            <section class="col-md-4">
                <article class="grafico-panel text-center rounded p-3 shadow-lg">
                    <h5 class="fw-bold mb-3">Empresas</h5>
                    <canvas id="grafico1" aria-label="Gráfico de empresas"></canvas>
                </article>
            </section>

            <!-- Gráfico: Auditorías -->
            <section class="col-md-4">
                <article class="grafico-panel text-center rounded p-3 shadow-lg">
                    <h5 class="fw-bold mb-3">Auditorías</h5>
                    <canvas id="grafico2" aria-label="Gráfico de auditorías"></canvas>
                </article>
            </section>

            <!-- Gráfico: Documentos -->
            <section class="col-md-4">
                <article class="grafico-panel text-center rounded p-3 shadow-lg">
                    <h5 class="fw-bold mb-3">Documentos</h5>
                    <canvas id="grafico3" aria-label="Gráfico de documentos"></canvas>
                </article>
            </section>

        </div>
    </main>
@endsection

{{-- Scripts específicos de esta vista --}}
@section('scripts')
    <script src="{{ asset('js/grafico.js') }}"></script>
@endsection
