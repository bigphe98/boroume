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

function displayPopUpUpdate(id){

    var nameGreek = document.querySelector('#farmersMarketName_' + id).getAttribute('data-name-greek');
    var nameEnglish = document.querySelector('#farmersMarketName_' + id).getAttribute('data-name-english');
    var charityNameGreek = document.querySelector('#charityName_' + id).getAttribute('data-name-greek');
    var charityNameEnglish = document.querySelector('#charityName_' + id).getAttribute('data-name-english');
    var dayMarket = document.querySelector('#weekday_' + id).getAttribute('data-actionDay');
    var timeStart = document.querySelector('#time_' + id).getAttribute('data-time-start');
    var timeEnd = document.querySelector('#time_' + id).getAttribute('data-time-end');
    var meetingPoint = document.querySelector('#location_' + id).getAttribute('data-location');
    var meetingPointEnglish = document.querySelector('#location_' + id).getAttribute('data-name-greek');
    var meetingPointGreek = document.querySelector('#location_' + id).getAttribute('data-name-english');
    var meetingPointUrl = document.querySelector('#location_' + id).href.trim();
    var spotsMarket = document.querySelector('#spots_' + id).getAttribute('data-spots-total');


   /*console.log(nameGreek)
    console.log(nameEnglish)
    console.log(charityNameGreek)
    console.log(charityNameEnglish)
    console.log(dayMarket)
    console.log(timeStart)
    console.log(timeEnd)
    console.log(meetingPointEnglish)
    console.log(meetingPointGreek)
    console.log(meetingPointUrl)
    console.log(spotsMarket)*/

    document.getElementById('idFarm').innerText = id;
    document.getElementById('nameGreekPopUp').value = nameGreek;
    document.getElementById('nameEnglishPopUp').value = nameEnglish;
    document.getElementById('charityNameGreekPopUp').value = charityNameGreek;
    document.getElementById('charityNameEnglishPopUp').value = charityNameEnglish;
    document.getElementById('dayMarketPopUp').value = dayMarket;
    document.getElementById('timeStartPopUp').value = timeStart;
    document.getElementById('timeEndPopUp').value = timeEnd;
    document.getElementById('locationPopUp').value = meetingPoint;
    document.getElementById('meetingPointEnglishPopUp').value = meetingPointEnglish;
    document.getElementById('meetingPointGreekPopUp').value = meetingPointGreek;
    document.getElementById('meetingPointUrlPopUp').value = meetingPointUrl;
    document.getElementById('spotsMarketPopUp').value = spotsMarket;




    document.getElementById("popupCalendarUpdate").classList.add("openpopup");
}

function displayPopUpCalendar(number) {

    if(number === 1)
    {
        document.getElementById("popupCalendar").classList.add("openpopup")
        $('#defaultpopupthings1').load('calendarChangeForm');
    }else if(number === 2){
        document.getElementById("popupSpotsSelected").classList.add("openpopup")
    }else if(number ===3){
        document.getElementById("popupVolunteers").classList.add("openpopupSmall")
        idsOfDaySpotToReserve.forEach(function(peopleId) {
            // Inside this function, you can perform actions for each peopleId
            console.log("ID of spot to reserve:", peopleId);
            // You can perform any other actions you need here
            document.getElementById('popupVolunteerRow_' + peopleId).style.display = "none";
        });

    }

}

var spotsOver = 0;
var actionDate = 0;
var marketID = 0;

function closePopUp(number) {
    if(number === 1)
    {document.getElementById("popupCalendar").classList.remove("openpopup")}
    else if(number === 2)
    {
        document.getElementById("popupSpotsSelected").classList.remove("openpopup")
        spotsOver = 0;
    }else if(number === 3){
        document.getElementById("popupCalendarUpdate").classList.remove("openpopup")
    }else if(number === 4){
        document.getElementById("popupVolunteers").classList.remove("openpopupSmall")
    }

}

function convertToDateStandardFormat(date) {
    // Convert 'yy/mm/dd' to 'yyyy-mm-dd'
    const parts = date.split('/');
    const year = `20${parts[0]}`; // Assuming dates are in the 2000s
    const month = parts[1].padStart(2, '0');
    const day = parts[2].padStart(2, '0');
    return `${year}-${month}-${day}`;
}

var idsOfDaySpotToReserve = [];

function openVolunteerListForMarket(marketId, spotsTaken, spotsTotal, date) {
    spotsOver = spotsTotal-spotsTaken;
    console.log('Spots Over: ' + spotsOver);
    console.log(marketId);
    marketID = marketId;
    console.log(date)
    actionDate = date;

   // Convert actionDate to 'yyyy-mm-dd' format
    const formattedActionDate = convertToDateStandardFormat(actionDate);

    const dateElements = document.querySelectorAll('td[id^="date_"]');
    dateElements.forEach(element => {
        const elementDate = element.innerText.trim(); // Ensure no leading/trailing spaces
        console.log(elementDate); // Log the date from the element
        if (formattedActionDate === elementDate) {
            console.log("Spots with action date found!");
            const parentRow = element.closest('tr');
            const peopleIdElement = parentRow.querySelector('[id^="peopleId_"]');
            if (peopleIdElement) {
                const peopleId = peopleIdElement.innerText.trim();
                console.log("peopleId:", peopleId);

                idsOfDaySpotToReserve.push(peopleId);
            }
        }
    });



    var tableRows = document.querySelectorAll('#reservedSpots tbody tr');
    var popupTableBody = document.querySelector('#reservedSpotsPopUp tbody');

    // Clear previous rows in the popup table
    popupTableBody.innerHTML = '';

    tableRows.forEach(function(row) {
        var rowMarketId = row.querySelector('td:nth-child(2)').textContent.trim();
        if (rowMarketId == marketId) {
            var peopleID = row.querySelector('td:nth-child(1)').textContent.trim();
            var name = row.querySelector('td:nth-child(3)').textContent.trim(); // Select columns starting from the third one
            var email = row.querySelector('td:nth-child(4)').textContent.trim();
            var telephone = row.querySelector('td:nth-child(5)').textContent.trim();

            // Create a new row in the popup table
            var popupTableBody = document.querySelector('#reservedSpotsPopUp tbody');
            console.log(popupTableBody)
            var newRow = document.createElement('tr');
            console.log(newRow)
            newRow.innerHTML = `
                    <td style="display: none">${peopleID}</td>
                    <td style="display: none">${rowMarketId}</td>
                    <td>${name}</td>
                    <td>${email}</td>
                    <td>${telephone}</td>
                    <td><button class="textbuttonsmall" onclick="updateSpotAtMarket('remove', ${peopleID}, ${rowMarketId})">Remove</button></td>
            `;
            console.log(newRow)

            popupTableBody.appendChild(newRow);
            console.log(popupTableBody)


            console.log(name);
            console.log(email);
            console.log(telephone);
        }
    });

    // Display the popup
    displayPopUpCalendar(2);
}

function updateMarketAjax(action, farmersMarketId, farmersMarketNameGreek, farmersMarketNameEnglish, charityNameEnglish, charityNameGreek,
                          weekday, timeStart, timeEnd, meetingPoint, meetingPointEnglish, meetingPointGreek, meetingPointUrl, spotsMarket) {
    var data = {
        action: action,
        farmersMarketId: farmersMarketId,
        farmersMarketNameGreek: farmersMarketNameGreek,
        farmersMarketNameEnglish: farmersMarketNameEnglish,
        charityNameGreek: charityNameGreek,
        charityNameEnglish: charityNameEnglish,
        weekday: weekday,
        timeStart: timeStart,
        timeEnd: timeEnd,
        meetingPoint: meetingPoint,
        meetingPointEnglish: meetingPointEnglish,
        meetingPointGreek: meetingPointGreek,
        meetingPointUrl: meetingPointUrl,
        spotsMarket: spotsMarket
    };

    $.ajax({
        url: "../BoroumeController/calendarOrg",
        type: "POST",
        data: data,
        dataType: 'json',
        success: function(response){
            $('.result').html(response);
        },
        error: function(xhr, status, error){
            console.error("AJAX Error:", status, error);
            console.log("XHR:", xhr);
        }
    });

    console.log(data);
}

function updateLockStatusMarket(action, farmersMarketId){
    if(action == 'lock' || action == 'unlock'){
        updateMarketAjax(action, farmersMarketId, null, null, null, null, null, null, null, null, null, null, null, null);
    }
    else if(action == 'update'){
        console.log(farmersMarketId)
        var farmersMarketID = document.getElementById('idFarm').innerText;
        console.log(farmersMarketID)
        var farmersMarketNameGreek = document.getElementById('nameGreekPopUp').value;
        var farmersMarketNameEnglish = document.getElementById('nameEnglishPopUp').value;
        var charityNameGreek = document.getElementById('charityNameGreekPopUp').value;
        var charityNameEnglish = document.getElementById('charityNameEnglishPopUp').value;
        var weekday = document.getElementById('dayMarketPopUp').value;
        var timeStart = document.getElementById('timeStartPopUp').value;
        var timeEnd = document.getElementById('timeEndPopUp').value;
        var meetingPoint = document.getElementById('locationPopUp').value;
        var meetingPointEnglish = document.getElementById('meetingPointEnglishPopUp').value;
        var meetingPointGreek = document.getElementById('meetingPointGreekPopUp').value;
        var meetingPointUrl = document.getElementById('meetingPointUrlPopUp').value;
        var spotsMarket = document.getElementById('spotsMarketPopUp').value;

        console.log(farmersMarketNameEnglish);
        console.log(farmersMarketNameGreek);
        console.log(charityNameEnglish);
        console.log(charityNameGreek);
        console.log(weekday);
        console.log(timeStart);
        console.log(timeEnd);
        console.log(meetingPoint);
        console.log(meetingPointGreek);
        console.log(meetingPointEnglish);
        console.log(meetingPointUrl);
        console.log(spotsMarket);

        setTimeout(function() {
            updateMarketAjax(action, farmersMarketID, farmersMarketNameGreek, farmersMarketNameEnglish, charityNameGreek,charityNameEnglish,
                weekday, timeStart, timeEnd, meetingPoint, meetingPointEnglish, meetingPointGreek, meetingPointUrl, spotsMarket)
        }, 1500);


    }


   setTimeout(function() {
        location.reload();
    }, 2000);
}

function updateSpotAtMarket(action, peopleId, marketId){
    console.log(peopleId);
    console.log(marketId);

    spotsAtMarketAjax(action, marketId, peopleId, null);

    setTimeout(function() {
        location.reload();
    }, 500);
}

function spotsAtMarketAjax(action, farmersMarketId, peopleId, date) {
    var data = {
        action: action,
        farmersMarketId: farmersMarketId,
        peopleId: peopleId,
        actionDay: date
    };

    $.ajax({
        url: "../BoroumeController/calendarOrg",
        type: "POST",
        data: data,
        dataType: 'json',
        success: function(response){
            $('.result').html(response);
        },
        error: function(xhr, status, error){
            console.error("AJAX Error:", status, error);
            console.log("XHR:", xhr);
        }
    });

    console.log(data);
}

function openPeoplePopUp(){

}

var volunteersList = [];
var filteredVolunteersList = [];
var count = 1;

function addToAddingList(volID) {
    if (!volunteersList.includes(volID) && count <= spotsOver) {
        count++;
        volunteersList.push(volID);
        console.log(volunteersList);
        updateButtonState(volID);
    }
}

function removeFromAddingList(volID) {
    const index = volunteersList.indexOf(volID);
    if (index > -1) {
        volunteersList.splice(index, 1);
        count--;
        console.log(volunteersList);
        updateButtonState(volID);
    }
}

function toggleVolunteer(volID) {
    if (volunteersList.includes(volID)) {
        removeFromAddingList(volID);
    } else {
        addToAddingList(volID);
    }
}

function updateButtonState(volID) {
    const button = document.getElementById(`button-${volID}`);
    if (volunteersList.includes(volID)) {
        button.classList.remove('btn-success');
        button.classList.add('btn-danger');
        button.innerHTML = 'REMOVE';
        button.onclick = () => toggleVolunteer(volID);
    } else {
        button.classList.remove('btn-danger');
        button.classList.add('btn-success');
        button.innerHTML = 'ADD';
        button.onclick = () => toggleVolunteer(volID);
    }
}

function confirmAddList() {
    volunteersList.forEach(function(volunteer) {
        console.log(volunteer);
        // Add your logic here to confirm the addition
        spotsAtMarketAjax('add', marketID, volunteer, actionDate)
    });
    setTimeout(function() {
        location.reload();
    }, 500);
}
