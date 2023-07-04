jQuery(document).ready(function () {
    // Get the button that opens the modal
    jQuery(".video_title").click(function () {
        jQuery(this).parents('.video_wrapper').find(".modal").show();
    });
    jQuery("span.close").click(function () {
        jQuery(this).parents('.video_wrapper').find(".modal").hide();
        jQuery(this).parents('.video_wrapper').find("iframe").attr("src", jQuery(this).parents('.video_wrapper').find("iframe").attr("src"));
    });
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target.className == 'modal') {
            jQuery("span.close").trigger("click");
        }
    }


    jQuery("li#menu-item-25").click(function () {
        jQuery('p.video_title').trigger('click');
    });


    jQuery("a.state_name").click(function () {
        let state = jQuery(this).text().trim();
        jQuery(this).parents(".sw_ajax_search_form_wrap").find('.input[name="state"]').val(state);
    });





    jQuery.ajax({
        url: ajax_object.ajax_url,
        data: {
            statesList: true,
            action: "the_event_filter"
        }, // form data
        type: 'POST', // POST
        async: true,
        beforeSend: function (xhr) {



        },
        success: function (data) {
            console.log(data);

            jQuery(".select_state").selectize({
                plugins: ["restore_on_backspace", "clear_button"],
                delimiter: " - ",
                persist: false,
                maxItems: null,
                valueField: "value",
                labelField: "name",
                searchField: ["name", "value"],
                placeholder: 'Search State',
                maxItems: 1,
                onChange: function (value) {
                    console.log(value);
                    if (value != '') {
                        jQuery(this).parents(".form-inline event_search_form").find('input[type="text"]').show();
                    }
                    else {
                        jQuery(this).parents(".form-inline event_search_form").find('input[type="text"]').hide();
                    }
                },
                options: JSON.parse(data),
            });

        }
    });



    jQuery('.loder_img').hide();
    jQuery('.event_search_form').submit(function () {
        let outerDiv = jQuery(this).parents(".sw_ajax_search_form_wrap");
        jQuery.ajax({
            url: ajax_object.ajax_url,
            data: jQuery(this).serialize(), // form data
            type: jQuery(this).attr('method'), // POST
            async: true,
            beforeSend: function (xhr) {
                // console.log($(this).closest('.sw_ajax_search_form_wrap'));
                outerDiv.find('.loder_img').show(); // changing the button label
                outerDiv.find('.response').hide();


            },
            success: function (data) {
                // console.log(data);
                outerDiv.find('.response').show();
                outerDiv.find('.response').html(data); // insert data
                outerDiv.find('.loder_img').hide();
            }
        });
        return false;
    });



});

