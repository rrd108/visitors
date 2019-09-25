$(function () {

    var page = 0;

    // header
    $('#services-1-joindata-full-price-members').on('blur', function () {
        $('#services-1-joindata-full-price-members').val(Math.abs($('#services-1-joindata-full-price-members').val()));
        $('#vFullPerson').text($('#services-1-joindata-full-price-members').val());
        $('#vTotalFullPerson').text($('#services-1-joindata-full-price-members').val() + ' felnőtt');
    });

    $('#services-1-joindata-discount-price-members').on('blur', function () {
        $('#services-1-joindata-discount-price-members').val(Math.abs($('#services-1-joindata-discount-price-members').val()));
        $('#vDiscountPerson').text($('#services-1-joindata-discount-price-members').val());
        $('#vTotalDiscountPerson').text($('#services-1-joindata-discount-price-members').val() + ' gyerek / nyugdíjas');
    });
    $('input[data-service]').on('blur', calculatePriceAndTime);

    // insert pager
    $('footer').html('<i class="fi-arrow-down" id="pager"><button></button></i>');

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
                minDate: new Date(new Date().setHours(11) + 24*60*60*1000),    // tomorrow at 11
                controlType: 'select',
                timeFormat: "HH:mm",
                dateFormat: "yy-mm-dd",
                timeText: 'Idő',
                hourText: 'Óra',
                minuteText: 'Perc',
                secondText: 'Másodperc',
                currentText: 'Ma',
                closeText: 'Ok',
                hour: 11,
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
        $('#vTotalDate').text($('#datepicker').val().replace(' ', '/'));
    });

    $('#open input').blur(function () {
        if ($('#datepicker').val() && ($('#services-1-joindata-full-price-members').val() || $('#services-1-joindata-discount-price-members').val())) {
            $('#pager').addClass('active');

            $('nav#openlogo').hide(300);
            calculatePriceAndTime();
            $('nav#summary').delay(300).show();

            $('#step-1').show();
            $('#breadcumbs li:nth-child(1)').addClass('active');
        }
    });

    $('body').on('click', '#pager.active', function () {
        page++;
        $('html, body').animate({
            scrollTop: $('#step-' + page).offset().top - $('header').height()
        }, 1000);
        $('#pager').hide();
    });


    $('button').click(function () {

        $('#step-' + $(this).data('type-id')).show();
        calculatePriceAndTime();
        updateTotalPage($(this));

        // on selecting a service gray out all others with the same type
        if ($(this).data('type-id') == 3) {     //type 3 is allowing have more than one
            $(this).toggleClass('success');
            $(this).closest('.service').toggleClass('selected');
            $('#pager').show();
            return;
        }

        var typeButtons = $('button[data-type-id="' + $(this).data('type-id') + '"]');
        var services = typeButtons.closest('.service');
        if (!$(this).hasClass('success')) {
            $(this).addClass('success');
            services.addClass('faded').removeClass('selected');
            $(this).closest('.service').removeClass('faded').addClass('selected');
            $('#pager').show();
        } else {
            typeButtons.removeClass('success');
            services.removeClass('faded');
            $(this).closest('.service').removeClass('selected');
            $('#pager').hide();
        }
    });

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
            if ($(this).hasClass('success')) {
                var priceFull = $(this).data('price-full');
                var priceDiscount = $(this).data('price-discount');
                var membersFull = $('#services-1-joindata-full-price-members').val();
                totalAmount += priceFull * membersFull;
                var membersDiscount = $('#services-1-joindata-discount-price-members').val();
                totalAmount += priceDiscount * membersDiscount;
                totalMinutes += $(this).data('minutes');
            }
        });
        $('#vAmount').text(number_format(totalAmount, 0));
        $('#vMinutes').text(totalMinutes);

        //update step-4
        $('#vTotalAmount').text(number_format(totalAmount, 0));
        $('#vTotalMinutes').text(totalMinutes);
    };

    var updateTotalPage = function (button) {
        $('#vTotalService' + (button.data('type-id') - 1)).text(button.data('service'));
    }

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
