<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: [
                // {
                //     title  : 'event1',
                //     start  : '2023-01-01'
                //     },
                //     {
                //     title  : 'event2',
                //     start  : '2023-01-05',
                //     end    : '2010-01-07'
                //     },
                //     {
                //     title  : 'event3',
                //     start  : '2023-01-09T12:30:00',
                //     end    : '2010-01-07'
                // }
                @foreach(\App\Models\Event::get() as $event)
                    {
                        title: '{{$event->name}}',
                        start: '{{$event->datetime}}',
                        end: '{{$event->datetime}}',
                        backgroundColor: 'green',
                        color: 'green',
                    },
                @endforeach
            ]
        });
        calendar.render();


        calendar.on('dateClick', function(info) {
            alert(info)
            console.log(info)
        });
      });

    </script>
  </head>
  <body>
    <div id='calendar' style="width:800px;"></div>
  </body>
</html>
