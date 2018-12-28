$(function () {
    // set days non-selectable when we are not open or full
    var eventDates = {};
    var host = $(location).attr('origin');
    var baseUrl = $($('script')[1]).attr('src').replace(/\/js\/.*/, '');
    var url = host + baseUrl + '/servicesDays/listNonServicesDays.json';
    $.ajax({
        method: 'get',
        url: url,
        success: function(result){
           var nonServicesDays = result.nonServicesDays;
           for(var key in nonServicesDays){
               if(nonServicesDays.hasOwnProperty(key)){
                   eventDates[ new Date(nonServicesDays[key])] = new Date(nonServicesDays[key]);
               }
               $("#datepicker").datetimepicker({
                   beforeShowDay: function(date){
                       var highlight = eventDates[date];
                       if (highlight) {
                           return [false, ''];
                       } else {
                           return [true, '', ''];
                       }
                   },
                   controlType: 'select',
                   timeFormat: "HH:mm:ss",
                   dateFormat: "yy-mm-dd",
                   timeText: 'Idő',
                   hourText: 'Óra',
                   minuteText: 'Perc',
                   secondText: 'Másodperc',
                   currentText: 'Ma',
                   closeText: 'Ok',
                   hourMin: 10,
                   hourMax: 18,
                   showSecond: false,
                   showMillisec: false,
                   showMicrosec: false
               }).val();
           }
        }
    });

    // on selecting a service gray out all others with the same type
    $('button').click(function () {
        if ($(this).data('type-id') == 4) {     //type 4 is allowing have more than one
            $(this).toggleClass('success');
            $(this).closest('.service').toggleClass('selected');
            return;
        }

        var typeButtons = $('button[data-type-id="' + $(this).data('type-id') + '"]');
        var services = typeButtons.closest('.service');
        if (!$(this).hasClass('success')) {
            $(this).addClass('success');
            services.addClass('faded').removeClass('selected');
            $(this).closest('.service').removeClass('faded').addClass('selected');
            $(this).closest('.row').hide().prepend($(this).closest('.column')).fadeIn(1000);
        } else {
            typeButtons.removeClass('success');
            services.removeClass('faded');
            $(this).closest('.service').removeClass('selected');
        }
    });

    // price and time calculation
    $('*[data-price]').blur(function () {
        var fullMembers = $('#services-1-joindata-full-price-members');
        var discountMembers = $('#services-1-joindata-discount-price-members');
        var summary = '';
        if (fullMembers.val()) {
            summary += '<dd>Teljes áru vendég: ' + fullMembers.val() + ' fő * '
                + number_format(fullMembers.data('price'), 0) + ' Ft</dd>'
                + '<dt>' + number_format(fullMembers.val() * fullMembers.data('price'), 0) + ' Ft</dt>';
        }
        if (discountMembers.val()) {
            summary += '<dd>Kedvezményes áru vendég: ' + discountMembers.val() + ' fő * '
                + number_format(discountMembers.data('price'), 0) + ' Ft</dd>'
                + '<dt>' + number_format(discountMembers.val() * discountMembers.data('price'), 0) + ' Ft</dt>';
        }
        $('#summary').html(summary);
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
});

function number_format( number, decimals, dec_point, thousands_sep ) {
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
