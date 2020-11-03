
function datePickerWerkzeug() {

    $('input[name="datefilter-werkzeug"]').daterangepicker({
        autoApply: true,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
  
    $('input[name="datefilter-werkzeug"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
  
    $('input[name="datefilter-werkzeug"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    })
  }
  