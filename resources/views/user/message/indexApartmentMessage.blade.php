@extends('layouts.app')
@section('head')
<script>    
    var visualizations = {!! json_encode($getVisualizationsForThisApartment->toArray()) !!};
</script>
@vite(['resources/js/confirmDeletation.js', 'resources/js/charts.js'])
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="stats_container">
                    <h4 class="d-inline">Questo appartamento è stato visualizzato {{ $apartment->visualizations->where('apartment_id',$apartment->id)->count()}} volte</h4>
                    <canvas id="myChart"></canvas>
                </div>
                @if(isset($messages[0]))
                <table class="table text-center">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col">Mittente</th>
                            <th scope="col">Messaggio</th>
                            <th scope="col">Data</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                            @foreach ($messages as $message)
                            <tr class="{{!$message->status ? 'table-active' : ''}}">
                                <td>{{ $message->email }}</td> 
                                <td>{{ $message->text_content }}</td>
                                <td>{{ $message->created_at }}</td></td>
                                <td>
                                    <div class="d-flex justify-content-evenly">
                                        <form action="{{ route('user.messages.toggle', $message->id) }}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                            <button type="submit" title="{{!$message->status ? 'Segna come già letto' : 'Segna come da leggere' }}" class="visibility-button border-0" ><i class="fa-2x fa-solid {{$message->status ? 'fa-envelope-open-text' : 'fa-envelope' }}"></i></button>
                                        </form>
                                        <form class="form-deleter d-inline" action="{{ route('user.messages.destroy', ['message'=>$message, 'apartment'=>$apartment] ) }}" method="POST" data-element-name="{{ $message->email }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Elimina</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                @else
                    <div>
                        Nessun messaggio da visualizzare
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection