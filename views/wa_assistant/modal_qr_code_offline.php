<?php
// if (!empty($qr_url)) {
// 	$url = "http://178.128.217.224:3033/scan/qr/".$qr_url;
// }
?>

<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Scan QR Code</h4>
			<button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="text-center">
				<h3><?= $message ?></h3>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>