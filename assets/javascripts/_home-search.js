function itemSearch(el) {

    var search = {
        input   : el.value.toLowerCase(),
        product : document.querySelectorAll('.product'),
        title   : document.querySelectorAll('.home-cat-container h2')
    };

    // show all products and search.titles if search is empty
    if (!search.input) {
        Array.prototype.forEach.call(search.product, function(el) {
            el.style.display = "block";
        });

    // end if input is empty
    } else {
        Array.prototype.forEach.call(search.product, function(el) {
            var h3Content = el.querySelector("h3").innerHTML.toLowerCase();

            if (h3Content.indexOf(search.input)) {
                el.style.display = "none";
            } else {
                el.style.display = "block";
            }
        });

    // end if input val > 0
    }

// end itemSearch()
}