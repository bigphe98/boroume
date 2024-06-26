function changeInfo(type, id) {
    let pNameFood = document.getElementById('pFoodName_' + id);
    let inputNameFood = document.getElementById('inputFoodName_' + id);
    let pkgBox = document.getElementById('pkgBox_' + id);
    let inputkgBox = document.getElementById('inputkgBox_' + id);
    let pkgBag = document.getElementById('pkgBag_' + id);
    let inputkgBag = document.getElementById('inputkgBag_' + id);
    let changeButton = document.getElementById('changeButton_' + id);
    let cancelButton = document.getElementById('cancelButton_' + id);
    let confirmButton = document.getElementById('confirmButton_' + id);

    if (type === 'change') {
        pNameFood.style.display = 'none';
        inputNameFood.style.display = 'block';
        pkgBox.style.display = 'none';
        inputkgBox.style.display = 'block';
        pkgBag.style.display = 'none';
        inputkgBag.style.display = 'block';
        changeButton.style.display = 'none';
        cancelButton.style.display = 'block';
        confirmButton.style.display = 'block';
    } else if (type === 'cancel') {
        pNameFood.style.display = 'block';
        inputNameFood.style.display = 'none';
        pkgBox.style.display = 'block';
        inputkgBox.style.display = 'none';
        pkgBag.style.display = 'block';
        inputkgBag.style.display = 'none';
        changeButton.style.display = 'block';
        cancelButton.style.display = 'none';
        confirmButton.style.display = 'none';
    } else if (type === 'confirm') {
        var data = {
            nameFood: inputNameFood.value,
            kgBox: inputkgBox.value,
            kgBag: inputkgBag.value,
            idMeasurement: id
        };

        $.ajax({
            url: "../BoroumeController/changeMeasuringInfo",
            type: "POST",
            data: data,
            dataType: 'json',
            success: function(response){
                $('.result').html(response);
            }
        });

        console.log(data);

        setTimeout(function() {
            location.reload();
        }, 2000);
    }
}

var baseUrl = '<?= $base_url ?>';

function addInfo(actionDate, farmersMarket) {
    window.location.href = 'confirmActivityData?actionDate=' + encodeURIComponent(actionDate) + '&farmersMarket=' + encodeURIComponent(farmersMarket);
}
