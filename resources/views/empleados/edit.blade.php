@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('header', 'Editar Empleado')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Empleados</a></li>
    <li class="breadcrumb-item active">Editar Empleado</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Editar Empleado</h4>
                </div>

                <div class="card-body">
                    <form id="empleadoForm" method="POST" action="{{ route('empleados.update', $empleado->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="curp" class="form-label">CURP</label>
                                <input type="text" class="form-control @error('curp') is-invalid @enderror" 
                                       id="curp" name="curp" value="{{ old('curp', $empleado->curp) }}" required maxlength="18" readonly>
                                @error('curp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" 
                                       id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno', $empleado->apellido_paterno) }}" 
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required>
                                @error('apellido_paterno')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="apellido_materno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" 
                                       id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno', $empleado->apellido_materno) }}" 
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required>
                                @error('apellido_materno')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" 
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="num_empleado" class="form-label">Número de Empleado</label>
                                <input type="text" class="form-control @error('num_empleado') is-invalid @enderror" 
                                       id="num_empleado" name="num_empleado" value="{{ old('num_empleado', $empleado->num_empleado) }}" 
                                       pattern="[0-9]+" title="Solo se permiten números" required>
                                @error('num_empleado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="num_expediente" class="form-label">Número de Expediente</label>
                                <input type="text" class="form-control @error('num_expediente') is-invalid @enderror" 
                                       id="num_expediente" name="num_expediente" value="{{ old('num_expediente', $empleado->num_expediente) }}" 
                                       pattern="[0-9]+" title="Solo se permiten números" required>
                                @error('num_expediente')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="puesto" class="form-label">Puesto</label>
                                <input type="text" class="form-control @error('puesto') is-invalid @enderror" 
                                       id="puesto" name="puesto" value="{{ old('puesto', $empleado->puesto) }}" 
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required>
                                @error('puesto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="adscripcion" class="form-label">Adscripción</label>
                                <input type="text" class="form-control @error('adscripcion') is-invalid @enderror" 
                                       id="adscripcion" name="adscripcion" value="{{ old('adscripcion', $empleado->adscripcion) }}" 
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required>
                                @error('adscripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="dependencia" class="form-label">Dependencia</label>
                                <input type="text" class="form-control @error('dependencia') is-invalid @enderror" 
                                       id="dependencia" name="dependencia" value="{{ old('dependencia', $empleado->dependencia) }}" 
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required>
                                @error('dependencia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input type="text" class="form-control @error('ciudad') is-invalid @enderror" 
                                       id="ciudad" name="ciudad" value="{{ old('ciudad', $empleado->ciudad) }}" 
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required>
                                @error('ciudad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $empleado->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono', $empleado->telefono) }}" 
                                       pattern="[0-9\s\-\(\)\+]+" title="Solo se permiten números, espacios, guiones, paréntesis y el signo +" required>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="anio_ingreso" class="form-label">Año de Ingreso</label>
                                <input type="number" class="form-control @error('anio_ingreso') is-invalid @enderror" 
                                       id="anio_ingreso" name="anio_ingreso" value="{{ old('anio_ingreso', $empleado->anio_ingreso) }}" 
                                       min="1900" max="{{ date('Y') + 1 }}" required>
                                @error('anio_ingreso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="datos_biometricos" class="form-label">Datos Biométricos</label>
                                <input type="file" class="form-control @error('datos_biometricos') is-invalid @enderror" 
                                       id="datos_biometricos" name="datos_biometricos">
                                @error('datos_biometricos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($empleado->datos_biometricos)
                                    <small class="form-text text-muted">Ya existen datos biométricos registrados</small>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    $('#empleadoForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                // Mostrar ventana emergente de éxito
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Empleado actualizado exitosamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    // Redirigir a la lista de empleados
                    window.location.href = '{{ route("empleados.index") }}';
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '<ul>';
                    Object.keys(errors).forEach(function(key) {
                        errorMessage += `<li>${errors[key][0]}</li>`;
                    });
                    errorMessage += '</ul>';
                    
                    Swal.fire({
                        title: 'Error de validación',
                        html: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al actualizar el empleado',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        });
    });
});
</script>
@endpush
@endsection 