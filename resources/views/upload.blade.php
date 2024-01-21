@extends('layouts.app')

@section('title', 'Upload Excel')

@section('content')
    <form action="{{ url('/upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1 style="font-size: 1.5em; margin-bottom: 1em;">Upload Excel File</h1>
        <div style="margin-bottom: 1em;">
            <label for="excel_file" style="display: block; margin-bottom: 0.5em; font-size: 1em;">Choose File:</label>
            <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls">
        </div>
        <button type="submit">Upload</button>
    </form>
@endsection