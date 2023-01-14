<div class="card card-draggable ui-sortable-handle" id="brand_profile<?= !empty($layout_index) ? "_$layout_index":null ?>" data-layout="brand_profile">
	<div class="card-header">
		<h4 class="m-0">
			<a class="text-dark" data-toggle="collapse" href="#collapse_brand_profile" aria-expanded="true">
				<i class="fas fa-angle-down mr-1 float-right"></i>
				Brand Profile
			</a>
		</h4>
	</div>

	<div id="collapse_brand_profile" class="collapse show">
		<div class="card-body">
			<span>
				<!-- image upload -->
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Choose image to upload</label>
					<div class="col-md-8 mt-2">
						<img src="<?= !empty($item_list['brand_profile_image']) ? $item_list['brand_profile_image']."?".rand() : null ?>" alt="&nbsp; your image will be shown here" class="img-preview rounded-circle" width="150px" height="150px">
						<input type="hidden" class="uploaded-image" name="brand_profile_image[]" value="<?= !empty($item_list['brand_profile_image']) ? $item_list['brand_profile_image'] : null ?>" <?= empty($item_list['brand_profile_image']) ? "disabled='disabled'" : null ?> >
						<div class="mt-2"></div>
						
						<span class="choose-image" style="text-decoration: underline; color: #71b6f9; cursor: pointer;">Choose image</span>
						<input type="file" class="upload-image" name="brand_profile_image[]" accept="image/*" style="display: none;">
						<br><br>
						<small>* image will be uploaded after clicking "<span class="text-success">Save Changes</span>" button at the bottom</small>
					</div>
				</div>
			</span>

			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Show Brand ID</label>
				<div class="col-sm-6">
					<div class="checkbox mt-1">
						<input type='hidden' value='0' name='brand_profile_show_brand_id[]' <?= isset($item_list['brand_profile_show_brand_id']) ? ($item_list['brand_profile_show_brand_id'] == 1 ? "disabled='disabled'" : null) : null ?> >
						<input type="checkbox" name="brand_profile_show_brand_id[]" value="1" <?= !empty($item_list['brand_profile_show_brand_id']) ? ($item_list['brand_profile_show_brand_id'] ? "checked='checked'":null) : null ?> >
						<label class="show-brand-id">show</label>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Text Color</label>
				<div class="col-md-8">
					<div class="input-group">
						<input type="text" class="color-hex form-control" name="brand_profile_text_color[]" value="<?= $item_list['brand_profile_text_color'] ?? "#ffffff" ?>" placeholder="Text color (hex)" aria-label="Text color">
						<span class="input-group-colorpicker">
							<input class="form-control" type="color" value="<?= $item_list['brand_profile_text_color'] ?? "#ffffff" ?>">
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<a class="text-danger delete-card" style="cursor: pointer;">Delete</a>
		</div>
	</div>
</div>