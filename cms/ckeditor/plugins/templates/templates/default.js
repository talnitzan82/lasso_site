/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.addTemplates('default',{
	imagesPath:CKEDITOR.getUrl(CKEDITOR.plugins.getPath('templates')+'templates/images/'),
	
	templates:
		[
			{
				title:'Services',
				image:'template3.gif',
				description:'Template for client services page',
				html:'<p>Start Content</p><div class="IMC1"><div class="BOXP" style="background-color: #b0b0b0;	width: 185px; padding: 3px; float: left; margin-right: 1px;"><div class="BOXPT" style="background-image: url(/images/boxtbg.png);	background-repeat: repeat-x; background-position: top; height: 29px; color: #FFF; font-weight: bold; text-align: center; padding-top: 9px; font-size: 12px;	margin-bottom: 4px;">Topic 1</div><div class="BOXPC" style="background-image: url(/images/boxbg.png); background-repeat: repeat-x; background-position: top; height: 100%; padding: 10px;">Content 1</div></div><div class="BOXP" style="background-color: #b0b0b0;	width: 185px; padding: 3px; float: left; margin-right: 1px;"><div class="BOXPT" style="background-image: url(/images/boxtbg.png);	background-repeat: repeat-x; background-position: top; height: 29px; color: #FFF; font-weight: bold; text-align: center; padding-top: 9px; font-size: 12px;	margin-bottom: 4px;">Topic 2</div><div class="BOXPC" style="background-image: url(/images/boxbg.png); background-repeat: repeat-x; background-position: top; height: 100%; padding: 10px;">Content 2</div></div><div class="BOXP" style="background-color: #b0b0b0;	width: 185px; padding: 3px; float: left; margin-right: 1px;"><div class="BOXPT" style="background-image: url(/images/boxtbg.png);	background-repeat: repeat-x; background-position: top; height: 29px; color: #FFF; font-weight: bold; text-align: center; padding-top: 9px; font-size: 12px;	margin-bottom: 4px;">Topic 3</div><div class="BOXPC" style="background-image: url(/images/boxbg.png); background-repeat: repeat-x; background-position: top; height: 100%; padding: 10px;">Content 3</div></div></div>'
			},
			{
				title:'Image and Title',
				image:'template1.gif',
				description:'One main image with a title and text that surround the image.',
				html:
					'<h3><img style="margin-right: 10px" height="100" width="100" align="left"/>Type the title here</h3><p>Type the text here</p>'
			},
			{
				title:'Strange Template',
				image:'template2.gif',
				description:'A template that defines two colums, each one with a title, and some text.',
				html:'<table cellspacing="0" cellpadding="0" style="width:100%" border="0"><tr><td style="width:50%"><h3>Title 1</h3></td><td></td><td style="width:50%"><h3>Title 2</h3></td></tr><tr><td>Text 1</td><td></td><td>Text 2</td></tr></table><p>More text goes here.</p>'
			},
			{
				title:'Text and Table',
				image:'template3.gif',
				description:'A title with some text and a table.',
				html:'<div style="width: 80%"><h3>Title goes here</h3><table style="width:150px;float: right" cellspacing="0" cellpadding="0" border="1"><caption style="border:solid 1px black"><strong>Table title</strong></caption></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table><p>Type the text here</p></div>'
			}
			
		]
	}
);