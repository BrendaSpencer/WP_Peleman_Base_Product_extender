jQuery(document).ready(function ($) {
	$("form.variations_form").on("change", ".variations select", function () {
		$(".product-price").text("Updating...");
		$(".product-meta").text("Updating...");
		var form = $("form.variations_form");
		var product_id = form.data("product_id");

		var selected_options = form.serialize();

		$.ajax({
			url: mpv_variation_params.ajax_url,
			type: "POST",
			data: {
				action: "mpv_update_product_variation_data",
				product_id: product_id,
				selected_options: selected_options,
				nonce: mpv_variation_params.nonce,
			},
			success: function (response) {
				if (response.success) {
					$(".product-meta").html(response.data.meta_html);
					$(".product-price").html(response.data.price_html);
				}
			},
			error: function (response) {
				console.log(response);
			},
		});
	});
});
