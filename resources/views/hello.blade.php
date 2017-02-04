@extends('layouts.master')
@section('content')
<div class="banner">
    <h2>
        <a href="index.html">Home</a>
        <i class="fa fa-angle-right"></i>
        <span>Blank</span>
    </h2>
</div>

<div class="blank">
    <div class="blank-page">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ip</th>
                <th>organization</th>
                <th>isp</th>
                <th>longitude</th>
                <th>latitude</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>ip</th>
                <th>organization</th>
                <th>isp</th>
                <th>longitude</th>
                <th>latitude</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- //blank-page -->
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                processing: false,
                serverSide: false,
                select: true,
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {

                    // Bind click event
                    $(nRow).click(function() {
                        window.open("/plc/"+aData.query);
                    });

                    return nRow;
                },
                "ajax": '/api/data/1',
                columns: [
                    { data: 'query', name: 'ip' },
                    { data: 'org', name: 'organization' },
                    { data: 'isp', name: 'isp' },
                    { data: 'lon', name: 'longitude' },
                    { data: 'lat', name: 'latitude' },
                ],
            } );
        } );
    </script>
@stop