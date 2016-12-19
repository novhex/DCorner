$(document).ready(function(){

    hide_profilebuttons();
	
    $(".dropdown").hover(            
        

        function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
        
        function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up"); 

    });


   $('#bdate').datepicker({
            
            format: 'yyyy-mm-dd'
    });
            

   $("#dphoto").on('change',function(){

        previous_profilephoto  = $("#profile_dp").attr('src');
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            $("#profile_dp").attr('src',e.target.result);
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);

        $("#dp-help-caption").hide();
        $("#btn-update-dp").show();
        $("#cancel-profiledp-change").show();

   });


});

function hide_profilebuttons(){

    $("#btn-update-dp").hide();
    $("#cancel-profiledp-change").hide();
}

