import './bootstrap';

import axios from 'axios';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

const calendarEl = document.getElementById("calendar");

if (calendarEl) {
    const calendar = new Calendar(calendarEl, {

        plugins: [dayGridPlugin, timeGridPlugin],

        initialView: "dayGridMonth",
        headerToolbar: {
            start: "prev,next today",
            center: "title",
            end: "dayGridMonth,timeGridWeek",
        },
        height: "auto",
    });

    calendar.render(); // カレンダーを表示
}
