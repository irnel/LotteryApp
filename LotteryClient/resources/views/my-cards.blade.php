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

            <table id="table_mycards" class="table table-responsive-sm table-sm table-hover">
                <thead>
                    <tr>
                        <th><i class="far fa-credit-card mr-1"></i>Number</th>
                        <th></th>
                    </tr>
                </thead>

                @if ($cards != null)
                <tbody>
                    @foreach ($cards as $card)
                    <tr>
                        <td>{{ $card->id }}</td>
                        <td>
                        @if ($event->winner_card_id == $card->id)
                            <h6 class="card-text text-white  text-center mr-2">
                                <span class="badge badge-pill badge-success shadow-sm py-1 px-2">
                                    <i class="fa fa-trophy prefix mr-1" aria-hidden="true"></i>
                                    Winner
                                </span>
                            </h6>                            
                        @endif
                        </td>
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
<script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#table_mycards').DataTable();
    });
</script>
@endsection