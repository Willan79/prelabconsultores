
@extends('layouts.app_admin')

@section('contenido')
    <!-- Contenedor principal -->
    <div class="graficos  d-flex flex-column justify-content-center">
        <div class=" row g-3 p-4">
            <!-- Gráficos con JavaScript-->
            <!-- Gráfico 01-->
            <section class=" col-md-4">
                <div class="grafico-panel text-center rounded p-2 shadow-lg">
                    <a class=" text-decoration-none fw-bold fs-5">Empresas</a>
                    <div class="overlay"></div>
                    <div >
                        <div>
                            <canvas id="grafico1" ></canvas>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Gráfico 02-->
            <section class=" col-md-4">
                <div class="grafico-panel text-center rounded p-2 shadow-lg">
                    <a class=" text-decoration-none fw-bold fs-5">Auditorias</a>
                    <div class="overlay"></div>
                    <div>
                        <div>
                            <canvas id="grafico2" ></canvas>
                        </div>
                    </div>

                </div>
            </section>
            <!-- Gráfico 03-->
            <section class=" col-md-4">
                <div class="grafico-panel text-center rounded p-2 shadow-lg">
                    <a class=" text-decoration-none fw-bold fs-5">Documentos</a>
                    <div class="overlay"></div> <!-- Capa de superposición -->
                    <div >
                        <div>
                            <canvas id="grafico3" ></canvas>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection

<!-- Sección para incluir scripts específicos de la vista -->
@section('scripts')
<!-- Carga del archivo JavaScript externo que genera el gráfico -->
<script src="{{ asset('js/grafico.js') }}"></script>

@endsection
