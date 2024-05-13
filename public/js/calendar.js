$(function () {
    var today = new Date();

    var nextDayIndex = (today.getDay() + 1) % 7;

})

function getNextWeekdayDate(weekday) {
    const today = new Date();
    const currentDay = today.getDay();
    const daysUntilNextWeekday = (7 + weekday - currentDay) % 7;
    const nextWeekday = new Date(today);
    nextWeekday.setDate(today.getDate() + daysUntilNextWeekday);
    return nextWeekday.toLocaleDateString('en-GB', {day: 'numeric', month: 'numeric'});
}

function displayPopUpCalendar() {
    document.getElementById("popupCalendar").classList.add("openpopup")
    $('#defaultpopupthings1').load('calendarChangeForm');
}

function closePopUp() {
    document.getElementById("popupCalendar").classList.remove("openpopup")
}