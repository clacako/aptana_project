<div class="card" style="background-color: #4a5566;" data-layout='whatsapp_widget_item'>
	<div class="card-body">
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Header Text</label>
			<div class="col-md-8">
				<input type="text" class="form-control" placeholder="Header Text" name="whatsapp_coupon_widget_item_header_text_<?= $index ?? $layout_index ?? null ?>[]" value="<?= !empty($layout_index) ? ${"whatsapp_coupon_widget_item_header_text_".$layout_index} ?? null : null ?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Text Color</label>
			<div class="col-md-8">
				<div class="input-group">
					<input type="text" class="color-hex form-control" value="<?= !empty($layout_index) ? ${"whatsapp_coupon_widget_item_text_color_".$layout_index} ?? '#ffffff' : null ?>" placeholder="Text color (hex)" name="whatsapp_coupon_widget_item_text_color_<?= $index ?? $layout_index ?? null ?>[]">
					<span class="input-group-colorpicker">
						<input class="form-control" type="color" value="<?= !empty($layout_index) ? ${"whatsapp_coupon_widget_item_text_color_".$layout_index} ?? '#ffffff' : null ?>" style="padding: 0.2em">
					</span>
				</div>
			</div>
		</div>
		
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Display Style</label>
			<div class="col-md-8">
				<select class="form-control select2" name="whatsapp_coupon_widget_item_display_style_<?= $index ?? $layout_index ?? null ?>[]">
					<option value="1" <?= !empty($layout_index) ? !empty(${"whatsapp_coupon_widget_item_display_style_".$layout_index}) ? (${"whatsapp_coupon_widget_item_display_style_".$layout_index} == 1 ? "selected='selected'" : null) : null : null?> >Slider</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Campaign</label>
			<div class="col-md-8">
				<select class="form-control select2" name="whatsapp_coupon_widget_item_campaign_<?= $index ?? $layout_index ?? null ?>[]">
					<?php foreach ($campaign_list as $list): ?>
						<option value="<?= $list['id'] ?>" <?= !empty($layout_index) ? !empty(${"whatsapp_coupon_widget_item_campaign_".$layout_index}) ? (${"whatsapp_coupon_widget_item_campaign_".$layout_index} == $list['id'] ? "selected='selected'" : null) : null : null?>><?= $list['CampaignTitle'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
	<div class="card-footer text-danger remove-whatsapp-widget" style="cursor: pointer;">
		Remove
	</div>
</div>