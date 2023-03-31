@extends('layouts.app')
@section('head')
{{-- <script>
var sites = {!! json_encode($allVisualizationForThisApartment -> toArray())!!}
</script>     --}}
@vite(['resources/js/confirmDeletation.js', 'resources/js/charts.js'])
@endsection
@section('content')
    <div id="apartment-messages-index" class="container">
        <div class="row">
            <div class="col-12">
                <div class="stats_container">
                    <h4 class="mb-5">Questo appartamento è stato <span class="brand-color">visualizzato</span> {{ $apartment->visualizations->where('apartment_id',$apartment->id)->count()}} volte</h4>
                </div>
                @if(isset($messages[0]))
                <div class="container">
                    <div class="row">
                        <div class="col-3 d-none d-lg-block">
                            <h4>Mittente</h4>
                        </div>
                        <div class="col-5 d-none d-lg-block">
                            <h4>Messaggio</h4>
                        </div>
                        <div class="col-2 d-none d-lg-block">
                            data
                        </div>
                        <div class="col-2 d-none d-lg-block">
                            azioni
                        </div>
                    </div>
                    @foreach ($messages as $message)
                        <div class="row message-element align-items-center py-3 {{!$message->status ? 'unread-message' : ''}}">
                            <div class="col-12 col-lg-3">
                                <p>{{ $message->email }}</p>
                            </div> 
                            <div class="col-6 col-lg-5">
                                <p>{{ $message->text_content }}</p>
                            </div>
                            <div class="col-3 col-lg-2">
                                <p>{{ $message->created_at }}</p>
                            </div>
                            <div class="col-3 col-lg-2">
                                <div class="d-flex justify-content-evenly">
                                    <form action="{{ route('user.messages.toggle', $message->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                        <button type="submit" title="{{!$message->status ? 'Segna come già letto' : 'Segna come da leggere' }}" class="see-message visibility-button border-0" ><i class="fa-2x fa-solid {{$message->status ? 'fa-envelope-open-text' : 'fa-envelope' }}"></i></button>
                                    </form>
                                    <form class="form-deleter d-inline" action="{{ route('user.messages.destroy', ['message'=>$message, 'apartment'=>$apartment] ) }}" method="POST" data-element-name="{{ $message->email }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger ms-3"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <div>
                        Nessun messaggio da visualizzare
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection