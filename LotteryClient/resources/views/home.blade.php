@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-2">
        <div class="card-header">
            <div class="d-flex">
                <h4 class="card-text">Available Events</h4>
                @if ($events->count() > 0)
                <h5 class="card-text ml-2">
                    <span class="badge badge-pill badge-primary shadow-sm mt-1 px-2">
                        {{ $events->count() }}
                    </span>
                </h5>  
                @endif
            </div>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif

            <table id="table_events" class="table table-responsive-lg table-hover">
                <thead>
                    <tr>
                        <th><i class="far fa-calendar-alt mr-1"></i>Start Date</th>
                        <th><i class="far fa-clock mr-1"></i>Start Time</th>
                        <th><i class="far fa-credit-card mr-1"></i>Card Price</th>
                        <th><i class="fas fa-trophy mr-1"></i>Award</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($events as $event)
                    <tr>
                        <td>{{ App\Helpers\AttributeFormat::attrDate($event->start_date) }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>$ {{ App\Helpers\AttributeFormat::attrCurrency($event->card_price) }}</td>
                        <td>$ {{ App\Helpers\AttributeFormat::attrCurrency($event->award) }}</td>
                        <td><a href="{{ route('available-cards', ['eventId'=> $event->id]) }}">View Cards</a></td>
                    </tr>
                    @endforeach
                </tbody>
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
        $('#table_events').DataTable();
    });
</script>
@endsection
