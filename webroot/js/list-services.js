$(function () {
    $("#datepicker").datetimepicker({
        controlType: 'select',
        timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd",
        timeText: 'Idő',
        hourText: 'Óra',
        minuteText: 'Perc',
        secondText: 'Másodperc',
        currentText: 'Most',
        closeText: 'Ok',
        hourMin: 10,
        hourMax: 18,
        showSecond: false,
        showMillisec: false,
        showMicrosec: false
    }).val();
});
if(typeof  selectedIds == 'undefined'){
    var selectedIds = {};
}
var selectedId = 0;
$(".select-service").each(function () {
    $(this).click(function () {
        var typeId = $(this).data('type-id');
        $(".select-service").each(function () {
            if ($(this).data('type-id') === typeId) {
                if($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
            }
        });
        if (selectedIds[typeId] !== $(this).data('id')) {
            var button = $(this);
            selectedId = $(this).data('id');
            selectedIds[typeId] = selectedId;
            $(".service-data").each(function () {
                var dataId = $(this).data('id');
                if (dataId !== selectedId && dataId !== 1 && $(this).data('type-id') === typeId) {
                    var inputs = $(this).find("input");
                    inputs.each(function () {
                        if (!$(this).hasClass('service-id')) {
                            $(this).remove();
                        }
                    });
                }
            });
            var fullPriceMembers = $("#services-1-joindata-full-price-members").val();
            var fullPriceSpan = $("span.full-price[data-id='" + selectedId + "']");
            fullPriceSpan.append("<input type='hidden' value='" + fullPriceMembers + "' name='services[" + selectedId + "][_joinData][full_price_members]' class='full-price-hidden'>");
            var discountPriceMembers = $("#services-1-joindata-discount-price-members").val();
            var discountPriceSpan = $("span.discount-price[data-id='" + selectedId + "']");
            discountPriceSpan.append("<input type='hidden' value='" + discountPriceMembers + "' name='services[" + selectedId + "][_joinData][discount_price_members]' class='discount-price-hidden'>");
            $(this).addClass('selected');
        } else {
            $(".service-data").each(function () {
                var dataId = $(this).data('id');
                selectedId = 0;
                delete selectedIds[typeId];
                if (dataId !== 1 && $(this).data('type-id') === typeId) {
                    var inputs = $(this).find("input");
                    inputs.each(function () {
                        if (!$(this).hasClass('service-id')) {
                            $(this).remove();
                        }
                    });
                }
            });
        }
    });
});
$("#services-1-joindata-full-price-members").on("input", function () {
    $(".full-price-hidden").val($(this).val());
});
$("#services-1-joindata-discount-price-members").on("input", function () {
    $(".discount-price-hidden").val($(this).val());
});
$("#send").click(function (event) {
    event.preventDefault();
    $(".service-data").each(function () {
        for (var key in selectedIds) {
            var dataId = $(this).data('id');
            var typeId = $(this).data('type-id');
            if (selectedIds.hasOwnProperty(typeId)) {
                if (dataId !== selectedIds[key] && typeId == key && dataId !== 1) {
                    var inputs = $(this).find("input");
                    inputs.each(function () {
                        $(this).remove();
                    });
                }
            } else {
                if (dataId !== 1 && typeId != key) {
                    inputs = $(this).find("input");
                    inputs.each(function () {
                        $(this).remove();
                    });
                }
            }
        }
        if(Object.getOwnPropertyNames(selectedIds).length === 0){
            dataId = $(this).data('id');
            if (dataId !== 1) {
                inputs = $(this).find("input");
                inputs.each(function () {
                    $(this).remove();
                });
            }
        }
    });
    var form = $("form");
    form.submit();
});