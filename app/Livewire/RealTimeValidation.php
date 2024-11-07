<?php

namespace App\Livewire;

use Livewire\Component;

class RealTimeValidation extends Component
{
    public $email;
    public $dni;
    public $ruc;
    public $fono_persona;
    public $fono_empresa;


    protected $rules = [
        'email' => 'nullable|email|unique:clientes,email',
        'dni' => 'nullable|unique:clientes,dni|unique:apoderados,dni_apoderado',
        'ruc' => 'nullable|unique:empresas,ruc',
        'fono_persona' => 'nullable|unique:clientes,fono_persona',
        'fono_empresa' => 'nullable|unique:empresas,fono_empresa',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.real-time-validation');
    }
}
