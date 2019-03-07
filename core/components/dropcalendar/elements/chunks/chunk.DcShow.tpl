<script>
    function openModal() {
        $("#modal").prop( "class", "modal is-active" );
    }

    function closeModal() {
        $('#modal').prop( "class", "modal" );
    }
</script>
<hr>

<div class="container">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Binds to the global ajax scope
        $( document ).ajaxStart(function() {
            $( "#loading" ).show();
        });

        $( document ).ajaxComplete(function() {
            $( "#loading" ).hide();
        });

        calendar = '[[+calendar]]';
        currentEvent = [];

        $(document).ready(function() {
            /* initialize the calendar
            -----------------------------------------------------------------*/
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar
                navLinks: false, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events

                eventSources: [
                    {
                        url: 'assets/components/dropcalendar/action.php',
                        type: 'POST',
                        data: {
                            action: 'get',
                            calendar: calendar
                        },
                        error: function(e) {
                            console.log(e.responseText);
                            alert(e.responseText);
                        }

                    }
                ],

                displayEventEnd: true,
                selectable: true,
                durationEditable: false,
                selectHelper: true,


                eventClick: function(callEvent) {
                    $('#modal-title').html(callEvent.title);
                    $('#modal-time').html(moment(callEvent.start).format("DD.MM.YYYY"));

                    if (callEvent.allDay == true) {
                        $('#modal-time').append(' весь день');
                    }
                    else {
                        $('#modal-time').append(' с ').append(moment(callEvent.start).format("HH:mm"));

                        if (callEvent.end !== null ){
                            $('#modal-time').append(' по ').append(moment(callEvent.end).format("HH:mm"));
                        }
                        else {

                        }
                    }

                    $('#modal-content').html(callEvent.info);

                    currentEvent = callEvent;
                    openModal();

                },

            });
        });
    </script>

    <div id='calendar'>
        <div id='loading'>Идет загрузка...</div>
    </div>

    <div style='clear:both'></div>

</div>

<hr>