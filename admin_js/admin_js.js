jQuery(function($){
       $(document).ready(function() {
			// for background logo;
			$('#logo_image_url').click(function() {

				var logo_imag = wp.media({
					title:'Select Logo Image',
					library: {type: 'image'},
					multiple: false,
					button: { text: 'Insert'}
				});

				logo_imag.on('select', function() {
					var logo_selection = logo_imag.state().get('selection').first().toJSON();
					for(prop in logo_selection){
						console.log(prop);
					}
					$('#logo_image').val(logo_selection.url);
				});

				logo_imag.open();
			}); 

			// for login logo;
			$('#logo_image_url_1').click(function() {

				var logo_imag = wp.media({
					title:'Select Logo Image',
					library: {type: 'image'},
					multiple: false,
					button: { text: 'Insert'}
				});

				logo_imag.on('select', function() {
					var logo_selection = logo_imag.state().get('selection').first().toJSON();
					for(prop in logo_selection){
						console.log(prop);
					}
					$('#logo_image_1').val(logo_selection.url);
				});

				logo_imag.open();
			}); 
		});
	});

$(function() {

function myTheme_calculateImageSelectOptions(attachment, controller) {

    var control = controller.get( 'control' );

    var flexWidth = !! parseInt( control.params.flex_width, 10 );
    var flexHeight = !! parseInt( control.params.flex_height, 10 );

    var realWidth = attachment.get( 'width' );
    var realHeight = attachment.get( 'height' );

    var xInit = parseInt(control.params.width, 10);
    var yInit = parseInt(control.params.height, 10);

    var ratio = xInit / yInit;

    controller.set( 'canSkipCrop', ! control.mustBeCropped( flexWidth, flexHeight, xInit, yInit, realWidth, realHeight ) );

    var xImg = xInit;
    var yImg = yInit;

    if ( realWidth / realHeight > ratio ) {
        yInit = realHeight;
        xInit = yInit * ratio;
    } else {
        xInit = realWidth;
        yInit = xInit / ratio;
    }        

    var x1 = ( realWidth - xInit ) / 2;
    var y1 = ( realHeight - yInit ) / 2;        

    var imgSelectOptions = {
        handles: true,
        keys: true,
        instance: true,
        persistent: true,
        imageWidth: realWidth,
        imageHeight: realHeight,
        minWidth: xImg > xInit ? xInit : xImg,
        minHeight: yImg > yInit ? yInit : yImg,            
        x1: x1,
        y1: y1,
        x2: xInit + x1,
        y2: yInit + y1
    };

    return imgSelectOptions;
}  

function myTheme_setImageFromURL(url, attachmentId, width, height) {
    var choice, data = {};

    data.url = url;
    data.thumbnail_url = url;
    data.timestamp = _.now();

    if (attachmentId) {
        data.attachment_id = attachmentId;
    }

    if (width) {
        data.width = width;
    }

    if (height) {
        data.height = height;
    }

    $("#heading_picture").val( url );
    $("#heading_picture_preview").prop("src", url);        

}

function myTheme_setImageFromAttachment(attachment) {

    $("#heading_picture").val( attachment.url );
    $("#heading_picture_preview").prop("src", attachment.url);             

}

var mediaUploader;

$("#btn_heading_picture").on("click", function(e) {

    e.preventDefault(); 

    /* We need to setup a Crop control that contains a few parameters
       and a method to indicate if the CropController can skip cropping the image.
       In this example I am just creating a control on the fly with the expected properties.
       However, the controls used by WordPress Admin are api.CroppedImageControl and api.SiteIconControl
    */

   var cropControl = {
       id: "control-id",
       params : {
       	 //flex_width : false,  // set to true if the width of the cropped image can be different to the width defined here
         //flex_height : false, // set to true if the height of the cropped image can be different to the height defined here
         width : 40,  // set the desired width of the destination image here
         height : 40, // set the desired height of the destination image here
       }
   };

   cropControl.mustBeCropped = function(flexW, flexH, dstW, dstH, imgW, imgH) {

    // If the width and height are both flexible
    // then the user does not need to crop the image.

    if ( true === flexW && true === flexH ) {
        return false;
    }

    // If the width is flexible and the cropped image height matches the current image height, 
    // then the user does not need to crop the image.
    if ( true === flexW && dstH === imgH ) {
        return false;
    }

    // If the height is flexible and the cropped image width matches the current image width, 
    // then the user does not need to crop the image.        
    if ( true === flexH && dstW === imgW ) {
        return false;
    }

    // If the cropped image width matches the current image width, 
    // and the cropped image height matches the current image height
    // then the user does not need to crop the image.               
    if ( dstW === imgW && dstH === imgH ) {
        return false;
    }

    // If the destination width is equal to or greater than the cropped image width
    // then the user does not need to crop the image...
    if ( imgW <= dstW ) {
        return false;
    }

    return true;        

   };      

    /* NOTE: Need to set this up every time instead of reusing if already there
             as the toolbar button does not get reset when doing the following:

            mediaUploader.setState('library');
            mediaUploader.open();

    */       

    mediaUploader = wp.media({
        button: {
            text: 'Select and Crop', // l10n.selectAndCrop,
            close: false
        },
        states: [
            new wp.media.controller.Library({
                title:     'Select and Crop', // l10n.chooseImage,
                library:   wp.media.query({ type: 'image' }),
                multiple:  false,
                date:      false,
                priority:  20,
                suggestedWidth: 300,
                suggestedHeight: 200
            }),
            new wp.media.controller.CustomizeImageCropper({ 
                imgSelectOptions: myTheme_calculateImageSelectOptions,
                control: cropControl
            })
        ]
    });

    mediaUploader.on('cropped', function(croppedImage) {

        var url = croppedImage.url,
            attachmentId = croppedImage.attachment_id,
            w = croppedImage.width,
            h = croppedImage.height;

            myTheme_setImageFromURL(url, attachmentId, w, h);            

    });

    mediaUploader.on('skippedcrop', function(selection) {

        var url = selection.get('url'),
            w = selection.get('width'),
            h = selection.get('height');

            myTheme_setImageFromURL(url, selection.id, w, h);            

    });        

    mediaUploader.on("select", function() {

        var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();

        if (     cropControl.params.width  === attachment.width 
            &&   cropControl.params.height === attachment.height 
            && ! cropControl.params.flex_width 
            && ! cropControl.params.flex_height ) {
                myTheme_setImageFromAttachment( attachment );
            mediaUploader.close();
        } else {
            mediaUploader.setState( 'cropper' );
        }

    });

    mediaUploader.open();

});
});