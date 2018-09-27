var j = 0;

var getServiceList = function () {
    var host = $(location).attr('origin');
    var baseUrl = $($('script')[1]).attr('src').replace(/\/js\/.*/, '');
    var url = host + baseUrl + '/services/listServices.json';
    $.ajax({
        url: url,
        method: 'post',
        success: function (result) {
            var services = result.result;
            var servicesRow = "<tr><td><select name='services["+j+"][id]'>";
            for(var i=0; i<services.length; i++){
                var id = services[i]["id"];
                var service = services[i]["service"];
                servicesRow += "<option value='"+id+"'>"+service+"</option>";
            }
            servicesRow += "</select>";
            servicesRow += "<td><input type='number' placeholder='Teljes árú tagok' name='services["+j+"][_joinData][full_price_members]'></td>";
            servicesRow += "<td><input type='number' placeholder='Kedvezményes árú tagok' name='services["+j+"][_joinData][discount_price_members]'></td>";
            servicesRow += "<td><button class='button add tiny'>Új szolgáltatás</button></td>";
            $("#services").append(servicesRow);
            $(".add").click(function (event) {
                event.preventDefault();
                getServiceList();
            });
            j++;
            },
        error: function (result) {
            console.log(result);
        }
    });
};

$(document).ready(function () {
    getServiceList();
});

$("#datepicker").datetimepicker({
    timeFormat: "HH:mm:ss",
    dateFormat: "yy-mm-dd",
    timeText: 'Idő',
    hourText: 'Óra',
    minuteText: 'Perc',
    secondText: 'Másodperc',
    currentText: 'Most',
    closeText: 'Ok'
}).val();