@extends('layouts.app')

@section('title', 'Detalles del Empleado')

@section('header', 'Detalles del Empleado')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Empleados</a></li>
    <li class="breadcrumb-item active">Detalles del Empleado</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detalles del Empleado</h4>
                    <div>
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="border-bottom pb-2">Información Personal</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">CURP</label>
                            <p>{{ $empleado->curp }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nombre Completo</label>
                            <p>{{ $empleado->nombre_completo }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Estado</label>
                            <p>
                                <span class="badge {{ $empleado->status === 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $empleado->status }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="border-bottom pb-2">Información Laboral</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Número de Empleado</label>
                            <p>{{ $empleado->num_empleado }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Número de Expediente</label>
                            <p>{{ $empleado->num_expediente }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Año de Ingreso</label>
                            <p>{{ $empleado->anio_ingreso }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Puesto</label>
                            <p>{{ $empleado->puesto }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Adscripción</label>
                            <p>{{ $empleado->adscripcion }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Dependencia</label>
                            <p>{{ $empleado->dependencia }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="border-bottom pb-2">Información de Contacto</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ciudad</label>
                            <p>{{ $empleado->ciudad }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <p>{{ $empleado->email }}</p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Teléfono</label>
                            <p>{{ $empleado->telefono }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="border-bottom pb-2">Datos Biométricos</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            @if($empleado->datos_biometricos)
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Los datos biométricos están registrados
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i> No hay datos biométricos registrados
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 