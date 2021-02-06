<?php
if (!isConnect()) {
    include_file('desktop', '404', 'php');
    die();
}


?>
<form class="form-horizontal">
    <fieldset>
        <legend><i class="fas fa-list-alt"></i> {{Gestion des devices}}</legend>
        <div class="form-group">
            <label class="col-lg-4 col-md-3 col-sm-4 col-xs-6 control-label">{{Supprimer tous les devices smartHome !!}}</label>
            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                <a class="btn btn-danger bt_supprimeTouslesDevicesSmartHome"><i class="fas fa-exclamation-triangle"></i>
                    {{Lancer}}</a>
            </div>
        </div>
    </fieldset>
</form>

<script>

    $('.bt_supprimeTouslesDevicesSmartHome').off('click').on('click', function () {
        $('#md_modal').dialog('close');

        bootbox.confirm({
            message: "Etes-vous sûr de vouloir supprimer tous les équipements du plugin Alexa-smartHome ?",
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'Non',
                    className: 'btn-success'
                }
            },
            callback: function (result) {
                /*$('#div_alert').showAlert({
                    message : "{{Suppression en cours ...}}",
                    level : 'success'
                });*/
                if (result) {
                    //$.showLoading(); ??
                    $.ajax({
                        type: 'POST',
                        url: 'plugins/alexaapi/core/ajax/alexaapi.ajax.php',
                        data: {
                            action: 'supprimeTouslesDevicesSmartHome',
                        },
                        dataType: 'json',
                        global: false,
                        error: function (request, status, error) {
                            //$.hideLoading(); ??
                            $('#div_alert').showAlert({
                                message: error.message,
                                level: 'danger'
                            });
                        },
                        success: function (data) {
                            //$.hideLoading();??
                            //$('li.li_plugin.active').click();??
      window.location.reload();

                        }
                    });
                }
            }
        });

    });
</script>