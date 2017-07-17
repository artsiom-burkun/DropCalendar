## DropCalendar

DropCalendar is a component for MODx Revolution. 
This component provide to create, edit and remove events on fullcalendar library.


## Component usage
Use ManageEvents snippet to work with events.
Use ShowEvents snippet to show all events.
Use ShowTable to get all information in one table 
 
[[ManageEvents]] 
is equal  
[[ManageEvents?
	&tpl=`eventsManagementTpl`
	&popupWindow=`windowOuterTemplate`
	&locale=`ru`
	&calendarNumber=`0`
	&useJquery=`1`
	&useJqueryUi=`1`
	&useFullcalendar=`1`
	&useBootstrap=`1`
]]
by default. 
Change &calendarNumber value to work with different calendars.
Change  &locale value to set your locale.

## Copyright Information

DropCalendar is distributed as GPL (as MODx Revolution is), but the copyright owner
(Artsiom Burkun) grants all users of DropCalendar the ability to modify, distribute
and use DropCalendar in MODx development as they see fit, as long as attribution
is given somewhere in the distributed source of all derivative works.