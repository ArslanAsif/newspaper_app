@section('css')
    <!-- Datatables -->
    <link href="{{ url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ url('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons();
                    }
                };
            }();
            $('#datatable').dataTable();

            TableManageButtons.init();
        });
    </script>
@endsection