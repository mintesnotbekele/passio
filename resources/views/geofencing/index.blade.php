@extends('layouts.app')

@section('content')
    <h1>Geofencing using Google Maps in Laravel</h1>
    <form method="POST" action="{{ route('geofencing.store') }}">
        @csrf
        <label for="lat">Latitude:</label>
        <input type="text" name="lat" id="lat" required>
        <br>
        <label for="lng">Longitude:</label>
        <input type="text" name="lng" id="lng" required>
        <br>
        <label for="radius">Radius (in meters):</label>
        <input type="number" name="radius" id="radius" required>
        <br>
        <button type="submit">Create Geofence</button>
    </form>
</body>
</html>
