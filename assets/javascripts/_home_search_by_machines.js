jQuery(document).ready(function($) {

    // function to happen when user changes selected input
    $('.home-search-select').on('change', function () {
        
        // get necassary info
        var itemClassList = $('.product').attr('class'),
            thisClassList = "";
            value = $(this)
                    .val()
                    .toLowerCase()
                    .replace(' ', '-')
                    .replace(' ', '-');

        // if value is 0 (filter)
        if ( value == 0 )
        {
            $('.product').show();
        } 
        else 
        {
            $('.product').hide();

            // function checks each product to see if class contains value variable
            $('.product').each(function() {

                // get current products classlist
                thisClassList = $(this).attr('class');

                // checks for class containing value name ( the  + " " stops items like m30i showing for m30 filter )
                if ( thisClassList.indexOf('product-tag-' + value + " ") > -1 || thisClassList.indexOf('product_tag-' + value + " ") > -1 )
                {
                    $(this).show();
                }
            });
        }


    });
});