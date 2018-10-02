$(function() {
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
        second: false,
        showMillisec: false,
        showMicrosec: false
    }).val();
    var selectedId = 0;
    $(".select-service").each(function () {
       $(this).click(function () {
           $(".select-service").each(function () {
               $(this).css("background-color","#483a23");
           });
           if(selectedId !== $(this).data('id')) {
               var button = $(this);
               selectedId = $(this).data('id');
               $(".service-data").each(function () {
                   var dataId = $(this).data('id');
                   if(dataId !== selectedId && dataId !== 1){
                       var inputs = $(this).find("input");
                       inputs.each(function () {
                           if(!$(this).hasClass('service-id')){
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
               $(this).css("background-color","red");
           }
       });
    });
    $("#services-1-joindata-full-price-members").on("input",function () {
        $(".full-price-hidden").val($(this).val());
    });
    $("#services-1-joindata-discount-price-members").on("input",function () {
        $(".discount-price-hidden").val($(this).val());
    });
    $("#send").click(function (event) {
            event.preventDefault();
            $(".service-data").each(function () {
               var dataId = $(this).data('id');
               if(dataId !== selectedId && dataId !== 1){
                   var inputs = $(this).find("input");
                   inputs.each(function () {
                      $(this).remove();
                   });
               }
            });
            var form = $("form");
            form.submit();
    });
});