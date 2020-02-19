{literal}
<script type="text/javascript">
    CRM.$(function($) {
        $('#membership').parent().prepend($('#editrow-custom_1'));
        $('#editrow-custom_1').append($('#helprow-custom_1'));
        $('div.chapter_memberships-section').addClass('hiddenElement');

        function calculatePriceTotalOnChapterSelect() {
          var total = 0;
          var priceAmount = parseInt($('#priceset [price]:checked').data('amount'));
          $('input[id*="custom_1_"]:checked').each(function(e) {
            var chapter = $(this).attr('name').replace('custom_1[', '').replace(']', '').replace(' ', ', ');
            $('.chapter_memberships-content .crm-price-amount-label').each(function(e) {
              if ($(this).text().match(chapter) !== null) {
                if (parseInt($(this).parent().parent().children('input').data('amount')) == priceAmount) {
                  $(this).parent().parent().children('input').prop('checked', true);
                  total += 1;
                }
                else {
                  $(this).parent().parent().children('input').prop('checked', false);
                }
              }
            });
          });
          if (total > 0) {
            total = total * priceAmount;
            display(total);
          }
        }
        // calculate price total on page load
        calculatePriceTotalOnChapterSelect();

        // calculate price total on chapter selection
        $('input[id*="custom_1_"]').on('click', function(e) {
          calculatePriceTotalOnChapterSelect();
        });

        // calculate price total on price amount selection
        $("#priceset [price]").on('click', function (e) {
          calculatePriceTotalOnChapterSelect();
        });

        var childprice = '{/literal}{$smarty.const.CHILDPRICEM}{literal}';

        var onegirl = '{/literal}{$smarty.const.ONEGIRL}{literal}';
        var twogirls = '{/literal}{$smarty.const.TWOGIRLS}{literal}';
        var threegirls = '{/literal}{$smarty.const.THREEGIRLS}{literal}';
        var fourgirls = '{/literal}{$smarty.const.FOURGIRLS}{literal}';

        var child2fn = '{/literal}{$smarty.const.CHILD2FNM}{literal}';
        var child2ln = '{/literal}{$smarty.const.CHILD2LNM}{literal}';
        var child2dob = '{/literal}{$smarty.const.CHILD2DOBM}{literal}';
        var child2em = '{/literal}{$smarty.const.CHILD2EMM}{literal}';
        var child2g = '{/literal}{$smarty.const.CHILD2G}{literal}';

        var child3fn = '{/literal}{$smarty.const.CHILD3FNM}{literal}';
        var child3ln = '{/literal}{$smarty.const.CHILD3LNM}{literal}';
        var child3dob = '{/literal}{$smarty.const.CHILD3DOBM}{literal}';
        var child3em = '{/literal}{$smarty.const.CHILD3EMM}{literal}';
        var child3g = '{/literal}{$smarty.const.CHILD3G}{literal}';

        var child4fn = '{/literal}{$smarty.const.CHILD4FNM}{literal}';
        var child4ln = '{/literal}{$smarty.const.CHILD4LNM}{literal}';
        var child4dob = '{/literal}{$smarty.const.CHILD4DOBM}{literal}';
        var child4em = '{/literal}{$smarty.const.CHILD4EMM}{literal}';
        var child4g = '{/literal}{$smarty.const.CHILD4G}{literal}';

        $('.child-2').hide();
        $('.child-3').hide();
        $('.child-4').hide();

        // Children
        var selectedchildren = $('input[name='+childprice+']:checked').val();

        if (selectedchildren) {
            if (selectedchildren == onegirl) {
                $('.child-2').hide();
                $('.child-3').hide();
                $('.child-4').hide();
            }
            if (selectedchildren == twogirls) {
                $('.child-2').show();
            }
            if (selectedchildren == threegirls) {
                $('.child-2').show();
                $('.child-3').show();
            }
            if (selectedchildren == fourgirls) {
                $('.child-2').show();
                $('.child-3').show();
                $('.child-4').show();
            }
        }

        $('input[name='+childprice+']').change(function() {
            var noofchildren = $(this).val();

            if (noofchildren == onegirl) {
                $('#'+child2fn).val('');
                $('#'+child2ln).val('');
                $('#'+child2dob).val('');
                $('#'+child2em).val('');
                $('#'+child2g).val('');
                $('#'+child2dob).next('input').datepicker('setDate', null);

                $('#'+child3fn).val('');
                $('#'+child3ln).val('');
                $('#'+child3dob).val('');
                $('#'+child3em).val('');
                $('#'+child3g).val('');
                $('#'+child3dob).next('input').datepicker('setDate', null);

                $('#'+child4fn).val('');
                $('#'+child4ln).val('');
                $('#'+child4dob).val('');
                $('#'+child4em).val('');
                $('#'+child4g).val('');
                $('#'+child4dob).next('input').datepicker('setDate', null);

                $('.child-2').hide();
                $('.child-3').hide();
                $('.child-4').hide();
            }
            if (noofchildren == twogirls) {
                $('#'+child3fn).val('');
                $('#'+child3ln).val('');
                $('#'+child3dob).val('');
                $('#'+child3em).val('');
                $('#'+child3g).val('');
                $('#'+child3dob).next('input').datepicker('setDate', null);

                $('#'+child4fn).val('');
                $('#'+child4ln).val('');
                $('#'+child4dob).val('');
                $('#'+child4em).val('');
                $('#'+child4g).val('');
                $('#'+child4dob).next('input').datepicker('setDate', null);

                $('.child-2').show();
                $('.child-3').hide();
                $('.child-4').hide();
            }
            if (noofchildren == threegirls) {
                $('#'+child3fn).val('');
                $('#'+child3ln).val('');
                $('#'+child3dob).val('');
                $('#'+child3em).val('');
                $('#'+child3g).val('');
                $('#'+child3dob).next('input').datepicker('setDate', null);


                $('.child-2').show();
                $('.child-3').show();
                $('.child-4').hide();
            }
            if (noofchildren == fourgirls) {
                $('.child-2').show();
                $('.child-3').show();
                $('.child-4').show();
            }
        });
    });
</script>
{/literal}
