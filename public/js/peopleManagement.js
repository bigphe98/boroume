$(function () {
    let search = document.querySelector('.mainPageSearch');
    let searchicon = document.getElementById('searchVolunteers');
    let peopleList = document.querySelector("#scrollable1");

    searchicon.onclick = function () {
        search.classList.toggle('active');
        if(search.classList.value.includes('active'))
        {inputMain.removeAttribute('disabled');}
    }

    const inputMain = document.getElementById('mysearch');
    const peopleCards = document.getElementsByClassName('peopleCard');

    inputMain.addEventListener('input', function () {
        // Get the value of the input field and convert it to lowercase
        const inputValue = this.value.toLowerCase();

        // Loop through the student cards
        for (const peopleCard of peopleCards) {
            // Get the name element of the student card
            const name = peopleCard.getElementsByClassName('peopleName')[0];

            // Check if the name element is defined
            if (name) {
                // Convert the name to lowercase
                const nameLower = name.innerText.toLowerCase();

                // Check if the name starts with the input value
                if (nameLower.includes(inputValue)) {
                    // If it does, show the student card
                    peopleCard.style.display = 'block';
                } else {
                    // If it doesn't, hide the student card
                    peopleCard.style.display = 'none';
                }
            }
        }
    });

    let clearButtonMain = document.getElementById('closeSearchVolunteers');

    clearButtonMain.addEventListener('click', function () {
        // Clear the search input
        inputMain.value = '';

        // Show all the lessons
        for (let person of peopleList.children) {
            person.style.display = 'block';
        }
    });

})


function approvePerson(peopleId, peopleFirstName,peopleEmailAddress){
    console.log(peopleId);
    console.log(peopleEmailAddress);
    console.log(peopleFirstName);
    ajaxRequest(peopleId, peopleFirstName,peopleEmailAddress);


}

function ajaxRequest(peopleId, peopleFirstName,peopleEmailAddress) {
    var data = {
        peopleId: peopleId,
        peopleFirstName: peopleFirstName,
        peopleEmailAddress: peopleEmailAddress
    };

    $.ajax({
        url: "../BoroumeController/pmo",
        type: "POST",
        data: data,
        dataType: 'json',
        success: function(response){
            $('.result').html(response);
        }
    });
}