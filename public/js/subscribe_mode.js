    function contact_us() { 
        $('#loader_img').show();
        $('.help-inline').html('');
        $('.help-inline').removeClass('error');
        $.ajax({ 
            url: '{{ URL("subscribe") }}',
            type:'post',
            data: $('#contact_form').serialize(),
            success: function(r){
                error_array     =   JSON.stringify(r);
                data            =   JSON.parse(error_array);
                if(data['success'] == 1) {
                    window.location.href     =  "{{ URL('/') }}";
                }else { 
                    $.each(data['errors'],function(index,html){
                        $("#"+index).next().addClass('error');
                        $("#"+index).next().html(html);
                    });
                    $('#loader_img').hide();
                }
                $('#loader_img').hide();
            }
        });
    }
    $('#contact_form').each(function() {
        $(this).find('input').keypress(function(e) {
          if(e.which == 10 || e.which == 13) {
            contact_us();
            return false;
           }
       });
    });