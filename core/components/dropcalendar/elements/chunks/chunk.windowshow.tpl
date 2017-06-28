    <div class='row'>
        <p style='text-align: center;'><b>Событие:</b> " + calEvent.title + "</p>
        <div class='col-md-6'>
            <p><b>Начало:</b><br/> " + calEvent.start.format("YYYY-MM-DD HH:mm") + "</p>
            <p><b>Конец:</b><br/> " + calEvent.end.format("YYYY-MM-DD HH:mm") + "</p>
            <p><b>Сайт:</b><br/> <a href=" + calEvent.site + " target='_blank'>" + calEvent.site + "</a></p>

        </div>
        <div class='col-md-6'>
            <p><b>Место:</b><br/> " + calEvent.mesto + "</p>

            <p><b>Примечание:</b><br/> " + calEvent.prim + "</p>
        </div>
    </div>