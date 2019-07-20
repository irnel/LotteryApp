@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-2">
        <div class="card-header">
            <div class="d-flex">
                <h4>Available Cards</h4>
                <h5 class="card-text ml-2">
                    <span class="badge badge-pill badge-primary shadow-sm mt-1 px-2">
                        {{ $cards->count()}}
                    </span>
                </h5>
            </div>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form id="form_cards" action="{{ route('cards.add', ['id' => $event->id]) }}" method="post">
                @method('POST')
                @csrf

                <table id="table_cards" class="table table-responsive-sm table-sm table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-credit-card mr-1"></i>Number</th>
                            <th><i class="fas fa-check mr-1"></i>Select Card</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($cards as $card)
                        <tr>
                            <td>{{ $card->id }}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input position-static" type="checkbox"
                                        name="selected_cards[]" value="{{ $card->id }}">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn fixed-btn btn-primary btn-circle btn-lg element-shadow-sm">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#table_cards').DataTable();

        var form = $('#form_cards');
        // Ajax request
        form.submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function(result) {
                    window.location.href = "{{ route('home') }}";
                }
            });
        });
        

        
    });
</script>
@endsection
