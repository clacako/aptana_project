<?php
	$button_style_list = json_decode(PAGE_BUILDER_CUSTOM_LINK_BUTTON_STYLE,true);
?>

<div class="card card-draggable ui-sortable-handle" id="custom_link<?= !empty($layout_index) ? "_$layout_index":null ?>" data-layout="custom_link">
	<div class="card-header">
		<h4 class="m-0">
			<a class="text-dark" data-toggle="collapse" href="#collapse_custom_link<?= !empty($layout_index) ? "_$layout_index":null ?>" aria-expanded="true">
				<i class="fas fa-angle-down mr-1 float-right"></i>
				Custom Links
			</a>
		</h4>
	</div>

	<div id="collapse_custom_link<?= !empty($layout_index) ? "_$layout_index":null ?>" class="collapse show">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Header Text</label>
				<div class="col-md-8">
					<input type="text" class="form-control" placeholder="Header text" name="custom_link_header_text[]" value="<?= $item_list['custom_link_header_text'] ?? null ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Button Style</label>
				<div class="col-md-8">
					<select class="form-control" name="custom_link_button_style[]" required="required">
						<?php foreach ($button_style_list as $key => $value): ?>
							<option value="<?= $key ?>" <?= !empty($item_list['custom_link_button_style']) ? ($item_list['custom_link_button_style'] == $key ? "selected='selected'":null) : null ?>>
								<?= $value ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Text Color</label>
				<div class="col-md-8">
					<div class="input-group">
						<input type="text" class="color-hex form-control" value="<?= $item_list['custom_link_text_color'] ?? "#ffffff" ?>" placeholder="Text color (hex)" aria-label="Text color" name="custom_link_text_color[]">
						<span class="input-group-colorpicker">
							<input class="form-control" type="color" value="<?= $item_list['custom_link_text_color'] ?? "#ffffff" ?>">
						</span>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Background Color</label>
				<div class="col-sm-8 mt-1">
					<div class="radio">
						<input type="radio" name="custom_link_background_color_<?= $index ?? $layout_index ?? null ?>" value="1" <?= !empty($layout_index) ? !empty($item_list["custom_link_background_color_$layout_index"]) ? ($item_list["custom_link_background_color_$layout_index"] == 1 ? "checked='checked'" : null) : null : null ?> >
						<label>Transparent</label>
					</div>
					<span class="radio-group-colorpicker">
						<div class="radio">
							<input type="radio" name="custom_link_background_color_<?= $index ?? $layout_index ?? null ?>" value="2" <?= !empty($layout_index) ? !empty($item_list["custom_link_background_color_$layout_index"]) ? ($item_list["custom_link_background_color_$layout_index"] == 2 ? "checked='checked'" : null) : null : null ?> >
							<label>Solid Color</label>
						</div>
						<div class="input-group">
							<input type="text" class="color-hex form-control" value="<?= $item_list['custom_link_background_color_hex_value'] ?? "#ffffff" ?>" name="custom_link_background_color_hex_value[]" placeholder="Background Solid color (hex)">
							<span class="input-group-colorpicker">
								<input class="form-control" type="color" value="<?= $item_list['custom_link_background_color_hex_value'] ?? "#ffffff" ?>" style="padding: 0.2em">
							</span>
						</div>
					</span>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-4 col-form-label text-md-right">Border Color</label>
				<div class="col-sm-8 mt-1">
					<div class="radio">
						<input type="radio" name="custom_link_border_color_<?= $index ?? $layout_index ?? null ?>" value="1" <?= !empty($layout_index) ? !empty($item_list["custom_link_border_color_$layout_index"]) ? ($item_list["custom_link_border_color_$layout_index"] == 1 ? "checked='checked'" : null) : null : null ?> >
						<label>Transparent</label>
					</div>
					<span class="radio-group-colorpicker">
						<div class="radio">
							<input type="radio" name="custom_link_border_color_<?= $index ?? $layout_index ?? null ?>" value="2" <?= !empty($layout_index) ? !empty($item_list["custom_link_border_color_$layout_index"]) ? ($item_list["custom_link_border_color_$layout_index"] == 2 ? "checked='checked'" : null) : null : null ?> >
							<label>Solid Color</label>
						</div>
						<div class="input-group">
							<input type="text" class="color-hex form-control" value="<?= $item_list['custom_link_border_color_hex_value'] ?? "#ffffff" ?>" name="custom_link_border_color_hex_value[]" placeholder="Border Solid color (hex)">
							<span class="input-group-colorpicker">
								<input class="form-control" type="color" value="<?= $item_list['custom_link_border_color_hex_value'] ?? "#ffffff" ?>" style="padding: 0.2em">
							</span>
						</div>
					</span>
				</div>
			</div>

			<h5>Menu Items</h5>
			<span id="menu_items_area">
				<?php if (!empty($item_list['menu_item'])): ?>
					<?php
						$menu_item_list = $item_list['menu_item'];
						$count = count($menu_item_list["custom_link_menu_item_button_id_$layout_index"]);
						
						// **
						// for attr name naming
						$data['layout_index'] = $layout_index;
						for ($i = 0; $i < $count; $i++) {
							// **
							// data of input field based on iteration
							$data['button_id'] = $menu_item_list["custom_link_menu_item_button_id_$layout_index"][$i];
							$data['text'] = $menu_item_list["custom_link_menu_item_text_$layout_index"][$i];
							$data['url'] = $menu_item_list["custom_link_menu_item_url_$layout_index"][$i];
							
							$card = "menu_item__custom_link";
							$this->load->view("landing_page/layout_cards/{$card}", $data ?? null, FALSE);
						}
					?>
				<?php endif ?>
			</span>

			<div style="display: flex; justify-content: flex-end;">
				<button type="button" class="btn btn-info waves-effect width-md waves-light add-menu-item">Add Menu Item</button>
			</div>
		</div>

		<div class="card-footer">
			<a class="text-danger delete-card" style="cursor: pointer;">Delete</a>
		</div>
	</div>
</div>