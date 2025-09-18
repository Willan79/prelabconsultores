@extends('layouts.app')

@section('contenido')
    <!-- Sección principal -->
    <section class="seccion-principal">
        <div class="mx-4">
            @if (session('success'))
                <x-alerta tipo="success" :mensaje="session('success')" />
            @endif
        </div>
        <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
        <div class="conten position-relative p-4">
            <h1>BIENVENIDO A PRELAB CONSULTORES</h1>
            <span class="fw-bold d-block">SOLUCIONES CREATIVAS Y EFECTIVAS</span>
        </div>
    </section>
    <!-- Barra de especialidades -->
    <div class="barra-especialidades text-white text-center py-4 d-flex flex-wrap justify-content-around">
        <p>Profesionales<br>SST</p>
        <p>Médicos<br>laborales</p>
        <p>Psicólogos especialistas en<br>SST</p>
        <p>Fisioterapeutas especialistas en<br>ergonomía</p>
    </div>

    <!-- Sección de presentación de la empresa -->
    <section class="seccion-presentacion container my-5 text-center">
        <!-- Primera fila -->
        <article class="row align-items-center">
            <div class="fade-in col-md-6 mb-4 mb-md-0">
                <img class="img-fluid" src="{{ asset('img/img-2.webp') }}" alt="Equipo de trabajo">
            </div>
            <div class="col-md-6">
                <h3>NUESTRA EMPRESA</h3>
                <p>Somos una empresa resolutiva e innovadora, enfocada en la atención a las necesidades de diseño e
                    implementación del SG-SST en los sectores Industrial, TIC, Construcción, Salud, entre otros, con alto
                    sentido de pertenencia y compromiso en la ejecución, mantenimiento y mejora continua del mismo.</p>
            </div>
        </article>
        <!-- Segunda fila con orden invertido en pantallas medianas y grandes -->
        <article class="row align-items-center mt-5">
            <div class="fade-in col-md-6 order-md-2 mb-4 mb-md-0">
                <img class="img-fluid" src="{{ asset('img/img-3.webp') }}" alt="Equipo de trabajo">
            </div>
            <div class="col-md-6 order-md-1">
                <h3>NUESTRA EMPRESA</h3>
                <p>Está conformada por un equipo de profesionales interdisciplinarios como Ingenieros, Profesionales SST,
                    Médicos laborales, Psicólogos, fisioterapeutas y especialistas en salud, entre otros, para afrontar los
                    diferentes retos del SG-SST y bienestar de los trabajadores.</p>
            </div>
        </article>
    </section>

    <!-- Asesoría -->
    <div class="barra-asesoria text-warning text-center py-4">
        <h3>¿Requieres Asesoría?</h3>
    </div>
    <!-- Sección de consultorías -->
    <section class="seccion-consultorias container my-5 text-center">

        <article class="row mb-5">
            <ul class="col-md-6 mb-4 listas">
                <h5 class="">CONSULTORÍA EN SEGURIDAD Y SALUD EN EL TRABAJO (SST)</h5>
                <li><i class="bi bi-building-fill-check" aria-hidden="true"></i> Consultoría en el diseño e implementación
                    del SGSST.</li>
                <li><i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i> Auditorías en el SG-SST con base en el
                    Decreto 1072 y
                    Resolución 0312.</li>
                <li><i class="bi bi-graph-up-arrow" aria-hidden="true"></i> Estrategias lúdicas en la implementación del
                    SG-SST.</li>
                <li><i class="bi bi-calendar2-week-fill" aria-hidden="true"></i> Reporte de evaluación de estándares mínimos
                    ante el MINTRABAJO
                    y ARL, y diseño del plan de mejoramiento.</li>
                <li><i class="bi bi-folder-check" aria-hidden="true"></i> Aplicación, intervención y seguimiento de batería
                    de riesgo
                    psicosocial.</li>
            </ul>
            <div class="fade-in col-md-6">
                <img class="img-fluid" src="{{ asset('img/img-4.webp') }}" alt="Asesoría SST">
            </div>
        </article>

        <article class="row align-items-center">
            <div class="fade-in col-md-6 mb-4 mb-md-0">
                <img class="img-fluid" src="{{ asset('img/img-4.webp') }}" alt="Asesoría PESV">
            </div>

            <div class="col-md-6">
                <h5>CONSULTORÍA PLAN ESTRATÉGICO DE SEGURIDAD VIAL (PESV)</h5>
                <ul class="listas">
                    <li><i class="bi bi-building-fill-check" aria-hidden="true"></i> Consultoría en el diseño e
                        implementación
                        del PESV.</li>
                    <li><i class="bi bi-journal-arrow-down" aria-hidden="true"></i> Reporte del PESV ante la
                        Superintendencia de Transporte
                        (Formulario SISI/PESV).</li>
                    <li><i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i> Auditoría en el PESV con base en la
                        Resolución 40595.</li>
                    <li><i class="bi bi-graph-up-arrow"></i> Estrategias lúdicas en la implementación de la seguridad vial.
                    </li>
                </ul>
            </div>
        </article>
    </section>

    <!-- Medicina del trabajo -->
    <section class="barra-medicina text-center">
        <h5 class="text-warning">MEDICINA DEL TRABAJO Y EXÁMENES MÉDICOS OCUPACIONALES</h5>
        <article class="container">
            <ul class="mx-auto col-md-8">
                <li>
                    Programación y verificación de conceptos médicos de exámenes laborales de ingreso, periódicos y de
                    retiro,
                    así como la verificación de titulaciones (Hepatitis B – Varicela).
                </li>
                <li>
                    Actualización del profesiograma de los cargos en la empresa y validación de cumplimiento en los procesos
                    de selección.
                </li>
            </ul>
        </article>
    </section>
@endsection

@section('footer')
    <!-- Barra de Contactos -->
    <section class="barra-contacto ">
        <div class="contacto">
            <div>
                <i class="bi bi-telephone-fill"></i>
            </div>
            <p>
                Línea de atención al cliente</br>315 244 3063</br>314 738 9775
            </p>
        </div>
        <div class="contacto">
            <i class="bi bi-envelope-at-fill"></i>
            <p>
                Email</br>prelab.consultores.ips@gmail.com</br>comercial@prelabconsultores.com
            </p>
        </div>
    </section>
    <!-- Pie decorativo final -->
    <section class="pie-decorativo rounded"></section>
    <div class="text-center text-white py-3">
        Copyright {{ now()->year }} © Todos los derechos Reservados | Prelabconsultores
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/grafico.js') }}"></script>
@endsection
