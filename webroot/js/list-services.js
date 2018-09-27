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
            var servicesRow = "<tr data-id="+j+"><td><select name='services["+j+"][id]'>";
            for(var i=0; i<services.length; i++){
                var id = services[i]["id"];
                var service = services[i]["service"];
                servicesRow += "<option value='"+id+"'>"+service+"</option>";
            }
            servicesRow += "</select>";
            servicesRow += "<td><input type='number' placeholder='Teljes árú tagok' name='services["+j+"][_joinData][full_price_members]'></td>";
            servicesRow += "<td><input type='number' placeholder='Kedvezményes árú tagok' name='services["+j+"][_joinData][discount_price_members]'></td>";
            servicesRow += "<td><i class='add fi-plus'><i data-id='"+j+"' class='remove fi-x'></i></td>";
            $("#services").append(servicesRow);
            $(".add").click(function (event) {
                event.preventDefault();
                getServiceList();
            });
            $(".remove").each(function (index) {
                $(this).click(function () {
                    var id = $(this).data('id');
                    var removedTr = $("tbody").find("tr[data-id='"+id+"']");
                    console.log(removedTr);
                    removedTr.remove();
                });
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