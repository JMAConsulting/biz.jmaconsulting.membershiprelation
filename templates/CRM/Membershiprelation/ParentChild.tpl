{literal}
<script type="text/javascript">
    CRM.$(function($) {
        var childprice = '{/literal}{$smarty.const.CHILDPRICEM}{literal}';

        var onegirl = '{/literal}{$smarty.const.ONEGIRL}{literal}';
        var twogirls = '{/literal}{$smarty.const.TWOGIRLS}{literal}';
        var threegirls = '{/literal}{$smarty.const.THREEGIRLS}{literal}';
        var fourgirls = '{/literal}{$smarty.const.FOURGIRLS}{literal}';

        var child2fn = '{/literal}{$smarty.const.CHILD2FNM}{literal}';
        var child2ln = '{/literal}{$smarty.const.CHILD2LNM}{literal}';
        var child2dob = '{/literal}{$smarty.const.CHILD2DOBM}{literal}';
        var child2em = '{/literal}{$smarty.const.CHILD2EMM}{literal}';

        var child3fn = '{/literal}{$smarty.const.CHILD3FNM}{literal}';
        var child3ln = '{/literal}{$smarty.const.CHILD3LNM}{literal}';
        var child3dob = '{/literal}{$smarty.const.CHILD3DOBM}{literal}';
        var child3em = '{/literal}{$smarty.const.CHILD3EMM}{literal}';

        var child4fn = '{/literal}{$smarty.const.CHILD4FNM}{literal}';
        var child4ln = '{/literal}{$smarty.const.CHILD4LNM}{literal}';
        var child4dob = '{/literal}{$smarty.const.CHILD4DOBM}{literal}';
        var child4em = '{/literal}{$smarty.const.CHILD4EMM}{literal}';

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
                $('#'+child2dob).next('input').datepicker('setDate', null);

                $('#'+child3fn).val('');
                $('#'+child3ln).val('');
                $('#'+child3dob).val('');
                $('#'+child3em).val('');
                $('#'+child3dob).next('input').datepicker('setDate', null);

                $('#'+child4fn).val('');
                $('#'+child4ln).val('');
                $('#'+child4dob).val('');
                $('#'+child4em).val('');
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
                $('#'+child3dob).next('input').datepicker('setDate', null);

                $('#'+child4fn).val('');
                $('#'+child4ln).val('');
                $('#'+child4dob).val('');
                $('#'+child4em).val('');
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

