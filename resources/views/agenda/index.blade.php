
@extends('layouts.dashboard')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@endsection

@section('title')
    Agenda
@endsection

@section('content')
<div class="container-fluid mb-5">
    <div class="shadow px-4 py-3 card bg-white mb-5 overflow-auto">
        <div id='calendar'></div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/agenda.js') }}"></script>
    <script src="{{ asset('js/agenda-es.js') }}"></script>

    <script>
         document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: baseURL +'/agenda/eventos'
            });
            calendar.render();
        });
    </script>
@endsection
