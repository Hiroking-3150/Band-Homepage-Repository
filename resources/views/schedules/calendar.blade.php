<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app(}->getLocale()) }">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ライブスケジュール</title>
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
    </head>
    <body>
        <div id="calendar"></div> 
        
        <div class="footer">
            <a href="/">トップページへ戻る</a>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                console.log(@json($events, JSON_PRETTY_PRINT));
                var events = Object.values(@json($events));

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'ja',
                    eventSources: [  
                        {
                            events: events.map(function(event){
                                // console.log(event);
                                return {
                                    id: event.id,
                                    title: event.title,
                                    start: event.start,
                                    // description: event.event_detail,
                                };
                            }),
                            color: 'blue',   
                            textColor: 'white'
                        }
                    ],
                    eventClick: function(info) {
                        console.log(info.event);
                        console.log('イベントがクリックされました');
                        var event_id = info.event.id;  
                        console.log('ID:', event_id);
                        console.log('遷移先URL:', '/schedules/' + event_id);
                        window.location.href = '/schedules/' + event_id; 

                    },

                    displayEventTime: false,
                });
 
                calendar.render();
            });
        </script>
    </body>
</html>
