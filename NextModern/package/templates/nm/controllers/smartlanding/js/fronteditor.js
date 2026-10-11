function widgetUpdated(widget, result) {
    icms.modal.close();
}

function widgetsSavePositionOrderings(position){

    var list = $('#' + position);
    var id_list = [];
    var id_now = {};

    var id_list = new Array();

    if($('div.icms-widget', list).length < 1){return false;}

    $('div.icms-widget', list).each(function(){
        var id = 1;
        var bp_id = 1;
        try {
            bp_id = $(this).attr('id').slice(15);
        } catch (err) {
        }

        id_list.push({id:id, bp_id:bp_id});
        if(! +id || ! +bp_id){
            id_now[id] = true;
        }
    });
    page_id =  $("#pages").val();
    $.post("/admin/widgets/reorder", {position: position, items: id_list, page_id: page_id, template: "modern"}, function(data){
    }, 'json');

    return true;

}
function widgetEdit2(link, wid){
    var id = parseInt(link) > 0 ? link : $(link).parents('li:first').attr('bind-id');
    var edit_url = "/admin/widgets/edit";
    var template = "modern";

    icms.modal.openAjax(edit_url + '/' + id, {template:template}, function (){
        icms.modal.setCallback('close', function(){
            icms.forms.form_changed = false;
            location.reload();
        });
    });
    return false;
}
$(document).ready(function() {
    $("#cp-widgets-list .dragwidget").draggable({
        connectToSortable: positionName,
        handle: '.title',
        helper: "clone",
        zIndex: 100,
        revert: "invalid",
        classes: {
            "ui-draggable": "newwidget"
        },
        start: function (event, ui) {
            ui.helper.width(400);
            ui.helper.height(200);
            if ($('#left-quickview.open').length > 0) {
                $('#left-quickview .quickview-toggle.close').trigger('click');
            }
        },
        stop: function(e, ui) {

            var widget_dom = $(ui.helper[0]);
            widget_dom.removeAttr('style');
            var id 			= widget_dom.data('id');
            var position 	= widget_dom.parent().attr("id");
            var add_url 	= "/admin/widgets/add";
            var template 	= "modern";

            if (!position){return;}

            var page_id     = $("#pages").val();
            var data = {
                widget_id: id,
                page_id: page_id,
                position: position,
                template: template
            };

            $.post(add_url, data, function(result){

                if (result.error){
                    widget_dom.remove();
                    return;
                }
                widget_dom.attr('id','widget_wrapper_'+result.bp_id);

                widgetsSavePositionOrderings(position);
                widget_dom.data('position',position);
                widget_dom.find('span.edit').data('id', result.id);
                widget_dom.find('span.edit').data('bind-id', result.id);
                widget_dom.find('span.edit').attr('bind-id', result.id);
                widget_dom.find('span.edit').attr('data-bp_id', result.bp_id);
                widget_dom.find('span.edit').attr('data-name', result.name);
                widget_dom.removeClass('newwidget');
                widget_dom.removeClass('dragwidget');
                widgetEdit2(result.id,result.bp_id);
            }, 'json');
        }
    }).disableSelection();

    var prev = "";
    $(positionName).sortable({
        connectWith: positionName,
        handle: ".drag",
        start: function(event, ui) {
            if (ui.item[0].id){
                prev = $("#"+ui.item[0].id).parent().attr("id");
            }
        },
        stop: function(event, ui) {
            ui.item.removeAttr('style');
            if (ui.item[0].id) {
                newpos = $("#" + ui.item[0].id).parent().attr("id")
                widgetsSavePositionOrderings(newpos);
                if (newpos !== prev) {
                    widgetsSavePositionOrderings(prev);
                }
            }
        },
        update: function(event, ui) {
        }
    });
});

function widgetDeleteSmart(link){
    var id = parseInt(link) > 0 ? link : $(link).parents('li:first').attr('data-bp_id');

    if (!confirm("Удалить виджет?")){return false;}
    $(link).parent().parent().remove();

    var delete_url = "/admin/widgets/delete" + '/' + $(link).data("id");
    widget_dom = $(link);
    widget_dom.fadeOut(300, function(){
        widget_dom.remove();
    });

    $.post(delete_url, {}, function(data){
    }, 'json');
    return false;
}

$(document).ready(function() {

    $('body').css('min-height', $(window).height() - 90);
    $('.demo').css('min-height', $(window).height() - 160);

    $("#left-quickview").draggable({
        connectToSortable: "body",
        helper: "original",//clone
        handle: ".dragdiv",
        drag: function (e, ui) {

        },
        stop: function (e, ui) {
        }
    });

    $('.edit_wlinks').each(function() {
        var oncl = "return widgetDeleteSmart(this);";
        $( this ).find('.delete').attr('onclick', oncl);
        $( this ).append("<a class=\"drag btn btn-secondary btn-sm\" href=\"#\" title=\"Перенести\" > Перенести </a>");
    });
});