@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
    <h1>Reportes</h1>

    <form method="GET" action="{{ route('reports.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label>Desde</label>
                <input type="date" name="from" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Hasta</label>
                <input type="date" name="to" class="form-control">
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Generar Reporte</button>
            </div>
        </div>
    </form>

    @if(isset($reportData))
        <h3>Resultados</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Transacción</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData as $row)
                    <tr>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->type }}</td>
                        <td>${{ $row->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
