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