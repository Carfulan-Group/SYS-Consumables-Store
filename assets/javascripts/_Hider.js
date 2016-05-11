/**
 * Created by Sam on 10/05/2016.
 */
var ClickHider = (function () {
    function ClickHider(hideElement, triggerElement) {
        this.hideElement = hideElement;
        this.triggerElement = triggerElement;
    }
    ClickHider.prototype.hide = function () {
        var thisButNotThis = this;
        $(this.triggerElement).on('click', function () {
            $(thisButNotThis.hideElement).hide();
        });
    };
    return ClickHider;
}());
//# sourceMappingURL=_Hider.js.map