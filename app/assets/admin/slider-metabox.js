jQuery(document).ready((function(e){return"undefined"!=typeof wp&&void 0!==wp.media&&("undefined"!=typeof eul_slider_metabox&&(e("#eul-slider-choose").on("click",(function(t){t.preventDefault();var l=wp.media.controller.Library.extend({defaults:_.defaults({filterable:"all"},wp.media.controller.Library.prototype.defaults)}),i=wp.media({title:eul_slider_metabox.choose||"",multiple:!1,states:[new l]});i.on("open",(function(){var t=i.state().get("selection"),l=e("#eul-slider-attachment").val();t.add(wp.media.attachment(l))})),i.on("select",(function(){var t=i.state().get("selection").first().toJSON();if(e("#eul-slider-attachment").val(t.id),void 0!==t.sizes.slider&&(t=t.sizes.slider),0===e("#eul-slider-image").length){var l=e('<figure><img id="eul-slider-image" /></figure>');e("#eul-slider-choose").before(l)}e("#eul-slider-image").attr("src",t.url)})),i.open()})),void e("#eul-slider-remove").on("click",(function(t){t.preventDefault(),e("#eul-slider-image").closest("figure").remove(),e("#eul-slider-attachment").val("")}))))}));