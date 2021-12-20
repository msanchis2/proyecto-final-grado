// Setup the calendar with the current date
$(document).ready(function () {
    var date = new Date();
    // Set click handlers for DOM elements
    $(".aula.button").click({ date: date }, aula_select);
    $(".month").click({ date: date }, month_click);
    $(".event-card>.button").click({ date: date }, new_event);
    // Set current month as active
    $(".months-row").children().eq(date.getMonth()).addClass("active-month");
    init_calendar(date);
});

function get_profesor(){
    return "Carlos Furones";
}

function get_aula() {
    var aula = $(".aula.selected").attr("name");
    return aula;
};

function aula_select(event) {
    $(".selected").removeClass("selected");
    $(this).addClass("selected");
    
    var date = event.data.date;

    show_events2(check_events(date.getDate(), date.getMonth()));
}

// Initialize the calendar by appending the HTML dates
function init_calendar(date) {
    $(".tbody").empty();
    $(".hour").empty();
    var calendar_days = $(".tbody");
    var month = date.getMonth();
    var year = date.getFullYear();
    var day_count = days_in_month(month, year);
    var row = $("<tr class='table-row'></tr>");
    var today = date.getDate();
    // Set date to 1 to find the first day of the month
    date.setDate(1);
    var first_day = date.getDay();
    // 35+firstDay is the number of date elements to be added to the dates table
    // 35 is from (7 days in a week) * (up to 5 rows of dates in a month)
    for (var i = 0; i < 35 + first_day; i++) {
        // Since some of the elements will be blank, 
        // need to calculate actual date from index
        var day = i - first_day + 1;
        // If it is a sunday, make a new row
        if (i % 7 === 0) {
            calendar_days.append(row);
            row = $("<tr class='table-row'></tr>");
        }
        // if current index isn't a day in this month, make it blank
        if (i < first_day || day > day_count ) {
            var curr_date = $("<td class='table-date nil'>" + "</td>");
            row.append(curr_date);
        }
        else {
            var curr_date = $("<td class='table-date'>" + day + "</td>");
            var events = check_events(day, month);
            if (today === day && $(".active-date").length === 0) {
                curr_date.addClass("active-date");
                date.setDate(today);
                show_events2(events);
            }
            // Set onClick handler for clicking a date
            curr_date.click({ date: date }, date_click);
            row.append(curr_date);
        }
    }
    // Append the last row and set the current year
    calendar_days.append(row);
    $(".year").text(year);
}

// Get the number of days in a given month/year
function days_in_month(month, year) {
    var monthStart = new Date(year, month, 1);
    var monthEnd = new Date(year, month + 1, 1);
    return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);
}

// Event handler for when a date is clicked
function date_click(event) {
    $(".active-date").removeClass("active-date");
    $(this).addClass("active-date");
    var date = event.data.date;
    var day = parseInt($(".active-date").html())
    date.setDate(day);
    console.log(day)
    console.log(date.getDate())

    show_events2(check_events(date.getDate(), date.getMonth()));
};

// Event handler for when a month is clicked
function month_click(event) {
    var date = event.data.date;
    $(".active-month").removeClass("active-month");
    $(this).addClass("active-month");
    var new_month = $(".month").index(this);
    date.setMonth(new_month);
    init_calendar(date);

    show_events2(check_events(date.getDate(), new_month));
}




// Event handler for clicking the new event button
function new_event(event) {
    // if a date isn't selected then do nothing
    if ($(".active-date").length === 0)
        return;

    var aula = get_aula();
    var date = event.data.date;
    var hour = $(this).siblings().text();
    var day = date.getDate();
    // Basic form validation
    new_event_json(aula, date.getMonth(), day, hour);
    date.setDate(day);
    init_calendar(date);
    //console.log( +" "+date.getMonth())
    
    show_events2(check_events(date.getDate(), date.getMonth()));

}

// Adds a json event to event_data
function new_event_json(aula, month, day, hour) {
    var id = aula+" "+month+" "+day+" "+hour;
    var event = {
        "id": id,
        "profesor":"Carlos Furones",
        "aula": aula,
        "month": month,
        "day": day,
        "hour": hour
    };
    console.log(event)
    //Send new json with ajax so can be stored in the server
    ajax(event);
    event_data["events"].push(event);
}


function show_events2(events) {
    //clear the dates container
    $(".event-profesor").remove();
    $(".cancel-button").remove();
    $(".button").show();
    //Go through and add each event as a card to the events container
    var event_card = $(".event-card");
    for (var i = 0; i < events.length; i++) {
        //Two options are given in case the taken is ours or from anyone else
        var apendice1 = " by <a href='#' >"+events[i]['profesor']+"</a>";
        var apendice2 = "";
        var teacher = events[i]['profesor'];
        var curr_teacher = get_profesor();

        //Check who's the taken from

        if(teacher==curr_teacher){
            apendice2 = "<button class='cancel-button'>Cancel</button>";
            apendice1 = "";
        }


        var event_profesor = $("<div class='event-profesor'>Taken"+apendice1+"</div>"+apendice2);
        var index = events[i]['hour'];
        var hour = timetable.indexOf(index);
        event_card.eq(hour).children(".button").hide();
        event_card.eq(hour).append(event_profesor).addClass("Taken");
        $(".cancel-button").click({events: events}, cancel_click);

    }


}

function cancel_click(event){
    var events = event.data.events;
    var curr_aula = get_aula();
    var curr_hour = $(this).siblings(".event-hour").text();
    

    for(var i=0; i<events.length; i++){
        var hour = events[i]['hour'];
        var aula = events[i]['aula'];
        if(curr_hour==hour && curr_aula==aula){
            ajax(events[i]['id']);
        }
    }

    show_events2(events);

};

// Checks if a specific date has any events
function check_events(day, month) {
    var aula = get_aula();
    var events = [];
    for (var i = 0; i < event_data["events"].length; i++) {
        var event = event_data["events"][i];
        if (event["day"] === day &&
            event["month"] === month&& event["aula"]==aula) {
            events.push(event);
        }
    }
    return events;
}

function ajax(reserva, action) {
    connection = new XMLHttpRequest();
    var url='http://localhost/PROYECTO%20FINAL/Estamos-trabajando-mucho/web/index.php?ctl=AJAX';
    connection.onreadystatechange = response;
    connection.open('POST', url);
    connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    switch(action){
    case 'add':
        connection.send("fecha=" + reserva['day']+'/'+reserva['month'] + "&hora=" + reserva['hour'] + "&aula=" + reserva['aula'] + "&id=" + reserva['id']);
        break;
    case 'rm':
        connection.send("idremove=" + reserva);
    }
}

function recarga(dia, mes) {
    connection = new XMLHttpRequest();
    var url='http://localhost/PROYECTO%20FINAL/Estamos-trabajando-mucho/web/index.php?ctl=AJAX';
    connection.onreadystatechange = response;
    connection.open('POST', url);
    connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    connection.send('fechareservas='+dia+'/'+mes);
}
  
  function response() {
    if(connection.readyState == 4 && connection.status == 200) {
       var respuesta=connection.responseText;
       console.log('enviado');
    }
  }

// Given data for events in JSON format
var event_data = {
    "events": [
    ]
};

const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
];

const timetable = [
    "7:55",
    "8:50",
    "9:45",
    "11:00",
    "11:55",
    "12:50",
    "14:05",
    "15:00",
    "15:55",
    "16:50",
    "18:05",
    "19:00",
    "19:55",
    "21:15"
];