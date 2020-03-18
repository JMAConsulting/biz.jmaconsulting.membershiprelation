(function($) {
  $('#custom_11').change(function() {
    $('#billing_first_name').val($(this).val());
  });
  $('#custom_12').change(function() {
    $('#billing_last_name').val($(this).val());
  });
  $('#_qf_Main_upload-bottom').submit(function() {
    if ($('#custom_12').length && $('#custom_12').val() != $('#billing_last_name').val()) {
      $('#billing_last_name').val($('#custom_12').val());
    }
    if ($('#custom_11').length && $('#custom_11').val() != $('#billing_first_name').val()) {
      $('#billing_first_name').val($('#custom_11').val());
    }
 });
})(CRM.$);
