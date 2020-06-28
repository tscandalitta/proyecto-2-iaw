@extends ('layouts.app')

@section ('title', 'Inicio')

@section ('custom-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/css/magnific-popup.min.css">
<link rel="stylesheet" href="/css/index.css">
@endsection

@section ('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-5">
            <div class="table-responsive">
                <table id="tabla-pacientes" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Apellido</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                        <tr onclick="">
                            <td>{{ $paciente->apellido }}</td>
                            <td>{{ $paciente->nombre }}</td>
                            <td id="td-dni">{{ $paciente->dni }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card mb-2" id="card-pacientes">

                <div class="card-header">
                    <label id="field-id" hidden></label>
                    <div class="row">
                        <div class="col">

                            <h4 id="field-nombre"></h4>
                            <label for="field-dni">DNI: </label>
                            <label id="field-dni"></label>
                            <h6 id="field-obraSocial"></h6>


                        </div>
                        <div class="col">
                            <label for="field-dni">Tel: </label>
                            <h6 id="field-telefono"></h6>
                            <label for="field-dni">Direccion: </label>
                            <h6 id="field-direccion"></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-edit" method="POST" action="">
                        @method('PATCH')
                        @csrf

                        <label for="field-historiaClinica">Historia clínica</label>
                        <textarea class="form-control mb-3" id="field-historiaClinica" name="historia_clinica"
                            rows="8"></textarea>
                        <div class="row">
                            <div class="col d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary" disabled>Guardar HC</button>
                                <a type="button" href="" class="btn btn-primary" id="btn-modificar-datos"
                                    disabled>Modificar datos</a>

                            </div>

                        </div>
                    </form>
                    
                </div>

            </div>
            <div class="card">
                <div class="popup-gallery mt-3" id="div-estudios">
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section ('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="/js/magnific-popup.js"></script>
<script src="/js/gallery.js"></script>
<script src="/js/index.js"></script>
@endsection
