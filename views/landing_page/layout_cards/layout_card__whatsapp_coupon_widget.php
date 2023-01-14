<div class="card card-draggable ui-sortable-handle" id="whatsapp_coupon_widget<?= !empty($layout_index) ? "_$layout_index":null ?>" data-layout="whatsapp_coupon_widget">
	<div class="card-header">
		<h4 class="m-0">
			<a class="text-dark" data-toggle="collapse" href="#collapse_whatsapp_coupon_widget" aria-expanded="true">
				<i class="fas fa-angle-down mr-1 float-right"></i>
				WhatsApp Coupon Widget
			</a>
		</h4>
	</div>

	<div id="collapse_whatsapp_coupon_widget" class="collapse show">
		<div class="card-body">
			<span id="whatsapp_widget_area">
				<?php
					if (!empty($item_list['widget_item'])) {
						$widget_item_list = $item_list['widget_item'];
						$count = count($widget_item_list["whatsapp_coupon_widget_item_header_text_$layout_index"]);

						// **
						// for attr name naming
						$data['layout_index'] = $layout_index;
						for ($i = 0; $i < $count; $i++) {
							// **
							// data needed
							$data["whatsapp_coupon_widget_item_header_text_$layout_index"] = $item_list['widget_item']["whatsapp_coupon_widget_item_header_text_$layout_index"][$i];
							$data["whatsapp_coupon_widget_item_text_color_$layout_index"] = $item_list['widget_item']["whatsapp_coupon_widget_item_text_color_$layout_index"][$i];
							$data["whatsapp_coupon_widget_item_display_style_$layout_index"] = $item_list['widget_item']["whatsapp_coupon_widget_item_display_style_$layout_index"][$i];
							$data["whatsapp_coupon_widget_item_campaign_$layout_index"] = $item_list['widget_item']["whatsapp_coupon_widget_item_campaign_$layout_index"][$i];
							
							// **
							// load widget item
							$card = "item__whatsapp_widget";
							$this->load->view("landing_page/layout_cards/{$card}", $data ?? null, FALSE);
						}
					}
				?>
			</span>

			<div style="display: flex; justify-content: flex-end;">
				<button type="button" class="btn btn-info waves-effect width-md waves-light add-whatsapp-widget">Add Item</button>
			</div>
		</div>

		<div class="card-footer">
			<a class="text-danger delete-card" style="cursor: pointer;">Delete</a>
		</div>
	</div>
</div>