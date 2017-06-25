<script>
    $(document).ready(function() {
        /* initialize the calendar
         -----------------------------------------------------------------*/
        var $modal = $('#event-management');

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },

            events: "assets/components/dropcalendar/action.php",
            timeFormat: 'HH:mm',

            editable: false,
            displayEventEnd: true,
            droppable: false, // this allows things to be dropped onto the calendar
            selectable: false,
            selectHelper: false,

            eventClick: function(calEvent) {
                var form = $("<form></form>");

                form.append("[[+windowShow]]");

                $modal.modal({
                    backdrop: 'static'
                });
                $modal.find('.remove-event').hide().end()
                    .find('.save-event').hide().end()
                    .find('.modal-body').empty().prepend(form).end()
                    .find('.remove-event').unbind('click');
            },






        });


    });
</script>


<div id='wrap'>

    <div class="container">

        <!-- start: PAGE CONTENT -->
        <div class="row">
            <div class="col-sm-12">
                <div id="calendar"></div>
            </div>
        </div>
        <!-- end: PAGE CONTENT-->

    </div>
</div>

<div style='clear:both'></div>