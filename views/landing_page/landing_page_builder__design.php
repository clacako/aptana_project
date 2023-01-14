<!-- custom -->
<link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
<?= form_open_multipart($submit_url, "class='form-horizontal'", $hidden ?? null); ?>
	<?= form_hidden('layout_order'); ?>
	
	<div class="form-group row">
		<label class="col-sm-5 col-md-3 col-form-label">Background Color</label>
		<div class="mt-1">
			<span class="radio-group-colorpicker">
				<div class="radio">
					<input id="background_color_solid" type="radio" value="1" name="background_color" <?= isset($json_page_builder['raw_input']['background_color']) ? ($json_page_builder['raw_input']['background_color'] == 1 ? "checked='checked'":null) : null ?> >
					<label for="background_color_solid">Solid</label>
				</div>
				<div class="input-group">
					<input type="text" class="color-hex form-control" name="background_color_solid_hex_value" value="<?= $json_page_builder['raw_input']['background_color_solid_hex_value'] ?? "#ffffff" ?>" placeholder="Solid color (hex)">
					<span class="input-group-colorpicker">
						<input class="form-control" type="color" value="<?= $json_page_builder['raw_input']['background_color_solid_hex_value'] ?? "#ffffff" ?>" style="padding: 0.2em">
					</span>
				</div>
			</span>
		</div>
	</div>

	<div class="form-group row">
		<div class="offset-md-3 mt-1">
			<span class="radio-group-colorpicker">
				<div class="radio">
					<input id="background_color_gradient" type="radio" value="2" name="background_color" <?= isset($json_page_builder['raw_input']['background_color']) ? ($json_page_builder['raw_input']['background_color'] == 2 ? "checked='checked'":null) : null ?>>
					<label for="background_color_gradient">Gradient</label>
				</div>

				<div class="form-row align-items-center mb-1">
                    <div class="col-auto">
                        <label class="col-form-label" for="gradient_direction">Gradient direction (degree)</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="gradient_direction" class="form-control" name="gradient_direction" value="<?= $json_page_builder['raw_input']['gradient_direction'] ?? "0" ?>" min="0" max="360" step="5">
                    </div>
                </div>

				<div class="form-row align-items-center">
                    <div class="col-auto mb-1">
                        <div class="input-group">
							<input type="text" class="color-hex form-control" id="gradient_color_hex_value_1" name="background_color_gradient_hex_value[]" placeholder="Gradient color (hex)" value="<?= $json_page_builder['raw_input']['background_color_gradient_hex_value'][0] ?? "#ffffff" ?>" >
							<span class="input-group-colorpicker">
								<input class="form-control" type="color" id="gradient_colorpicker_1" value="<?= $json_page_builder['raw_input']['background_color_gradient_hex_value'][0] ?? "#ffffff" ?>" style="padding: 0.2em">
							</span>
						</div>
                    </div>
                    <div class="col-auto mb-1">
                        <div class="input-group">
							<input type="text" class="color-hex form-control" id="gradient_color_hex_value_2" name="background_color_gradient_hex_value[]" placeholder="Gradient color (hex)" value="<?= $json_page_builder['raw_input']['background_color_gradient_hex_value'][1] ?? "#ffffff" ?>" >
							<span class="input-group-colorpicker">
								<input class="form-control" type="color" id="gradient_colorpicker_2" value="<?= $json_page_builder['raw_input']['background_color_gradient_hex_value'][1] ?? "#ffffff" ?>" style="padding: 0.2em">
							</span>
						</div>
                    </div>
                </div>

                <div class="card-body form-control col-md-12" id="gradient_preview" style="height: 100px"></div>
			</span>
		</div>
	</div>

	<!-- layout -->

	<div class="form-group row mt-3">
		<label class="col-sm-5 col-md-3 col-form-label">Layout</label>
		<div class="col-sm-7 sortable ui-sortable" id="layout_cards" style="background-color: #4a5566; border-radius: .25rem; padding-top: 1em">
			<div class="row justify-content-start">
				<div class="col-sm-12">
					<label class="col-form-label">Section to add</label>
				</div>
				<div class="col-sm-12 button-list" id="button_list">
					<button type="button" class="btn btn-lighten-primary waves-effect waves-primary width-xs" data-layout-card="full_width_image">Full Width Image</button>
					<button type="button" class="btn btn-lighten-primary waves-effect waves-primary width-xs" data-layout-card="brand_profile">Brand Profile</button>
					<button type="button" class="btn btn-lighten-primary waves-effect waves-primary width-xs" data-layout-card="custom_link">Custom Links</button>
					<button type="button" class="btn btn-lighten-primary waves-effect waves-primary width-xs" data-layout-card="whatsapp_coupon_widget">WhatsApp Coupon Widgets</button>
					<button type="button" class="btn btn-lighten-primary waves-effect waves-primary width-xs" data-layout-card="contacts_icon">Contacts Icon</button>
				</div>
			</div>

			<hr>
			<span id="cards_area">
				<?php if (!empty($json_page_builder['raw_input']['layout_order'])): ?>
					<?php
						foreach ($json_page_builder['section_list'] as $section => $section_item) {
							// **
							// exlode the section name, and pop the last item to get the name of the layout/card
							$temp = explode("_", $section);
							array_pop($temp);
							$section = implode("_", $temp);

							// **
							// data needed
							$data['layout_index'] = $section_item['layout_index'] ?? null;
							$data['item_list'] = $section_item;

							// **
							// load the view
							$card = "layout_card__{$section}";
							!empty($card) ? $this->load->view("landing_page/layout_cards/{$card}", $data ?? null, FALSE) : null;
						}
					?>
				<?php endif ?>
			</span>
		</div>
	</div>

	<div class="form-group row">
		<div class="offset-md-3 mt-1">
			<button type="submit" name="save_changes" class="btn btn-success waves-effect width-md waves-light">Save Changes</button>
		</div>
	</div>
<?= form_close(); ?>

<script src="<?= base_url() ?>assets/libs/jquery-ui/jquery-ui.min.js"></script>

<!-- draggable init -->
<script src="<?= base_url() ?>assets/js/pages/draggable.init.js"></script>

<script>
	$(document).ready(function(){
		preview_gradient_color();
	});

	$(document).on("click","#button_list > button",function(){
		let card_to_get = $(this).data("layout-card")
		// let card_count = $(`#cards_area [id^=${card_to_get}]`).length
		
		// get collection of index of ids
		let index_array = $(`#cards_area [id^=${card_to_get}]`).map(function() { return this.id.split(`${card_to_get}_`).pop() }).get()
		
		// get max index
		let card_count = index_array.length > 0 ? Math.max(...index_array) : 0
		get_card(card_to_get, card_count);
	});

	$(document).on("change",".upload-image",function(){
		preview_choosen_image($(this));
	});

	$(document).on("click",".choose-image",function(){
		open_window_select_image($(this));
	});

	$(document).on("click",".show-brand-id",function(){
		check_show_brand_checkbox($(this));
	});

	$(document).on("click",".remove-whatsapp-widget",function(){
		remove_whatsapp_widget($(this))
	});

	$(document).on("click",".add-whatsapp-widget",function(){
		get_whatsapp_widget_item($(this));
	});

	$(document).on("click",".remove-menu-item",function(){
		remove_menu_item_custom_link($(this))
	});

	$(document).on("click",".add-menu-item",function(){
		get_custom_link_menu_item($(this))
	});

	$(document).on("click","a.delete-card",function(){
		delete_card($(this));
	});

	// gradient colorpicker
	$(document).on("change click","[id^='gradient_colorpicker_']",function(){
		preview_gradient_color();
	});

	$(document).on("input","[name^='background_color_gradient_hex_value']",function(){
		if ($(this).val().length == 7) {
			preview_gradient_color();
		}
	});

	$(document).on("input","[name='gradient_direction']",function(){
		preview_gradient_color();
	});

	$( ".sortable" ).on( "sortupdate", function( event, ui ) {
		let layout_order = get_layout_order()
	});

	$(document).on("submit","form",function(e){
		let layout_order = get_layout_order()
		$("[name='layout_order']").val(layout_order)
	});

	function open_window_select_image(element) {
		element.siblings("[type='file']").trigger("click")
	}

	function preview_choosen_image(element) {
		let load_image = element.siblings(".img-preview").attr("src",URL.createObjectURL(element[0].files[0]))
		if (load_image.onload) {
			URL.revokeObjectURL(load_image)
		}
	}

	function get_custom_link_menu_item(element) {
		let url = "builder/get/custom_link_menu_item"
		let index = element.closest(".card").attr("id").split("custom_link_").pop()
		$.get(
			url,
			{index:index},
			function(resp){
				element.closest(".card-body").find("span#menu_items_area").append(resp)
				// let last_menu_item = element.closest(".card-body").find("span#menu_items_area > .card:last-child")
				// last_menu_item.find("input[type='text']").each(function(){
				// 	let name_value = $(this).attr("name")
				// 	$(this).attr("name",`${name_value}_${index}[]`)
				// })
			}
		);
	}

	function get_whatsapp_widget_item(element) {
		let url = "builder/get/whatsapp_widget_item"
		let index = element.closest(".card").attr("id").split("whatsapp_coupon_widget_").pop()
		$.get(
			url,
			{index:index},
			function(resp){
				element.closest(".card-body").find("span#whatsapp_widget_area").append(resp);
			}
		);
	}

	function check_show_brand_checkbox(element) {
		let checked_state = element.siblings("[type='checkbox']").prop("checked")
		element.siblings("[type='checkbox']").prop("checked",!checked_state)
		
		let disabled_state = element.siblings("[type='hidden']").attr("disabled")
		element.siblings("[type='hidden']").attr("disabled",!disabled_state)
	}

	function remove_whatsapp_widget(element) {
		element.closest(".card[data-layout='whatsapp_widget_item']").remove();
	}

	function remove_menu_item_custom_link(element) {
		element.closest(".card[data-layout='menu_item']").remove();
	}

	function delete_card(element) {
		element.closest(".card-draggable").remove();
	}

	function get_card(card_to_get, card_count) {
		let url = "builder/get/card";
		$.get(
			url,
			{card_to_get: card_to_get},
			function(resp){
				$("span#cards_area").append(resp)
				// rename id to include iteration
				let index = Number(card_count) + 1
				let recently_added_card = $("span#cards_area").find(`#${card_to_get}`).attr("id",`${card_to_get}_${index}`)

				// rename href collapsible of recently added card
				let temp = recently_added_card.find("[data-toggle='collapse']")
				let href_value = temp.attr("href")
				temp.attr("href",`${href_value}_${index}`)

				// rename div collapse
				temp = recently_added_card.find(".collapse")
				let id_value = temp.attr("id")
				temp.attr("id",`${id_value}_${index}`)

				// trigger add item of whatsapp widget
				temp = recently_added_card.find("button.add-whatsapp-widget")
				if (temp.length > 0) {
					temp.trigger("click")
				}

				// trigger add item of menu items
				temp = recently_added_card.find("button.add-menu-item")
				if (temp.length > 0) {
					temp.trigger("click")
				}
			}
		);
	}

	function preview_gradient_color() {
		let direction = $("[name='gradient_direction']").val()
		let color_1 = hex_to_rgba($("#gradient_color_hex_value_1").val());
		let color_2 = hex_to_rgba($("#gradient_color_hex_value_2").val());
		// let color_3 = hex_to_rgba($("#gradient_color_hex_value_3").val());
		if (color_1 && color_2) {
			$("#gradient_preview").css("background-image",`linear-gradient(${direction}deg, ${color_1}, ${color_2})`)
		}
	}

	function get_layout_order(){
		var idsInOrder = $(".sortable").sortable("toArray");
		return idsInOrder
	}

	function hex_to_rgba(hex){
		var c;
		if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
			c= hex.substring(1).split('');
			if(c.length== 3){
				c= [c[0], c[0], c[1], c[1], c[2], c[2]];
			}
			c= '0x'+c.join('');
			return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1)';
		}
		// throw new Error('Bad Hex');
	}
</script>