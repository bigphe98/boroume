function updateSpotAtMarketAjax(farmersMarketId, dateOfActivity, update, farmersMarketName, charityName, weekday, time, meetingPoint, address) {
    var data = {
        farmersMarketID: farmersMarketId,
        date: dateOfActivity,
        action: update,
        farmersMarketName: farmersMarketName,
        charityName: charityName,
        time: time,
        weekday: weekday,
        meetingPoint: meetingPoint,
        address: address
    };

    $.ajax({
        url: "../BoroumeController/calendar",
        type: "POST",
        data: data,
        dataType: 'json',
        success: function(response){
            $('.result').html(response);
        }
    });

    console.log(data);
}

function pickSpotAtMarket(farmersMarketId, dateOfActivity , spotsTaken, spotsTotal){
    console.log(spotsTotal)
    console.log(spotsTaken)
    if(spotsTaken < spotsTotal){

        var farmersMarketName = document.getElementById("farmersMarketName_" + farmersMarketId).innerHTML.trim();
        var locationMarket = document.getElementById("location_" + farmersMarketId).innerHTML.trim();
        var charityName = document.getElementById("charityName_" + farmersMarketId).innerHTML.trim();
        var weekday = document.getElementById("weekday_" + farmersMarketId).innerHTML.trim();
        var time = document.getElementById("time_" + farmersMarketId).innerHTML.trim();
        var link = document.getElementById("location_" + farmersMarketId).getAttribute("href").trim();
        console.log(farmersMarketName)
        console.log(locationMarket)
        console.log(charityName)
        console.log(weekday)
        console.log(time)
        console.log(link)

        updateSpotAtMarketAjax(farmersMarketId, convertDateFormat(dateOfActivity), 0, farmersMarketName, charityName, weekday, time, locationMarket, link);

        console.log(dateOfActivity)
        console.log(typeof dateOfActivity);

        console.log(convertDateFormat(dateOfActivity))
        setTimeout(function() {
            location.reload();
        }, 500);
    }
}

function cancelSpotAtMarket(farmersMarketId, dateOfActivity){
    var farmersMarketName = document.getElementById("farmersMarketName_" + farmersMarketId).innerHTML.trim();
    var locationMarket = document.getElementById("location_" + farmersMarketId).innerHTML.trim();
    var charityName = document.getElementById("charityName_" + farmersMarketId).innerHTML.trim();
    var weekday = document.getElementById("weekday_" + farmersMarketId).innerHTML.trim();
    var time = document.getElementById("time_" + farmersMarketId).innerHTML.trim();
    var link = document.getElementById("location_" + farmersMarketId).getAttribute("href").trim();
    console.log(farmersMarketName)
    console.log(locationMarket)
    console.log(charityName)
    console.log(weekday)
    console.log(time)
    console.log(link)

    updateSpotAtMarketAjax(farmersMarketId, convertDateFormat(dateOfActivity), 1, farmersMarketName, charityName, weekday, time, locationMarket, link);

    console.log(dateOfActivity)
    console.log(typeof dateOfActivity);

    console.log(convertDateFormat(dateOfActivity))
    setTimeout(function() {
       location.reload();
    }, 500);
}

function convertDateFormat(dateString) {
    // Split the date string into day, month, and year parts
    var parts = dateString.split('/');

    // Construct the date in the "YYYY-mm-dd" format
    var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];

    return formattedDate;
}