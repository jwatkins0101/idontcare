@extends('layouts.master')
@section('content')
    <div class="banner">
        <h2>
            <a href="/dashboard">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>{{ $id }}</span>
        </h2>
    </div>
    <div class="main-grid">
        <div class="agile-grids">
            <!-- maps -->

            <div class="map-heading">
                <h2>{{ $id }}</h2>
            </div>
            <div class="agile-bottom-maps">
                <div class="col-md-6 map-grid">
                    <div class="map-bg">
                        <iframe src="https://maps.google.com/maps?q={{$data->lat}},{{$data->lon}}&hl=es;z=14&amp;output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <table>
                        <tbody><tr>
                            <th colspan="2">Network Who IS</th>
                        </tr>
                        @foreach($data as $key => $value)
                            <tr>
                                <td>{{ $key}}</td><td>{{ $value }}</td>
                            </tr>
                        @endforeach
                        </tbody></table>
                </div>
                <div class="col-md-6 ">
                        <p>{{ var_dump($domain) }}</p>
                </div>

                <div class="clearfix"> </div>
            </div>
            <!-- //maps -->
        </div>

    </div>
@stop