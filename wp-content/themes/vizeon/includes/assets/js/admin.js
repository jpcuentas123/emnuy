(function($) {
"use strict";
    $(document).ready(function() {
        var tabBoxes = $('div[id^="gavias_metaboxes_"]');
        function gavias_setup_metatabs() {
            var gvMetaBox = $('#gaviasthemer_meta_box');
            if ( gvMetaBox.length === 0 ) {
                return;
            }
            $(tabBoxes).appendTo('#gva-meta-tabs-boxes');

            $(tabBoxes).hide().removeClass('hide-if-no-js'); 
            
            var menu_html = '<ul id="gva-meta-box-tabs-list" class="clearfix">\n';    
            var total_hidden = 0;   
            for (var i = 0, n = tabBoxes.length; i < n; i++ ) {
                var target_id = $(tabBoxes[i]).attr('id');
                var tab_name = $(tabBoxes[i]).find('.hndle > span').text();
                menu_html = menu_html + '\n<li><a href="javascript:void(0);" data-rel="#'+target_id+'">' + tab_name + '</a></li>';
            }
            menu_html = menu_html + '\n</ul>';

            $('#gva-meta-tabs-boxes').before(menu_html);
            $('#gva-meta-box-tabs-list a:first').addClass('active'); 
            $('#gva-meta-tabs-boxes > div:first').addClass('active').show();
            $('#gva-meta-box-tabs-list li').on('click', 'a', function() {
                $('#gva-meta-box-tabs-list li a').removeClass('active');
                $(tabBoxes).removeClass('active').hide();
                var target = $(this).attr('data-rel');
                $(this).addClass('active');
                $('#gva-meta-tabs-boxes ' + target).addClass('active').show(); 
            }); 
            
            //Breacrumb js
            $('.breadcrumb_setting').each(function(){
                $(this).css('display', 'none');
            })
            if($('#vizeon_breadcrumb_layout').val() == 'page_options'){
                $('.breadcrumb_setting').each(function(){
                    $(this).css('display', 'block');
                })
            }
            $('#vizeon_breadcrumb_layout').on('click', function(e){
                $('.breadcrumb_setting').each(function(){
                    $(this).css('display', 'none');
                })
               if($(this).val() == 'page_options'){
                $('.breadcrumb_setting').each(function(){
                    $(this).css('display', 'block');
                })
               }
            })
        }
        gavias_setup_metatabs(); 
    }); 
})(jQuery);