<!--http://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-main">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Calendar
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Draggable Events/To-Do's</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id='external-events'>

                            <div class='fc-event bg-light-blue'>New Event</div>

                            <!--                            <div class="checkbox">-->
                            <!--                                <label for='drop-remove'>-->
                            <!--                                    <input type='checkbox' id='drop-remove'/>-->
                            <!--                                    remove after drop-->
                            <!--                                </label>-->
                            <!--                            </div>-->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Event/To-Do</h3>
                    </div>
                    <div class="box-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                            <ul class="fc-color-picker" id="color-chooser">
                                <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                            </ul>
                        </div>
                        <!-- /btn-group -->
                        <div class="input-group" style="margin-bottom: 10px;">
                            <select id="event_category" class="form-control">
                                <option value="task">To-Do</option>
                                <option value="event">Event</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                            <div class="input-group-btn">
                                <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                            </div>
                            <!-- /btn-group -->
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Delete Event</h3>
                    </div>
                    <div id="trash"
                         style="height:100px; width: 90%;border: 1px solid red; padding: 35px 0 0 17px; margin: 10px 0 10px 15px;">
                        Drop Your Event To Delete
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>

    $(document).ready(function () {

        function ini_events(ele) {
            ele.each(function () {

                $(this).data('event', {
                    title: $.trim($(this).text()),
                    eventCategory: $.trim($('#event_category').val()),
                    backgroundColor: currColor,
                    borderColor: currColor,// use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }

        ini_events($('#external-events div.fc-event'));

        var zone = "05:30";  //Change this to your timezone

//        $.ajax({
//            url: '',
//            type: 'POST', // Send post data
////            data: 'type=fetch',
//            async: false,
//            success: function(s){
//                json_events = s;
//            }
//        });


        var currentMousePos = {
            x: -1,
            y: -1
        };
        jQuery(document).on("mousemove", function (event) {
            currentMousePos.x = event.pageX;
            currentMousePos.y = event.pageY;
        });

        /* initialize the external events
         -----------------------------------------------------------------*/

        $('#external-events .fc-event').each(function () {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()),
                eventCategory: 'event',// use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        getFreshEvents();

        function getFreshEvents() {
            $.ajax({
                url: '<?php echo base_url(ADMIN_PATH.'calendar/getEvents')?>',
                type: 'POST', // Send post data
                // data: 'type=fetch',
                async: false,
                success: function (s) {
                    freshevents = s;
                }
            });
            $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
        }

        $('#calendar').fullCalendar({
            events: JSON.parse(freshevents),
//            events: [{"id":"14","title":"New Event","start":"2015-10-24T16:00:00+04:00","allDay":false}],
            utc: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true,
            slotDuration: '00:30:00',
            eventReceive: function (event) {
                var title = event.title;
                var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
                var task_type = event.eventCategory;
                var bgColor = event.backgroundColor;
                var bColor = event.borderColor;
                $.ajax({
                    url: '<?php echo base_url(ADMIN_PATH.'calendar/addEvent')?>',
                    data: 'title=' + title + '&start=' + start + '&task=' + task_type + '&bgColor=' + bgColor + '&bColor=' + bColor,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        event.id = response.eventId;
                        $('#calendar').fullCalendar('updateEvent', event);
                    },
                    error: function (e) {
                        console.log(e.responseText);

                    }
                });
                $('#calendar').fullCalendar('updateEvent', event);
                console.log(event);
            },
            eventDrop: function (event, delta, revertFunc) {
                var title = event.title;
                var start = event.start.format();
                var end = (event.end == null) ? start : event.end.format();
                $.ajax({
                    url: '<?php echo base_url(ADMIN_PATH.'calendar/editEvent')?>',
                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&eventId=' + event.id,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.status != 'success')
                            revertFunc();
                    },
                    error: function (e) {
                        revertFunc();
                        alert('Error processing your request: ' + e.responseText);
                    }
                });
            },
            eventClick: function (event, jsEvent, view) {
                console.log(event.id);
                var title = prompt('Event Title:', event.title, {buttons: {Ok: true, Cancel: false}});
                if (title) {
                    event.title = title;
                    console.log('title=' + title + '&eventId=' + event.id);
                    $.ajax({
                        url: '<?php echo base_url(ADMIN_PATH.'calendar/editTitleEvent')?>',
                        data: 'title=' + title + '&eventId=' + event.id,
                        type: 'POST',
                        dataType: 'json',
                        success: function (response) {
                            if (response.status == 'success')
                                $('#calendar').fullCalendar('updateEvent', event);
                        },
                        error: function (e) {
                            alert('Error processing your request: ' + e.responseText);
                        }
                    });
                }
            },
            eventResize: function (event, delta, revertFunc) {
                console.log(event);
                var title = event.title;
                var end = event.end.format();
                var start = event.start.format();
                //update(title,start,end,event.id);
                $.ajax({
                    url: '<?php echo base_url(ADMIN_PATH.'calendar/editEvent')?>',
                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&eventId=' + event.id,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 'success')
                            $('#calendar').fullCalendar('updateEvent', event);
                    },
                    error: function (e) {
                        alert('Error processing your request: ' + e.responseText);
                    }
                });
            },
            eventDragStop: function (event, jsEvent, ui, view) {
                if (isElemOverDiv()) {
                    var con = confirm('Are you sure to delete this event permanently?');
                    if (con == true) {
                        $.ajax({
                            url: '<?php echo base_url(ADMIN_PATH.'calendar/removeEvent')?>',
                            data: 'eventId=' + event.id,
                            type: 'POST',
                            dataType: 'json',
                            success: function (response) {
                                console.log(response);
                                if (response.status == 'success') {
                                    $('#calendar').fullCalendar('removeEvents');
                                    getFreshEvents();
                                }
                            },
                            error: function (e) {
                                alert('Error processing your request: ' + e.responseText);
                            }
                        });
                    }
                }
            }

        });


        function isElemOverDiv() {
            var trashEl = jQuery('#trash');

            var ofs = trashEl.offset();

            var x1 = ofs.left;
            var x2 = ofs.left + trashEl.outerWidth(true);
            var y1 = ofs.top;
            var y2 = ofs.top + trashEl.outerHeight(true);

            if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
                currentMousePos.y >= y1 && currentMousePos.y <= y2) {
                return true;
            }
            return false;
        }

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
            e.preventDefault();
            //Get value and make sure it is not null
            var val = $("#new-event").val();
            if (val.length == 0) {
                return;
            }

            //Create events
            var event = $("<div />");
            event.css({
                "background-color": currColor,
                "border-color": currColor,
                "color": "#fff"
            }).addClass("fc-event ui-draggable");
            //event.addClass("fc-event bg-red ui-draggable");
            event.html(val);
            $('#external-events').prepend(event);

            //Add draggable funtionality
            ini_events(event);

            //Remove event from text input
            $("#new-event").val("");
        });

    });

</script>