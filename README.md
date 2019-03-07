## DropCalendar
JavaScript календарь событий (https://fullcalendar.io/)
Основная идея компонента заключается в том, чтобы дать возможность пользователю управлять событиями с использованием только мыши в режиме drag&drop. 


## Использование
Компонент включает 3 сниппета:
<ul>
    <li>DcAdmin</li>
    <li>DcShow</li>
    <li>DcTable</li>
</ul>

<strong>DcAdmin</strong> — Основной сниппет, отвечает за управление событиями. 
Добавить событие можно 2-мя способами
<ul>
    <li>Перетащить событие</li>
    <li>Кликнуть на один из дней (долгое нажатие для мобильных девайсов)</li>
</ul>
Чтобы <strong>отредактировать</strong> событие, необходимо кликнуть на него и изменить информацию в модальном окне.
<strong>Удалить</strong> событие также можно 2-мя способами:
<ul>
    <li>Кликнуть на событие и удалить</li>
    <li>Перетащить в зону удаления</li>
</ul>
Чанк <em>DcAdmin</em> отвечает за вывод календаря. 
Здесь можно изменить стандартные заголовки событий, порядок отображения.
В общем, скрипт вывода календаря и правый столбец.  
Чанк <em>DcAdminModal</em> отвечает за вывод модального окна.

Параметры сниппета:
<strong>tpl</strong> — Чанк вывода календаря и правый столбец
<strong>modal</strong> — Чанк вывода модального окна
<strong>locale</strong> — Локализация календаря. Должно сответсвовать названию js файла по адресу:
..assets/components/dropcalendar/js/mrg/locale
<strong>useBulma</strong> — Использовать bulma CSS framework (1 или 0)
<strong>useFullcalendar</strong> — Использовать библиотеку Fullcalendar (1 или 0)
<strong>useJquery</strong> — Использовать библиотеку jquery (1 или 0)

<code>[[DcAdmin]]</code>
Равносильно
<code>[[DcAdmin?
    &tpl=`DcAdmin`
    &modal=`DcAdminModal`
    &locale=`ru`
    &calendar=``
    &useBulma=`1`
    &useFullcalendar=`1`
 	&useJquery=`1`
 ]]</code>
 
Сниппет <strong>DcShow</strong>  отвечает за показ календаря пользователям. 
Функционал включает в себя возможность просмотра календаря событий и показа расширенной информации о событии. 

Чанк <em>DcShow</em> отвечает за вывод календаря
Чанк <em>DcShowModal</em> отвечает за вывод модального окна.

Сниппет <strong>DcTable</strong>  выводит все события в режиме таблицы.
Чанк <em>DcTableOuter</em> шаблон контейнера таблицы
Чанк <em>DcTableRow</em> шаблон строки таблицы.

<blockquote>Обратите внимание на то, что есть возможность использовать несколько календарей.</blockquote>
Для этого необходимо указать название календаря в параметрах:
	<code>&calendar=`0`</code>
Если не указать календарь, то выводятся все события.




## DropCalendar 
DropCalendar is a component for MODx Revolution. 
This component provide to create, edit and remove events on fullcalendar library.


## Component usage
<strong>DropCalendar</strong> provide to create, edit and remove events on fullcalendar library. 
The main idea of the component is to enable the user to manage events using only mouse.

Componenent includes 3 snippet:
<ul>
    <li>DcAdmin</li>
    <li>DcShow</li>
    <li>DcTable</li>
</ul>

<strong>DcAdmin</strong> is the Main snippet, is responsible for managing the events.
<u>Add event</u> in 2 ways
• Drag event
• Click on one of the days (long press for mobile devices)
<u>To edit</u> an event, you must click on it and change the information in a modal window.
<u>Delete</u> event is also possible in 2 ways:
• Click on the event and delete
• Drag to the remove area.

Chunk <em>DcAdmin</em> displays the calendar.
You can change event title, event showing order.
Chunk <em>DcAdminModal</em> modal window template.

Snippet parameters:
<strong>tpl</strong> — Chunk for calendar display
<strong>modal</strong> — Chunk for modal window
<strong>locale</strong> — Calendar localization. The same as js file name:
..assets/components/dropcalendar/js/mrg/locale
<strong>useBulma</strong> — Use bulma CSS framework (1 or 0)
<strong>useFullcalendar</strong> — Use Fullcalendar (1 or 0)
<strong>useJquery</strong> — Use jquery (1 or 0) 

<code>[[DcAdmin]]</code>
Equivalent
<code>[[DcAdmin?
    &tpl=`DcAdmin`
    &modal=`DcAdminModal`
    &locale=`ru`
    &calendar=``
    &useBulma=`1`
    &useFullcalendar=`1`
 	&useJquery=`1`
 ]]</code>
 
 
Snippet <strong>DcShow</strong> responsible for showing events to users. 

Snippet <strong>DcTable</strong> lists all events in the table view.
Chunk <em>DcTableOuter</em> table template
Chunk <em>DcTableRow</em> the table row template.

It is possible to use multiple calendars.
Just specify calendar name in options:
<code>&calendar=`0`</code>

## Copyright Information

DropCalendar is distributed as GPL (as MODx Revolution is), but the copyright owner
(Artsiom Burkun) grants all users of DropCalendar the ability to modify, distribute
and use DropCalendar in MODx development as they see fit, as long as attribution
is given somewhere in the distributed source of all derivative works.
