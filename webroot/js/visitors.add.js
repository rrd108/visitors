$(function () {

    // header
    $('#services-1-joindata-full-price-members').on('blur', function () {
        $('#vFullPerson').text($('#services-1-joindata-full-price-members').val());
    });

    $('#services-1-joindata-discount-price-members').on('blur', function () {
        $('#vDiscountPerson').text($('#services-1-joindata-discount-price-members').val());
    });
    $('input[data-service]').on('blur', calculatePriceAndTime);

    // open
    //date picker
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
                timeFormat: 'HH',
                showTime: false,
                showMinute: false,
                showSecond: false,
                showMillisec: false,
                showMicrosec: false
            });
        }
    });
    $('#datepicker').on('blur', function () {
        $('#vDate').text($('#datepicker').val().replace(' ', '/'));
    });

    $('#open input').blur(function () {
        if ($('#datepicker').val() && ($('#services-1-joindata-full-price-members').val() || $('#services-1-joindata-discount-price-members').val())) {
            $('.fi-arrow-down').css("color", "#483a23");

            // TODO transition could be more smooth
            $('nav#open').hide();

            calculatePriceAndTime();
            $('nav#steps').show();

            $('#step-1').show();
        }
    });
    $('.fi-arrow-down').click(function () {
        if ($('#datepicker').val() && ($('#services-1-joindata-full-price-members').val() || $('#services-1-joindata-discount-price-members').val())) {
            $('html, body').animate({
                scrollTop: $("#step-1").offset().top
            }, 1000);
        }
    });


    //show cart
    // TODO do we need this on mobile? desktop? or having a changable header is better?
    /*var time;
    $('.cart')
        .mouseenter(function () {
            clearTimeout(time);
            $('#cart').slideDown()
        })
        .mouseleave(function () {
            clearTimeout(time);
            time = setTimeout('showCart()', 2250);
        });
    showCart = function () {
        $('#cart').slideUp();
    }*/

    /*
    $('button').click(function () {
        // step 1 on order
        if ($(this).attr('id') == 'main-service') {
            if (!$('#datepicker').val()) {
                $('#datepicker').effect('shake').notify('Kérem válasszon dátumot a látogatáshoz', 'error');
                return;
            }

            if (!($('#services-1-joindata-full-price-members').val() + $('#services-1-joindata-discount-price-members').val())) {
                $('#services-1-joindata-full-price-members').effect('shake').notify('Kérem adja meg hányan vannak a csoportban', 'error');
                return;
            }

            $('.extra').fadeIn(1250);
            $(this).hide();
            return;
        }

        // on selecting a service gray out all others with the same type
        if ($(this).data('type-id') == 4) {     //type 4 is allowing have more than one
            $(this).toggleClass('success');
            $(this).closest('.service').toggleClass('selected');
            //$(this).closest('.row').hide().prepend($(this).closest('.column')).fadeIn(1000);
            return;
        }

        var typeButtons = $('button[data-type-id="' + $(this).data('type-id') + '"]');
        var services = typeButtons.closest('.service');
        if (!$(this).hasClass('success')) {
            $(this).addClass('success');
            services.addClass('faded').removeClass('selected');
            $(this).closest('.service').removeClass('faded').addClass('selected');
            //$(this).closest('.row').hide().prepend($(this).closest('.column')).fadeIn(1000);
        } else {
            typeButtons.removeClass('success');
            services.removeClass('faded');
            $(this).closest('.service').removeClass('selected');
        }
    });
    */

    // price and time calculation helper
    var calculatePriceAndTime = function () {
        var totalAmount = 0;
        var totalMinutes = 0;
        $('*[data-service]').each(function () {
            // handling inputs
            if ($(this).val()) {
                var itemPrice = $(this).data('price-full') ? $(this).data('price-full') : $(this).data('price-discount');
                var itemValue = $(this).val() * itemPrice;
                totalAmount += itemValue;
                totalMinutes = totalMinutes ? totalMinutes : totalMinutes + $(this).data('minutes');
            }

            // handling buttons
            /*if ($(this).hasClass('success')) {
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
            }*/
        });
        $('#vAmount').text(number_format(totalAmount, 0));
        $('#vMinutes').text(totalMinutes);
    };

    //$('button[data-service]').on('click', calculatePriceAndTime);

    /*$("#order").submit(function (event) {
        event.preventDefault();
    });*/
});

// just a simple helper
function number_format( number, decimals, dec_point, thousands_sep ) {
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
