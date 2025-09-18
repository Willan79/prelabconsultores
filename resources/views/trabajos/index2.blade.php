<div class="row g-4 ">
    @foreach ($trabajos as $trabajo)
        <div class="col-md-6">
            <div class="card rounded shadow-lg h-100">

                {{-- Imagen del trabajo --}}
                @if ($trabajo->imagens->isNotEmpty())
                    {{-- - Si hay imágenes asociadas al trabajo --}}
                    {{-- Mostrar solo la primera imagen --}}
                    <img src="{{ asset('storage/' . $trabajo->imagens->first()->ruta) }}" class="card-img-top"
                        alt="{{ $trabajo->titulo }}">
                @else
                    {{-- Si no hay imágenes, mostrar una imagen por defecto --}}
                    <img class="img-fluid" src="{{ asset('img/img-trabajo.png') }}" class="card-img-top" alt="Sin imagen">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $trabajo->titulo }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($trabajo->descripcion, 100) }} {{-- Limitar la descripción a 100 caracteres --}}
                    </p>
                    <p class="mb-1">
                        <strong>Empresa:</strong>
                        {{ $trabajo->empresa->nombre ?? 'N/A' }}
                    </p>
                    <small class="text-muted">
                        Realizado el {{ $trabajo->created_at->format('d/m/Y') }}
                    </small>
                </div>

                <div class="card-footer bg-white text-end">
                    <a href="{{ route('trabajos.show', $trabajo->id) }}" class="btn btn-sm btn-outline-primary">
                        Ver más
                    </a>

                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('trabajos.edit', $trabajo) }}" class="btn btn-sm btn-outline-warning">✏️
                            Editar</a>

                        <form action="{{ route('trabajos.destroy', $trabajo->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este trabajo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">🗑️ Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
