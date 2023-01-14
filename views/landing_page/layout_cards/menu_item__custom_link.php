<div class="card" style="background-color: #4a5566;" data-layout='menu_item'>
	<div class="card-body">
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Button ID</label>
			<div class="col-md-8">
				<input type="text" class="form-control alphanumeric-symbol" placeholder="Button ID" name="custom_link_menu_item_button_id_<?= $index ?? $layout_index ?>[]" value="<?= $button_id ?? null ?>" maxlength="25" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Text</label>
			<div class="col-md-8">
				<input type="text" class="form-control" placeholder="Button Text" name="custom_link_menu_item_text_<?= $index ?? $layout_index ?>[]" value="<?= $text ?? null ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">URL</label>
			<div class="col-md-8">
				<input type="text" class="form-control" placeholder="Redirect to..." name="custom_link_menu_item_url_<?= $index ?? $layout_index ?>[]" value="<?= $url ?? null ?>" required>
			</div>
		</div>
	</div>
	<div class="card-footer text-danger remove-menu-item" style="cursor: pointer;">
		Remove
	</div>
</div>