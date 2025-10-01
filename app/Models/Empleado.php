<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empleado extends Model
{
    use HasFactory, Notifiable;

    /**
     * La clave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // ahora id es la PK

    /**
     * Indica si la clave primaria es auto-incrementable.
     *
     * @var bool
     */
    public $incrementing = true; // id es autoincrementable

    /**
     * El tipo de dato de la clave primaria.
     *
     * @var string
     */
    protected $keyType = 'int'; // id es entero

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'curp',
        'apellido_paterno',
        'apellido_materno',
        'nombre',
        'anio_ingreso',
        'num_expediente',
        'num_empleado',
        'puesto',
        'adscripcion',
        'dependencia',
        'ciudad',
        'email',
        'telefono',
        'datos_biometricos',
        'status',
        'solicitud_status',
        'motivo_rechazo'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'anio_ingreso' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Método para obtener el nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    // Método para verificar si el empleado está activo
    public function isActivo()
    {
        return $this->status === 'Activo';
    }

    /**
     * Ruta para enviar notificaciones por correo al empleado.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
