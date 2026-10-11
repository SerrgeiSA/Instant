var currentDocument = null;
var timerSave = 2000;
var demoHtml = $('.demo').html();

$(window).resize(function(){$('body').css('min-height',$(window).height()-90);
	$('.demo').css('min-height',$(window).height()-160);
});


function widgetEdit2(link){
	var id = parseInt(link) > 0 ? link : $(link).parents('li:first').attr('bind-id');
	var edit_url = $('#cp-widgets-layout').data('edit-url');
	var template = $('#cp-widgets-layout').data('template');
	icms.modal.openAjax(edit_url + '/' + id, {template:template}, function (){
		icms.modal.setCallback('close', function(){
			icms.forms.form_changed = false;
			var position = $('#widget'+id).data('position');
			$.post('smartlanding/getwidget', {uri:"",position:position},function(result){

				if (result.error){
					return;
				}
				$('#widget'+id +" .widgetcontent").html(result.content);
			}, 'json');
		});
	});
	return false;
}


$(document).ready(function() {
	
	$('body').css('min-height',$(window).height()-90);
	$('.demo').css('min-height',$(window).height()-160);
	
	/* sortables */
	$( ".demo, .demo .column" ).sortable({
		connectWith: '.column',
		opacity : 0.35,
		handle: ".drag"
	});

	/* drag and drop rows */
	$( ".sidebar-nav .lyrow" ).draggable({
		connectToSortable: ".demo",
		helper: "clone",
		handle: ".drag",
		drag: function(e, ui) {
			ui.helper.width(400);
		},
		stop: function( e, ui ) {
			$('.demo .column').sortable({ 
				opacity : 0.35,
				connectWith: '.column'
			});
		}
	});
	
	/* drag and drop boxes */
	$( ".sidebar-nav .box" ).draggable({
		connectToSortable: ".column",
		helper: "clone",
		handle: ".drag",
		drag: function(e, ui) {
			ui.helper.width(400);
		},
		stop: function(e, ui) {
			if (ui.helper.hasClass('wbox')) {

				var widget_dom = $('.demo .newwidget');

				var id 			= widget_dom.data('id');
				var position 	= 'nomatter'+randomNumber();
				var add_url 	= $('#cp-widgets-layout').data('add-url');
				var template 	= $('#cp-widgets-layout').data('template');

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

					widget_dom.attr('id','widget'+result.id);
					widget_dom.data('position',position);
					widget_dom.find('span.edit').data('id', result.id);
					widget_dom.find('span.edit').data('bind-id', result.id);
					widget_dom.find('span.edit').attr('bind-id', result.id);
					widget_dom.find('span.edit').attr('data-bp_id', result.bp_id);
					widget_dom.find('span.edit').attr('data-name', result.name);
					widget_dom.removeClass('newwidget');
					widgetEdit2(result.id);


				}, 'json');


			}
			handleJsIds();
		}
	});

	/* fin drageable sortable  */
	$('body').on('click', '#button-download-modal', function(e){
		e.preventDefault();
		downloadLayoutSrc();
	});

	$('body').on('click', '#download', function(){
		downloadLayout();
		return false;
	});

	$('body').on('click', '#downloadhtml', function(){
		downloadHtmlLayout();
		return false;
	});

	$('#edit').click(function(){
		$('body').removeClass('devpreview sourcepreview');
		$('body').addClass('edit');
		
		removeMenuClasses();
		
		$(this).addClass('active');

		return false;
	});

	$('#clear').click(function(e) {
		e.preventDefault();
		clearDemo();
	});

	$('#devpreview').click(function(){
		$('body').removeClass('edit sourcepreview');
		$('body').addClass('devpreview');

		removeMenuClasses();

		$(this).addClass('active');

		return false;
	});
	
	$('#sourcepreview').click(function(){
		$('body').removeClass('edit');
		$('body').addClass('devpreview sourcepreview');
		removeMenuClasses();
		$(this).addClass('active');
		return false;
	});
	

	$(document).on('hidden.bs.modal', function (e) {
	    $(e.target).removeData('bs.modal');
	});

	$('body').on('click', '#continue-share-non-logged', function () {
   		 $('#share-not-logged').hide();
		 $('#share-logged').removeClass('hide');
    	 $('#share-logged').show();
	});

	$('body').on('click', '#continue-download-non-logged', function () {
   		 $('#download-not-logged').hide();
		 $('#download').removeClass('hide');
		 $('#download').show();
		 $('#downloadhtml').removeClass('hide');
		 $('#downloadhtml').show();
		 $('#download-logged').removeClass('hide');
    	 $('#download-logged').show();
	});

	$('.btn-hire-header-builder').click(function(){
		ga('send', 'event', 'hire', 'builder-header');
	});

	$('body').on('click', '[data-toggle="modal"]', function(){
    	$($(this).data("target")+' .modal-content').load($(this).attr('href'));
    });
	
	$('.nav-header').click(function(){
		$('.sidebar-nav .boxes, .sidebar-nav .rows').hide();
		$(this).next().slideDown();	
	});

	removeElm();
	configurationElm();
	gridSystemGenerator();
	
	setInterval(function() {
		handleSaveLayout();
	}, timerSave);
});

function handleSaveLayout(){
	var currentDocument = $('.demo').html();
	if(currentDocument != window.demoHtml) {
		saveLayout();
		window.demoHtml = currentDocument;
	}
}

function handleJsIds(){
	handleModalIds();
	handleAccordionIds();
	handleCarouselIds();
	handleTabsIds();
}

function handleAccordionIds(){
	var elm = $('.demo #myAccordion');	
	var random = randomNumber();
	var elmId = 'panel-' + random;
	var accordionElementId;
	elm.attr('id', elmId);

	elm.find('.panel').each(function(current,element){
		accordionElementId = 'panel-element-' + randomNumber();

		$(element).find('.panel-title').each(function(toggleCurrent,toggleElement){
			$(toggleElement).attr('data-parent', '#' + elmId);
			$(toggleElement).attr('href', '#' + accordionElementId);
		});

		$(element).find('.panel-collapse').each(function(bodyCurrent,bodyElement){
			$(bodyElement).attr('id', accordionElementId);
		});
	});

	// Handler for V4
	var elm = $('.demo #accordionV4');
	var random = randomNumber();
	var elmId = 'card-' + random;
	var accordionElementId;
	elm.attr('id', elmId);

	elm.find('.card').each(function(current,element){
		accordionElementId = 'card-element-' + randomNumber();

		$(element).find('.card-link').each(function(toggleCurrent,toggleElement){
			$(toggleElement).attr('data-parent', '#' + elmId);
			$(toggleElement).attr('href', '#' + accordionElementId);
		});

		$(element).find('.collapse').each(function(bodyCurrent,bodyElement){
			$(bodyElement).attr('id', accordionElementId);
		});
	});
}

function handleCarouselIds(){
	var elm = $('.demo #myCarousel');	
	var random = randomNumber();
	var elmId = 'carousel-' + random;

	elm.attr('id', elmId);

	elm.find('.carousel-indicators li').each(function(current,element){
		$(element).attr('data-target', '#' + elmId);
	});
	// Bootstrap v3
	elm.find('.left').attr('href','#' + elmId)
	elm.find('.right').attr('href','#' + elmId);

	// Bootstrap v4
	elm.find('.carousel-control-prev').attr('href','#' + elmId)
	elm.find('.carousel-control-next').attr('href','#' + elmId);
}

function handleModalIds(){
	var elm = $('.demo #myModalLink');	
	var random = randomNumber();
	var containerId = 'modal-container-' + random;
	var elmId = 'modal-' + random;

	elm.attr('id', elmId);
	elm.attr('href', '#' + containerId);
	elm.next().attr('id', containerId);
}

function handleTabsIds(){
	var elm = $('.demo #myTabs');	
	var random = randomNumber();
	var elmId = 'tabs-' + random;

	elm.attr('id', elmId);

	elm.find('.tab-pane').each(function(current,element){
		var paneId = $(element).attr('id');
		var paneIdNew = 'panel-'+randomNumber();

		$(element).attr('id', paneIdNew);
		$(element).parent().parent().find('a[href=#'+paneId+']').attr('href', '#' + paneIdNew);		
	});
}

function randomNumber(){
	return randomFromInterval(1,1000000);
}

function randomFromInterval(from,to){
    return Math.floor(Math.random()*(to-from+1)+from);
}

function gridSystemGenerator() {
	$('.lyrow .preview input').bind('keyup',function(){
		var sum = 0;
		var src = '';
		var invalidValues = false;
		var cols = $(this).val().split(" ",12);
		$.each(cols, function(index,value){
			if(!invalidValues) {
				if(parseInt(value) <= 0) invalidValues = true;
				sum = sum + parseInt(value)
				src += '<div class="col-md-'+value+' column"></div>';
			}
		});
		if(sum==12 && !invalidValues) { 
			$(this).parent().next().children().html(src);
			$(this).parent().prev().show();
		} else {
			$(this).parent().prev().hide();
		}
	});
}

function configurationElm(elmToggle, elmMenu) {

	$('.demo').on('click', '.configuration > a', function(e){
		e.preventDefault();
		var currentViewObj;
		var view = $(this).parent().next().next()
		if ($(this).data('class')) {
			currentViewObj = view.find('.'+$(this).data('class'));
		} else {
			currentViewObj = view.children();
		}
		$(this).toggleClass('active');
		currentViewObj.toggleClass($(this).attr('rel'));
	});

	$('.demo').on('click', '.configuration .dropdown-menu a', function(e){
		e.preventDefault();
		var currentClassesObj = $(this).parent();
		var currentViewObj = currentClassesObj.parent().parent().next().next().children();

		currentClassesObj.find('li').removeClass('active');
		$(this).parent().addClass('active');
	
		var removeClasses = "";
		currentClassesObj.find('a').each(function(){
			removeClasses += $(this).attr('rel')  + " ";
		});

		currentClassesObj.parent().removeClass('open');
	
		currentViewObj.removeClass(removeClasses);
		currentViewObj.addClass($(this).attr('rel'));
	});
}

function removeElm() {
	$('.demo').on('click', '.remove', function(e) {
		e.preventDefault();
		$(this).parent().remove();
		if(!$('.demo .lyrow').length > 0) { 
			clearDemo();
		}
	});
}

function clearDemo() {
	$('.demo').empty();
}
function removeMenuClasses(){
	$('#menu-layoutit li button').removeClass('active');
}

function changeStructure(oldClass, newClass) {
	$('#download-layout .'+oldClass).removeClass(oldClass).addClass(newClass);
}

function cleanHtml(elm) {
	$(elm).parent().append($(elm).children().html());
}

function downloadLayoutSrc() {
	var src = '';

	$('#download-layout').children().html($('.demo').html());

	var downloadContent = $('#download-layout').children();

	downloadContent.find('.preview, .configuration, .drag, .remove').remove();
	downloadContent.find('.lyrow').addClass('removeClean');
	downloadContent.find('.box-element').addClass('removeClean');

	downloadContent.find('.lyrow .lyrow .lyrow .lyrow .lyrow .removeClean').each(function(){ cleanHtml(this) });
	downloadContent.find('.lyrow .lyrow .lyrow .lyrow .removeClean').each(function(){ cleanHtml(this) });
	downloadContent.find('.lyrow .lyrow .lyrow .removeClean').each(function(){ cleanHtml(this) });
	downloadContent.find('.lyrow .lyrow .removeClean').each(function(){ cleanHtml(this) });
	downloadContent.find('.lyrow .removeClean').each(function(){ cleanHtml(this) });
	downloadContent.find('.removeClean').each(function(){ cleanHtml(this) });

	downloadContent.find('.removeClean').remove();
	
	$('#download-layout .column').removeClass('ui-sortable');	
	downloadContent.find('.column').removeClass('column');

	if($('#download-layout .container').length > 0) {
		changeStructure('row-fluid','row');
	}

	formatSrc = $.htmlClean($('#download-layout').html(), {
		format:true, 
		allowedAttributes:[
			['id'], ["class"], ['data-toggle'], ['data-target'], ['data-parent'], ['role'], ['data-dismiss'], ['aria-labelledby'],
			['aria-hidden'], ['data-slide-to'], ['data-slide']
		] 
	});

	$('#download-layout').html(formatSrc);
	$('.downloadModal textarea').empty();
	$('.downloadModal textarea').val(formatSrc);
}
