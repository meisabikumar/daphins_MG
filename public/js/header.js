
$(document).on('change','#game_mode',function(){
    var selectValue   =  $(this).val();
    $('#loader_img').show(); 
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url:scriptVar,
        'type':'post',
        data:{'club_id':selectValue},
        success:function(response){
            $('.append_club_name').html(response);
            $('#loader_img').hide();
        }
    });
});
$(document).on('change','#club_id',function(){  
    var selectValue   =  $(this).val();
    // $('#loader_img').show(); 
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url:getGameName,
        'type':'post',
        data:{'id':selectValue},
        success:function(response){ 
            error_array     =   JSON.stringify(response);
            data            =   JSON.parse(error_array);
            $(".club_logo").attr("src",club_image_url+data['image']);
            $('.game_name').html(data['name']);
            $('.city_name').html(data['city_name']);
            // $('#loader_img').hide();
        }
    });
});