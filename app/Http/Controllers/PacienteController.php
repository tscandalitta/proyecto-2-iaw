<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\ObraSocial;
use App\Estudio;
use Illuminate\Http\Request;
use DB;

class PacienteController extends Controller
{

    public function index()
    {
        $pacientes = Paciente::all();

        return view('pacientes.index', compact('pacientes'));
    }


    public function create()
    {
        $obras_sociales = ObraSocial::all();
        
        return view('pacientes.create', compact('obras_sociales'));
    }


    public function store()
    {
        $this->validate(request(), [
            'dni' => 'unique:pacientes',
            'nombre' => 'required',
            'apellido' => 'required'
        ]); 

        $paciente = Paciente::create(request(['nombre','apellido','dni','telefono','direccion','obra_social_id','historia_clinica']));

        if(request()->hasFile('estudios')){

            request()->validate([
                'estudios' => 'file|image|max:5000',
            ]);

            $imagen = base64_encode(file_get_contents(request()->file('estudios')));
            $srcImagen = "data:image/;base64, " . $imagen;

            Estudio::create(['imagen' => $imagen, 'paciente_id' => $paciente->id]);
        }

        

        return redirect()->home();
    }


    public function show($dni)
    {
        $paciente = Paciente::query()
                        ->where('dni', 'LIKE', $dni)
                        ->get();

        return $paciente;
    }

    
    public function edit(Paciente $paciente)
    {
        $obras_sociales = ObraSocial::all();

        return view('pacientes.edit', compact('paciente','obras_sociales'));
    }


    public function update(Paciente $paciente)
    {
        $paciente->nombre = request('nombre');
        $paciente->apellido = request('apellido');
        $paciente->dni = request('dni');
        $paciente->telefono = request('telefono');
        $paciente->direccion = request('direccion');
        $paciente->historia_clinica = request('historia_clinica');
        $paciente->obra_social_id = request('obra_social_id');

        $paciente->save();

        return redirect()->home();
    }


    public function updateHC(Paciente $paciente)
    {
        $paciente->historia_clinica = request('historia_clinica');
        
        $paciente->save();

        return redirect()->home();
    }

    
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->home();
    }
}
