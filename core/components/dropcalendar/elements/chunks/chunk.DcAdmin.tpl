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
    <div class="columns">
        <div class="column is-9">
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
                    /* start coordinate count
                       -----------------------------------------------------------------*/
                    currentMousePos = {
                        x: -1,
                        y: -1
                    };
                    jQuery(document).on("mousemove", function(event) {
                        currentMousePos.x = event.pageX;
                        currentMousePos.y = event.pageY;
                    });

                    /* initialize the external events
                       -----------------------------------------------------------------*/
                    $('.event-category').each(function() {
                        $(this).draggable({
                            zIndex: 999,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0 //  original position after the drag
                        });
                    });


                    /* initialize the calendar
                    -----------------------------------------------------------------*/
                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month'
                        },
                        editable: true,
                        droppable: true, // this allows things to be dropped onto the calendar
                        dragRevertDuration: 0,
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

                            // any other sources...

                        ],

                        displayEventEnd: true,
                        selectable: true,
                        durationEditable: false,
                        selectHelper: true,

                        select: function(start) {
                            start = moment(start).format("DD.MM.YYYY");

                            $('#form-title').val('');
                            $('#form-start').val(start);
                            $('#form-end').val(start);


                            $('#save-changes').hide();
                            $('#delete-button').hide();
                            $('#save-new').show();

                            openModal();
                        },

                        eventClick: function(callEvent) {
                            $('#save-new').hide();
                            $('#save-changes').show();
                            $('#delete-button').show();

                            $('#form-title').val(callEvent.title);
                            $('#form-start').val(moment(callEvent.start).format("DD.MM.YYYY"));


                            if (callEvent.allDay == true) {
                                $('#allDayForm').prop('checked', true);
                                $( "#form-start-time" ).prop("disabled", true);
                                $( "#form-end-time" ).prop("disabled", true);
                            }
                            else {
                                $('#allDayForm').prop("checked", false);
                                $( "#form-start-time" ).prop("disabled", false);
                                $( "#form-end-time" ).prop("disabled", false);

                                $('#form-start-time').val(moment(callEvent.start).format("HH:mm"));
                                if (callEvent.end !== null ){
                                    $('#form-end-time').val(moment(callEvent.end).format("HH:mm"));
                                }
                                else {
                                    $('#form-end-time').val('');
                                }
                            }

                            $('#form-info').val(callEvent.info);

                            $('#form-external-event').css({
                                "background-color": callEvent.backgroundColor,
                                "border": '1px solid',
                                'border-color': callEvent.borderColor
                            });

                            $('#form-background-color').val(callEvent.backgroundColor);
                            $('#form-border-color').val(callEvent.borderColor);
                            $('#form-text-color').val(callEvent.textColor);

                            currentEvent = callEvent;
                            openModal();

                        },

                        drop: function(date) {
                            start = moment(date).format("DD.MM.YYYY");

                            newEvent = [];
                            newEvent.action = 'add';
                            newEvent.calendar = calendar;

                            newEvent.title = $('#external-text').val();

                            newEvent.start = moment(start +' '+ $('#start-time').val(), "DD.MM.YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                            newEvent.allDay = $('#allDay').is(":checked");

                            if (newEvent.allDay == true || $('#end-time').val() == '') {
                                newEvent.end = null;
                            }
                            else {
                                newEvent.end = moment(start +' '+ $('#end-time').val(), "DD.MM.YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                            }

                            newEvent.info = $('#info').val();

                            newEvent.backgroundColor = $('#background-color').val();
                            newEvent.borderColor = $('#border-color').val();
                            newEvent.textColor = $('#text-color').val();


                            $.ajax({
                                url: 'assets/components/dropcalendar/action.php',
                                data: {
                                    'calendar': newEvent.calendar,
                                    'title': newEvent.title,
                                    'start': newEvent.start,
                                    'end': newEvent.end,
                                    'allDay': newEvent.allDay,
                                    'info': newEvent.info,
                                    'backgroundColor': newEvent.backgroundColor,
                                    'borderColor': newEvent.borderColor,
                                    'textColor': newEvent.textColor,
                                    'action': newEvent.action
                                },

                                type: "POST",
                                success: function(response) {
                                    response = JSON.parse(response);
                                    if (response.status === 'failure') {
                                        alert(response.message);
                                    } else {
                                        newEvent.id = response.eventid;
                                        $('#calendar').fullCalendar('renderEvent', newEvent, false);
                                        console.log(response.message);
                                    }
                                },
                                error: function(e) {
                                    console.log(e.responseText);
                                    alert(e.responseText);
                                }
                            });


                        },

                        eventDrop: function(event) {
                            start = event.start.format("YYYY-MM-DD HH:mm");
                            if (event.end !== null ){
                                end = event.end.format("YYYY-MM-DD HH:mm");
                            }
                            else {
                                end = event.start.format("YYYY-MM-DD");
                            }
                            action = 'update'
                            $.ajax({
                                url: 'assets/components/dropcalendar/action.php',
                                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&action=' + action,
                                type: "POST",
                                success: function(response) {
                                    res = JSON.parse(response);
                                    if (res.status === 'failure') {
                                        alert(res.message);
                                    } else {
                                        event.id = res.eventid;
                                        console.log(res.message);
                                    }

                                },
                                error: function(e) {
                                    console.log(e.responseText);
                                    alert(e.responseText);
                                }
                            });
                        },

                        eventDragStop: function(event) {
                            if (isElemOverDiv()) {
                                $('#calendar').fullCalendar('removeEvents', [event.id]);
                                event.action = 'delete';

                                $.ajax({
                                    url: 'assets/components/dropcalendar/action.php',
                                    data: 'id=' + event.id +
                                    '&action=' + event.action,
                                    type: 'POST',
                                    dataType: 'json',
                                    success: function(response) {
                                        console.log(response.message);
                                        $('#calendar').fullCalendar('removeEvents', [event.id]);

                                    },
                                    error: function(e) {
                                        console.log(e.responseText);
                                    }
                                });
                            }
                        }

                    });


                    /* datepicker, timepicker, allday input time disable
                    -----------------------------------------------------------------*/
                    $( "#form-start, #form-end" ).datepicker({
                        closeText: 'Закрыть',
                        prevText: '&#x3c;Пред',
                        nextText: 'След&#x3e;',
                        currentText: 'Сегодня',
                        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                        monthNamesShort: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                        dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
                        dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
                        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                        weekHeader: 'Нед',
                        dateFormat: "dd.mm.yy",
                        changeMonth: true,
                        changeYear: true,
                        yearRange: "1970:2020"
                    });

                    $('#start-time, #end-time, #form-start-time, #form-end-time').timepicker({
                        timeFormat: 'HH:mm',
                        minTime: new Date(0, 0, 0, 5, 0, 0),
                        maxTime: new Date(0, 0, 0, 23, 0, 0),
                        startHour: 6,
                        startTime: new Date(0, 0, 0, 19, 30, 0),
                        interval: 30
                    });

                    $('input[name="allDay"]').change(function(){
                        if ($('#allDay').is(":checked") == true) {
                            $( "#start-time" ).prop("disabled", true);
                            $( "#end-time" ).prop("disabled", true);

                        }
                        else {
                            $( "#start-time" ).val("").prop("disabled", false);
                            $( "#end-time" ).val("").prop("disabled", false);
                        }
                    });

                    $('input[name="allDayForm"]').change(function(){
                        if ($('#allDayForm').is(":checked") == true) {
                            $( "#form-start-time" ).prop("disabled", true);
                            $( "#form-end-time" ).prop("disabled", true);

                        }
                        else {
                            $( "#form-start-time" ).val("").prop("disabled", false);
                            $( "#form-end-time" ).val("").prop("disabled", false);
                        }
                    });

                });


                /* save, update, delete events
                -----------------------------------------------------------------*/
                function isElemOverDiv() {
                    trashEl = jQuery('#trash');
                    ofs = trashEl.offset();
                    x1 = ofs.left;
                    x2 = ofs.left + trashEl.outerWidth(true);
                    y1 = ofs.top;
                    y2 = ofs.top + trashEl.outerHeight(true);

                    return (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
                        currentMousePos.y >= y1 && currentMousePos.y <= y2);
                }

                function saveNewEvent() {
                    newEvent = [];
                    newEvent.calendar = calendar;
                    newEvent.action = 'add';
                    newEvent.title = $('#form-title').val();

                    newEvent.start = moment($('#form-start').val() +' '+ $('#form-start-time').val(), "DD.MM.YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                    newEvent.allDay = $('#allDayForm').is(":checked");

                    if (newEvent.allDay == true || $('#form-end-time').val() == '') {
                        newEvent.end = null;
                    }
                    else {
                        newEvent.end = moment($('#form-start').val() +' '+ $('#form-end-time').val(), "DD.MM.YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                    }

                    newEvent.info = $('#form-info').val();

                    newEvent.backgroundColor = $('#form-background-color').val();
                    newEvent.borderColor = $('#form-border-color').val();
                    newEvent.textColor = $('#form-text-color').val();


                    closeModal();

                    $.ajax({
                        url: 'assets/components/dropcalendar/action.php',
                        data: {
                            'calendar': newEvent.calendar,
                            'title': newEvent.title,
                            'start': newEvent.start,
                            'end': newEvent.end,
                            'info': newEvent.info,
                            'allDay': newEvent.allDay,
                            'backgroundColor': newEvent.backgroundColor,
                            'borderColor': newEvent.borderColor,
                            'textColor': newEvent.textColor,
                            'action': newEvent.action
                        },
                        type: "POST",

                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.status === 'failure') {
                                alert(response.message);
                            } else {
                                newEvent.id = response.eventid;
                                $('#calendar').fullCalendar('renderEvent', newEvent, false);
                                console.log(response.message);
                            }
                        },
                        error: function(e) {
                            console.log(e.responseText);
                            alert(e.responseText);
                        }
                    });
                }

                function updateCurrentEvent() {
                    currentEvent.action = 'updatefull';
                    currentEvent.title = $('#form-title').val();

                    currentEvent.start = moment($('#form-start').val() +' '+ $('#form-start-time').val(), "DD.MM.YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                    currentEvent.allDay = $('#allDayForm').is(":checked");

                    if (currentEvent.allDay == true || $('#form-end-time').val() == '') {
                        currentEvent.end = null;
                    }
                    else {
                        currentEvent.end = moment($('#form-start').val() +' '+ $('#form-end-time').val(), "DD.MM.YYYY HH:mm").format("YYYY-MM-DD HH:mm");
                    }

                    currentEvent.info = $('#form-info').val();

                    currentEvent.backgroundColor = $('#form-background-color').val();
                    currentEvent.borderColor = $('#form-border-color').val();
                    currentEvent.textColor = $('#form-text-color').val();

                    closeModal();

                    $.ajax({
                        url: 'assets/components/dropcalendar/action.php',
                        data: {
                            'id': currentEvent.id,
                            'title': currentEvent.title,
                            'start': currentEvent.start,
                            'end': currentEvent.end,
                            'info': currentEvent.info,
                            'allDay': currentEvent.allDay,
                            'backgroundColor': currentEvent.backgroundColor,
                            'borderColor': currentEvent.borderColor,
                            'textColor': currentEvent.textColor,
                            'action': currentEvent.action
                        },

                        type: "POST",
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.status === 'failure') {
                                alert(response.message);
                            } else {
                                $('#calendar').fullCalendar('removeEvents', [currentEvent.id]);
                                $('#calendar').fullCalendar('renderEvent', currentEvent, false);
                                console.log(response.message);
                                currentEvent = [];
                            }

                        },
                        error: function(e) {
                            console.log(e.responseText);
                            alert(e.responseText);
                        }
                    });
                }

                function deleteEvent() {
                    currentEvent.action = 'delete';

                    $.ajax({
                        url: 'assets/components/dropcalendar/action.php',
                        data: 'id=' + currentEvent.id +
                        '&action=' + currentEvent.action,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            console.log(response.message + ' ' + currentEvent.id);
                            $('#calendar').fullCalendar('removeEvents', [currentEvent.id]);
                            closeModal();
                            currentEvent = [];

                        },
                        error: function(e) {
                            console.log(e.responseText);
                        }
                    });
                }


                /* color change
                -----------------------------------------------------------------*/
                function changeColor(background, border, text) {
                    $('#external-event').css({
                        "background-color": background,
                        "border": '1px solid',
                        'border-color': border
                    });

                    $('#background-color').val(background);
                    $('#border-color').val(border);
                    $('#text-color').val(text);
                }

                function changeFormColor(background, border, text) {
                    $('#form-external-event').css({
                        "background-color": background,
                        "border": '1px solid',
                        'border-color': border
                    });

                    $('#form-background-color').val(background);
                    $('#form-border-color').val(border);
                    $('#form-text-color').val(text);
                }

            </script>

            <div id='calendar'>
                <div id='loading'>Идет загрузка...</div>
            </div>

            <div style='clear:both'></div>

        </div>
        <div class="column is-3 m-l-10">

            <h3 class="title is-4 m-b-5">Добавить событие:</h3>
            <p>← Перетащите событие на календарь</p>


            <div id="event-categories">
                <div id="external-event" class="event-category" style="background-color: #3d9400">
                    <input id="external-text" class="input is-small"  value="Событие" >

                    <input id="background-color" type="hidden" value="#3d9400">
                    <input id="border-color" type="hidden" value="#3d9400">
                    <input id="text-color" type="hidden" value="#ffffff">

                </div>

                <!--
                <script>
                    $.ajax({
                        url: "getColor.php",
                        data: {
                            position: "column"
                        },
                        type: "POST",
                        success: function( result ) {
                            $(result).appendTo('#right-table');
                        }
                    });
                </script>
                -->
                <table class="table colors" width="100%" id="right-table">
                    <tr>
                        <td class="label-width">
                            <div class="fc-color m-r-5" style="background-color: #3d9400; border: 1px solid; #3d9400; color: #ffffff" onclick="changeColor('#3d9400', '#3d9400', '#ffffff')">
                                <br>
                            </div>
                        </td>
                        <td>
                            <span class="scout-names">Зелёный</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-width">
                            <div class="fc-color m-r-5" style="background-color: #0a76f2; border: 1px solid; #0a76f2; color: #ffffff" onclick="changeColor('#0a76f2', '#0a76f2', '#ffffff')">
                                <br>
                            </div>
                        </td>
                        <td>
                            <span class="scout-names">Синий</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-width">
                            <div class="fc-color m-r-5" style="background-color: #f50a0a; border: 1px solid; #f50a0a; color: #000000" onclick="changeColor('#f50a0a', '#f50a0a', '#000000')">
                                <br>
                            </div>
                        </td>
                        <td>
                            <span class="scout-names">Красный</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-width">
                            <div class="fc-color m-r-5" style="background-color: #ffffff; border: 1px solid; #000000; color: #000000" onclick="changeColor('#ffffff', '#000000', '#000000')">
                                <br>
                            </div>
                        </td>
                        <td>
                            <span class="scout-names">Белый</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-width">
                            <div class="fc-color m-r-5" style="background-color: #fff648; border: 1px solid; #000000; color: #000000" onclick="changeColor('#fff648', '#000000', '#000000')">
                                <br>
                            </div>
                        </td>
                        <td>
                            <span class="scout-names">Жёлтый</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-width">
                            <div class="fc-color m-r-5" style="background-color: #080707; border: 1px solid; #080707; color: #ffffff" onclick="changeColor('#080707', '#080707', '#ffffff')">
                                <br>
                            </div>
                        </td>
                        <td>
                            <span class="scout-names">Чёрный</span>
                        </td>
                    </tr>

                </table>

                <hr class="m-b-10 m-t-3">

                <h4 class="title is-5 m-b-5">Параметры события:</h4>

                <table class="table params m-b-5">
                    <thead>
                    <th width="50%">Начало:</th>
                    <th width="50%">Конец:</th>
                    </thead>
                    <tr>
                        <td>
                            <input class="input time" type="text" id="start-time" value="19:30">
                        </td>
                        <td>
                            <input class="input time" type="text" id="end-time">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label class="checkbox">
                                <input type="checkbox" name="allDay" id="allDay">
                                Весь день
                            </label>
                        </td>
                    </tr>
                </table>

                <p><b>Примечание:</b></p>
                <textarea class="textarea" id="info" name="info" rows="1"></textarea>

                <hr class="m-b-10 m-t-10">

                <h5 class="title is-6 m-b-5">Удалить событие:</h5>
                <div id="trash" class="label-delete">
                    <p>перетащить сюда</p>
                </div>

            </div>
        </div>
    </div>
</div>

<hr>