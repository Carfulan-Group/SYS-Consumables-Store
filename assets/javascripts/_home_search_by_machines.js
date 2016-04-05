var $                   = jQuery,
    allMachines         = Array(),
    allGroups           = "",
    groupMachines       = Array(),
    pureGroupMachines   = Array();

/*
* this function checks if the the current products current class contains "taxonomy-machines"
* it also returns the value to allMachines which will get displayed in the filter box
*/
function filterMachineClass(myClassListArray) {
    var l           = 0,
        humanClass  = "";

    /*
    * this function removes taxonomy-machines- and replaces "-" with spaces and capitalizes
    * the formatted names are then saved as humanClass...
    */
    function humanizeClass(thisClass) {
        humanClass = thisClass  .replace('taxonomy-machines-', '')
                                .split('-')
                                .join(" ")
                                .toUpperCase();
    }

    /*
    * this function checks if the current products current class contains a machine taxonomy
    * and then it does stuff with it (humanizes and then pushes to allMachines) 
    */
    function isMachineClass(thisClass) {
        if (thisClass.indexOf('taxonomy-machines') > -1){
            humanizeClass(thisClass);
            allMachines.push(humanClass);
        }
    }

    /*
    * this function loops through each class applied to each product,
    * it then uses isMachineClass() to see if it contains machine names and save them
    * to be used later
    */
    $(myClassListArray).each(function () {
        var thisClass = myClassListArray[l];
        
        isMachineClass(thisClass);

        l ++;
    });

} // end filterMachineClass();

/*
* this function gets the names of all machines the user could possible have 
* access to by looping through classlists on the product.
*/
function getMachineNames() {
    var i                   = 0,
        myClassList         = "",
        myClassListArray    = Array();

    /*
    * function to loop through each woocommerce product
    */
    $('.product').each(function() {

        /*
        * gets the current products classes to be stored in an array
        * the array gets used in the filterMachineClass function
        */
        myClassList      = $(this).attr('class');
        myClassListArray = myClassList.split(' ');

        /*
        * removes all classes that don't contain "taxonomy-machines" nad humanizes
        */
        filterMachineClass(myClassListArray);

        /*
        * increment counter
        */
        i ++;
    });

} // end getMachineNames();

/*
* this function gets all the user associated groups from .user-groups
* it then stores them in the allGroups array
*/
function getUserGroups() {
    allGroups = $('.user-groups').text();
}

/*
* this is a bad b0i, it takes the available user groups and the machines supported by products
* on the product page and compares them (removes machines users don't have access to)
* so that we can filter by "allowed machines", it then adds them to <option>'s
* in the filter by machine select box WooHoo!!!
*/
function groupMachine() {
    
    /* gets all of a users assigned groups */    
    getUserGroups();

    /* get all product-compatible machines from prodicts on the page */
    getMachineNames();

    /*
    * This function adds all machines that care contained withing user groups
    * name to the groupMachines array, all machines in groupMachines the user
    * should have access to
    */
    $(allMachines).each(function(index) {
        if ( allGroups.indexOf(allMachines[index]) > -1 ){
            groupMachines.push(allMachines[index]);
        }
    });

    /*
    * This function takes groupMachines and pushes to
    * pureGroupMachines whilst removing duplicate machines
    */
    $.each(groupMachines, function(i, el){
        if($.inArray(el, pureGroupMachines) === -1) pureGroupMachines.push(el);
    });
}

/*
* This function appends the purified machines names to the select option
*/
function displayMachines () {
    $(pureGroupMachines).each(function(index){
        var m = pureGroupMachines[index];
        $('.home-search-select').append('<option value="' + m + '">' + m + '</option>')
    });
}

function filterByMachine () {
    var value = "",
    classes = "";

    $('.home-search-select').on('change', function () {
        value = $(this).val().toLowerCase().replace(/ /g , "-");
        
        if ( value == 0 ) {

            $('.product').show();

        } else {

            $('.product').hide();

            $('.product').each(function () {
                classes = $(this).attr('class');
                
                if ( classes.indexOf(value) > -1 ) {
                    $(this).show();
                }
            });

        }
    });
}

/*
* calls functions once the DOM is ready
*/
document.addEventListener('DOMContentLoaded', function() {
    
    /*
    * Gets a list of all available machines and sorts them
    * to machines the user has access to (and removes duplicates)
    */
    groupMachine();

    /*
    * Displays the machines from above (stored in pureGroupMachines)
    * and outputs them to <options> in .home-search-select
    */
    displayMachines();

    /*
    * adds functionality to allow users to filter products by machines
    * from pureGroupMachines on the home product page
    */
    filterByMachine();
});