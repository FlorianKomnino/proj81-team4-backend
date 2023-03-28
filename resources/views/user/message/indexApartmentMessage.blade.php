@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-hover text-center">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col">Mittente</th>
                            <th scope="col">Messaggio</th>
                            <th scope="col">Data</th>
                            <th scope="col">Azione</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->email }}</td> 
                            <td>{{ $message->text_content }}</td>
                            <td>{{ $message->created_at }}</td></td>
                            <td>
                                <div class="d-flex">
                                    <a href="" class="btn btn-primary me-2">Rispondi</a>
                                    <a href="" class="btn btn-danger">Cancella</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection