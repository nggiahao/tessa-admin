@extends(admin_view('layouts.blank'))

@section('content')
    <div class="w-full mb-3">
        <h2 class="text-3xl font-semibold capitalize">{{$crud->entity_name_plural}}</h2>
    </div>

    <!-- THE ACTUAL CONTENT -->
    <div class="w-full relative">
        <table id="tessa_table" class="table-auto bg-main border" >
            <thead>
            <tr>
                @foreach($crud->columns() as $column)
                    <th>{!! $column['label'] !!}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
                @foreach($crud->columns() as $column)
                    <th>{!! $column['label'] !!}</th>
                @endforeach
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('after_styles')
    <link href="{{url('/packages/simple-datatables/style.css')}}" rel="stylesheet" type="text/css">
@endpush

@push('after_scripts')
    <script src="{{url('/packages/simple-datatables/simple-datatables.js')}}" type="text/javascript"></script>
    <script>
        const dataTable = new window.simpleDatatables.DataTable("#tessa_table", {
            fixedHeight: true,
            ajax: {
                url: "{!! url($crud->getRoute().'/search').'?'.Request::getQueryString() !!}",
                load: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    let data = response.data;

                    return JSON.stringify(data);
                }
            },
        });
    </script>
@endpush