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
            }
            $("#datepicker").datetimepicker({
                beforeShowDay: function(date){
                    if (eventDates[date]) {
                        return [false, ''];
                    } else {
                        return [true, '', ''];
                    }
                },
                minDate: new Date(),
                controlType: 'select',
                timeFormat: "HH:mm",
                dateFormat: "yy-mm-dd",
                timeText: 'Idő',
                hourText: 'Óra',
                minuteText: 'Perc',
                secondText: 'Másodperc',
                currentText: 'Ma',
                closeText: 'Ok',
                hourMin: 10,
                hourMax: 17,
                showSecond: false,
                showMillisec: false,
                showMicrosec: false
            });
        }
    });

    //show cart
    $('#order button[type="submit"]')
        .mouseenter(function() {$('#cart').slideDown()})
        .mouseleave(function () {$('#cart').slideUp()});

    // on selecting a service gray out all others with the same type
    $('button').click(function () {
        if ($(this).data('type-id') == 4) {     //type 4 is allowing have more than one
            $(this).toggleClass('success');
            $(this).closest('.service').toggleClass('selected');
            $(this).closest('.row').hide().prepend($(this).closest('.column')).fadeIn(1000);
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
    var calculatePriceAndTime = function () {
        var summary = '';
        var totalAmount = 0;
        var totalMinutes = 0;
        $('*[data-service]').each(function () {
            // handling inputs
            if ($(this).val()) {
                var itemPrice = $(this).data('price-full') ? $(this).data('price-full') : $(this).data('price-discount');
                var itemValue = $(this).val() * itemPrice;
                totalAmount += itemValue;
                summary += '<dd>' + $(this).data('service') + ': ' + $(this).val() + ' fő * '
                    + number_format(itemPrice, 0) + ' Ft</dd>'
                    + '<dt>' + number_format(itemValue, 0) + ' Ft</dt>';
                // here the time does not doubled if we have full AND discount members together
                totalMinutes = totalMinutes ? totalMinutes : totalMinutes + $(this).data('minutes');
            }

            // handling buttons
            if ($(this).hasClass('success')) {
                var priceFull = $(this).data('price-full');
                var priceDiscount = $(this).data('price-discount');
                var membersFull = $('#services-1-joindata-full-price-members').val();
                if (membersFull) {
                    totalAmount += priceFull * membersFull;
                    summary += '<dd>' + $(this).data('service') + ': ' + membersFull + ' fő * '
                        + number_format(priceFull, 0) + ' Ft</dd>'
                        + '<dt>' + number_format(priceFull * membersFull, 0) + ' Ft</dt>';
                }
                var membersDiscount = $('#services-1-joindata-discount-price-members').val();
                if (membersDiscount) {
                    totalAmount += priceDiscount * membersDiscount;
                    summary += '<dd>' + $(this).data('service') + ': ' + membersDiscount + ' fő * '
                        + number_format(priceDiscount, 0) + ' Ft</dd>'
                        + '<dt>' + number_format(priceDiscount * membersDiscount, 0) + ' Ft</dt>';
                }
                totalMinutes += $(this).data('minutes');
            }
        });

        summary += '<dt class="b">Összesen: ' + number_format(totalAmount, 0) + ' Ft</dt>';
        summary += '<dd>A programhoz szükséges idő</dd><dt>' + number_format(totalMinutes/60, 1) + ' óra</dt>';

        $('#summary').html(summary);

        if (totalAmount) {
            $('#order button[type="submit"]').text('Megrendelem ' + number_format(totalAmount, 0) + ' Ft '
                + number_format(totalMinutes / 60, 1) + ' óra').hide().fadeIn();
        }
    };
    $('input[data-service]').on('blur', calculatePriceAndTime);
    $('button[data-service]').on('click', calculatePriceAndTime);

    $("#order").submit(function (event) {
        event.preventDefault();
    });
});

function number_format( number, decimals, dec_point, thousands_sep ) {
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
