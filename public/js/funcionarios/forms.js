$(document).ready(function () {

    url = window.location;
    url_base = url.origin+'/SIREPOL/';

    $("#organismo").on('change', function() {
    	getSelectJerarquiaByOrganismo()
    });

    function getSelectJerarquiaByOrganismo() {
        var idOrganismo = $('#organismo').val();
        var postUrl = url_base + "jerarquia/"+idOrganismo;
        var dataform = new FormData();
        //dataform.append('fecha', idOrganismo);
        $.ajax({
            type: 'GET',
            url: postUrl,
            data: dataform,
            processData: false,
            contentType: false,
            success: function (result) {
                select = $('#jerarquia');
                select.html('').val('');
                
                for (var i = 0; i < result.length; i++) {
                    select.append('<option value="'+result[i].id+'">'+result[i].valor+'</option>');
                };
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(xhr.status > "299") {
                    window.location.href = url_base;
                }
            }
        })
    };

})