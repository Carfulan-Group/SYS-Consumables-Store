var allProducts = new Array(),
    allProductsHuman = new Array(),
    totalProducts = 0;

function getMachines ($) {
    // function for each product with a tag
    $('.product[class*=tag]').each(function(el) {

        // get list of el classes
        var theClassList = $(this).attr("class"),
            // split classlist at spaces
            classes = theClassList.split(" "),
            classesArray = new Array(),
            tag = "";

        // for each class in the list
        for ( var i = 0; i < classes.length; i++ ) {

            classesArray.push(classes[i]);

            //  if this class isn't just a space in the list and if it contains "product_tag"
            if ( i != classes.length-1 && classesArray[i].indexOf('product_tag') > -1 ) {

                    // get rid of product_tag- prefix from class
                    var thisClass = classesArray[i].replace('product_tag-','');

                    // add the new tag to allProducts, this will be used in addMachineOptions function
                    allProducts[totalProducts] = thisClass;

                    // increment product counter
                    totalProducts++;
            // end if
            }
        // end for each class in list
        }
    });
};

function removeDuplicateMachines($,list) {
    var result = [];

    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });

    return result;
}

function formatMachineNames($) {
    $.each(allProducts, function(y) {
        allProductsHuman[y] = allProducts[y]
        .replace("-", " ").replace("-", " ").replace("-", " ")
        .toLowerCase()
        .replace( /\b./g, function(a){
            return a.toUpperCase();
        });
    });
}

function addMachineOptions ($) {
    $.each(allProducts, function(i) {
        $('.home-search-select').append("<option name='" + allProductsHuman[i] + "' value='" + allProductsHuman[i] + "'>" + allProductsHuman[i] + "</option>");
    });
}


jQuery(document).ready(function($) {

    // this function gets the names of all the machines to store in "allProducts".
    // It also sets them as a data attribute for each product
    getMachines($);

    // this function remove duplicate products from allProducts
    allProducts = removeDuplicateMachines($, allProducts);

    // this function removes the "-" and capitalizes the names of the machines
    formatMachineNames($);

    // this function adds the machines to the select box, ready for the user to filter by
    addMachineOptions($);

    $('.home-search-select').on('change', function () {
        var value = $(this).val().toLowerCase().replace(" ", "-").replace(" ", "-").replace(" ", "-");

        if ( value == 0 ) {
            $('.product').show();
        } else {
            $('.product').hide();
            $('.product_tag-' + value).show();
        }
    });
});