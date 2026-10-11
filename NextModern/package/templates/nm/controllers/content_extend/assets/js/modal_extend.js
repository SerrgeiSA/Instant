$(function(){

    $(document).on('click', modal_selector, function(e){
       e.preventDefault();

       var _this = $(this);

       new Custombox.modal({
           content: {
               effect: 'fadein',
               close: true,
               target: _this.attr('href')
           }
       }).open();

    });
    document.addEventListener('custombox:content:open', function() {
        const ps = new PerfectScrollbar('.custombox-modal .inner', {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    });

});