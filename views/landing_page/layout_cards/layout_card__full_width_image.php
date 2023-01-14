<div class="card card-draggable ui-sortable-handle" id="full_width_image<?= !empty($layout_index) ? "_$layout_index":null ?>" data-layout="full_width_image">
	<div class="card-header">
		<h4 class="m-0">
			<a class="text-dark" data-toggle="collapse" href="#collapse_full_width_image" aria-expanded="true">
				<i class="fas fa-angle-down mr-1 float-right"></i>
				Full Width Image
			</a>
		</h4>
	</div>

	<div id="collapse_full_width_image" class="collapse show">
		<div class="card-body">
			<span>
				<!-- image upload -->
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Choose image to upload</label>
					<div class="col-md-8 mt-2">
						<img src="<?= !empty($item_list['full_width_image_image']) ? $item_list['full_width_image_image']."?".rand() : null ?>" alt="&nbsp; your image will be shown here" class="img-preview img-thumbnail">
						<input type="hidden" class="uploaded-image" name="full_width_image_image[]" value="<?= !empty($item_list['full_width_image_image']) ? $item_list['full_width_image_image'] : null ?>" <?= empty($item_list['full_width_image_image']) ? "disabled='disabled'" : null ?> >

						<div class="mt-2"></div>
						
						<span class="choose-image" style="text-decoration: underline; color: #71b6f9; cursor: pointer;">Choose image</span>
						<input type="file" class="upload-image" name="full_width_image_image[]" accept="image/*" style="display: none;">
						<br><br>
						<small>* image will be uploaded after clicking "<span class="text-success">Save Changes</span>" button at the bottom</small>
					</div>
				</div>
			</span>
		</div>

		<div class="card-footer">
			<a class="text-danger delete-card" style="cursor: pointer;">Delete</a>
		</div>
	</div>
</div>