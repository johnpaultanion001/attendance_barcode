$(function(){
	var pressed = false; 
    var chars = [];

    $(window).on('keydown', function(e) {
        if( event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74 )
      		event.preventDefault();
    });

    // $(window).on('input', function(e) {
    //     if (e.which >= 48 && e.which <= 57)
    //     {
    //         chars.push(String.fromCharCode(e.which));
    //     }

    //     $("#previewArea").removeClass('hidden');
    //     console.log('test');
   
    //     $("#previewArea").html('<div class="box box-solid"><div class="box-body"><p class="text-center"><i class="fa fa-refresh fa-spin"></i></p></div></div>');

    //     var barcode = chars.join("");
    //     console.log("Barcode Scanned: " + barcode);
    //     $("#txtBarcode").val(barcode);
    //     $("#txtBarcode").focus();
    //     $.post($("#txtBarcode").parent().parent().attr('action'), $("#txtBarcode").parent().parent().serialize(), function(response){
    //         $("#previewArea").html(response);
    //         var studentId = $("#previewArea").find("input[name='studentid']").val();
    //         loadEventAttendance(studentId);
    //     });
    // });

  
  

    // $('#txtBarcode').on("input", function() {
    //     var barcode = this.value;

       
    // });


    $("#txtBarcode").on('focus', function(e){
	    $(this).select();
	});

	/*$("#txtBarcode").on('keypress', function(e){
	    if ( e.which === 13 ) {
            $.post($("#txtBarcode").parent().parent().attr('action'), $("#txtBarcode").parent().parent().serialize(), function(response){
                $("#previewArea").html(response);
                var studentId = $("#previewArea").find("input[name='studentid']").val();
                loadEventAttendance(studentId);
            });
	        console.log("Prevent form submit.");
	        e.preventDefault();
	    }
	});*/

	$("#txtBarcode").focus();

    
});