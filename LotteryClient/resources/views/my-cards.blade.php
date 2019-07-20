@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-2">
        <div class="card-header">
            <div class="d-flex">
                <h4>My Cards</h4>
                <h5 class="card-text ml-2">
                @if ($cards != null)
                    <span class="badge badge-pill badge-primary shadow-sm mt-1 px-2">
                        {{ $cards->count() }}
                    </span>
                @endif
                </h5>
            </div>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif

            <table id="table_mycards" class="table table-responsive-lg table-hover">
                <thead>
                    <tr>
                        <th><i class="far fa-credit-card mr-1"></i>Number</th>
                    </tr>
                </thead>

                @if ($cards != null)
                <tbody>
                    @foreach ($cards as $card)
                    <tr>
                        <td>{{ $card->id }}</td>
                    </tr>
                    @endforeach
                </tbody>                    
                @endif
            </table>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#table_mycards').DataTable();
    });
</script>
@endsection