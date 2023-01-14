<?php
	$contact_icon_list = json_decode(PAGE_BUILDER_CONTACT_ICON,true);
?>

<div class="card card-draggable ui-sortable-handle" id="contacts_icon<?= !empty($layout_index) ? "_$layout_index":null ?>" data-layout="contacts_icon">
	<div class="card-header">
		<h4 class="m-0">
			<a class="text-dark" data-toggle="collapse" href="#collapse_contacts_icon" aria-expanded="true">
				<i class="fas fa-angle-down mr-1 float-right"></i>
				Contact Icons
			</a>
		</h4>
	</div>

	<div id="collapse_contacts_icon" class="collapse show">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Header Text</label>
				<div class="col-md-8">
					<input type="text" id="contact_header_text" class="form-control" placeholder="Header text" name="contacts_icon_header_text[]" value="<?= $item_list['contacts_icon_header_text'] ?? null ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Header Color</label>
				<div class="col-md-8">
					<div class="input-group">
						<input type="text" class="color-hex form-control" value="<?= $item_list['contacts_icon_header_color'] ?? "#ffffff" ?>" placeholder="Text color (hex)" aria-label="Text color" name="contacts_icon_header_color[]">
						<span class="input-group-colorpicker">
							<input class="form-control" type="color" value="<?= $item_list['contacts_icon_header_color'] ?? "#ffffff" ?>">
						</span>
					</div>
				</div>
			</div>

			<br>
			<small class="text-center">Note: icon will not appear if the following fields left empty</small>
			<br><br>

			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Icon Color</label>
				<div class="col-md-8">
					<div class="input-group">
						<input type="text" class="color-hex form-control" value="<?= $item_list['contacts_icon_icon_color'] ?? "#ffffff" ?>" placeholder="Text color (hex)" aria-label="Text color" name="contacts_icon_icon_color[]">
						<span class="input-group-colorpicker">
							<input class="form-control" type="color" value="<?= $item_list['contacts_icon_icon_color'] ?? "#ffffff" ?>">
						</span>
					</div>
				</div>
			</div>
			<!-- icons -->
			<?php $i = 0; foreach ($contact_icon_list as $list): ?>
				<div class="form-group row mt-1">
					<label class="col-md-4 col-form-label text-md-right"><?= $list['label'] ?></label>
					<div class="col-md-8">
						<input type="text" name="contacts_icon_platform[]" class="form-control" placeholder="<?= $list['placeholder'] ?>" value="<?= !empty($item_list['contacts_icon_platform']) ? ($item_list['contacts_icon_platform'][$i]) : null ?>">
					</div>
				</div>
			<?php $i++; endforeach ?>
		</div>

		<div class="card-footer">
			<a class="text-danger delete-card" style="cursor: pointer;">Delete</a>
		</div>
	</div>
</div>