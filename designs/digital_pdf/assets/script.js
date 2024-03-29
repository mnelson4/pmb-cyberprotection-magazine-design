// once doc conversion requested, process the HTML and trigger when we're ready.
jQuery(document).on('pmb_doc_conversion_requested', function(){
    pmb_doc_conversion_request_handled = true;
    pmb_default_align_center();
    jQuery('.pmbcpm-title-page-cover-image').each(function(index, element){
        pmb_set_image_dimension_attributes(element);
    });
    jQuery('.pmbcpm-qr-code').each(function(){
        new QRCode(
            this,
            {
                text:this.attributes['data-url'].value,
                height:64,
                width:64
            });
    });
    //pmb_replace_internal_links_with_page_refs_and_footnotes('footnote', 'footnote', pmb_design_options['external_footnote_text'], pmb_design_options['internal_footnote_text']);
    new PmbToc(function(title_text, href_id, depth, height, matter_class, jq_selection){
        if(depth === 0 || depth === '0'){
            // part
            return '<div class="pmbcpm-toc-part-title-wrapper"><div class="pmbcpm-first-item"><div class="pmbcpm-part-underline">&nbsp;</div></div><div class="pmbcpm-toc-part-title-cell"><span class="pmbcpm-toc-part-title pmbcpm-part-underline">' + title_text+ '</span></div>';
        } else {
            // article
            var excerpt = jq_selection.find('.pmbcpm-subtitle h2');
            if(excerpt.length !== 0){
                var excerpt_text = '<p class="pmbcpm-toc-excerpt">' + excerpt.text() + '</p>';
            } else {
                var excerpt_text = '';
            }
            return '<div class="pmbcpm-toc-article-title-wrapper"><div class="pmbcpm-first-item"><a href="#' + href_id + '" class="pmbcpm-page-ref"></a></div><div class="pmbcpm-toc-article"><a href="#' + href_id + '" class="pmbcpm-toc-article-link">'+title_text+'</a>'+excerpt_text+'</div>'
        }
    });
    pmbcpm_add_end_icons();
    jQuery(document).on('pmb_done_processing_videos', function() {
        //pmb_resize_images(400);
        setTimeout(
            function(){
                jQuery(document).trigger('pmb_doc_conversion_ready');
            },
            1000
        );
    });
    pmb_convert_youtube_videos_to_images();
});

function pmbcpm_add_end_icons(){
    // jQuery('<b>stuff</b>').appendTo('.entry-content>p:last-of-type');
    jQuery('.entry-content>p:last-of-type').each(function(index, element){
        var html = jQuery(element).html();
        html += '<img src=" ' + pmb_design_options.article_end_icon + '" class="pmbcpm-article-end-icon">';
        jQuery(element).html(html);
    })
}

