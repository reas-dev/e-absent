@extends('layouts.admin')
@section('title')
    Map Daerah {{ collect(request()->segments())->last() }}
@endsection
@section('customStyle')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Map Daerah {{ collect(request()->segments())->last() }}</h6>
                </div>
                <div class="card-body">

                    <div id="map" class="jumbotron min-vh-80"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

    <script src="http://maps.google.com/maps/api/js?sensor=false"
        type="text/javascript"></script>
    <script>
        var locations = {!! json_encode($participants) !!};
        console.log(locations);
        console.log(locations[0]);
        console.log(locations[0]['name']);

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(locations[0]['latitude'],locations[0]['longitude']),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i]['name']+"<br>("+locations[i]['nik']+")");
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }


    </script>
@endsection
