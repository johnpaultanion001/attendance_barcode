<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<?php if(count($this->events) > 0): ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-solid box-info">
							<div class="box-header with-border">
								<h4 class="box-title">Event</h4>
								<p class="no-margin pull-right">Officer Name: <?php echo ucwords(Session::get('firstname') . " " . Session::get('lastname')); ?></p>
							</div>
							<div class="row">
								<div class="box-body col-md-4 pl-2">
									<div id="reader"></div>
								</div>
								<div class="box-body col-md-6">
									<form method="post" action="<?php echo URL; ?>attendance/scan">
										<div class="form-group">
											<label class="control-label">Event Name</label>
											<?php if(count($this->events) == 0): ?>
											<input type="hidden" name="eventid" value="<?php echo $this->events[0]['eventid']; ?>" />
											<input type="text" readonly class="form-control" value="<?php echo $this->events[0]['event_name']; ?>" />
											<?php else: ?>
											<select class="form-control" name="eventid">
												<?php foreach($this->events as $event): ?>
												<option value="<?php echo $event['eventid']; ?>"><?php echo $event['event_name']; ?></option>
												<?php endforeach; ?>
											</select>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="barcode" id="txtBarcode" />
										</div>
									</form>
									<div id="previewArea"></div>
								</div>
							</div>
							
							
						</div>
					</div>
					<div class="col-md-12">
						<div class="box box-solid box-success">
							<div class="box-header with-border">
								<h4 class="box-title">Students that has Logged In</h4>
							</div>
							<div class="box-body" id="studentsListsEventAttendance">
								<p class="alert alert-info no-margin">There are no students yet</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="overlay hidden">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<?php else: ?>
			<p class="alert alert-info">There are no events for assigned for you</p>
			<?php endif; ?>
		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URL; ?>public/assets/scan/qr_code_scanner.js"></script>
<script>
    $(function () {
	function onScanSuccess(barcodeCodeMessage) {
            var barcode;
            barcode = barcodeCodeMessage;
            console.log(barcode)
            $('#txtBarcode').val(barcode)
			setTimeout(function(){
				$("#previewArea").removeClass('hidden');

				$("#previewArea").html('<div class="box box-solid"><div class="box-body"><p class="text-center"><i class="fa fa-refresh fa-spin"></i></p></div></div>');
				console.log("Barcode Scanned: " + barcode);

			
				$.post($("#txtBarcode").parent().parent().attr('action'), $("#txtBarcode").parent().parent().serialize(), function(response){
					$("#previewArea").html(response);
					var studentId = $("#previewArea").find("input[name='studentid']").val();
					loadEventAttendance(studentId);
            })},500);

    }


    function onScanError(errorMessage) {
        //handle scan error
    }
    
    var html5QrcodeScanner = new Html5QrcodeScanner(
		"reader", { fps: 1, qrbox: 350 });
		html5QrcodeScanner.render(onScanSuccess, onScanError);
	});

	function loadEventAttendance(studentId=0)
    {
        $(".overlay").removeClass('hidden');
        var eventId = ($("input[name='eventid']").length == 1) ? $("input[name='eventid']").val() : $("select[name='eventid']").val();
        $.get(window.siteurl + 'attendance/loadEventAttendance/' + eventId + "/" + studentId, function(result){
            $("#studentsListsEventAttendance").html(result);
            $(".overlay").addClass('hidden');
        });
    }

    loadEventAttendance();
    
</script>