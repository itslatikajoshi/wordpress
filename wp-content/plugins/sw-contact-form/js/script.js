jQuery(document).ready(function () {
    jQuery(".sw_new_lead_form").submit(function (e) {

        let name = jQuery(this).find(".name").val();
        let email = jQuery(this).find(".email").val();
        let mobile = jQuery(this).find(".mobile").val();
        if (name == '' || email == '' || mobile == '') {
            return false;
        } else {
            e.preventDefault();
            var formData = jQuery(this).serializeArray();
            console.log(formData);
            jQuery.ajax({
                url: ajax_object.ajax_url,
                data: {
                    data: formData,
                    action: "sw_contact_form_filter"
                }, // form data
                type: 'POST', // POST
                async: true,
                beforeSend: function (xhr) {



                },
                success: function (data) {
                    let dataRes = JSON.parse(data);

                    if (dataRes.success == true) {
                        alert("Data submited succssfully.");
                        jQuery(".sw_new_lead_form").find(".name").val('');
						jQuery(".sw_new_lead_form").find(".email").val('');
						jQuery(".sw_new_lead_form").find(".mobile").val('');
						jQuery(".sw_new_lead_form").find(".termsConditionPrivacyPolicy").prop("checked",false);
                    }

                }
            });
        }




    });

});