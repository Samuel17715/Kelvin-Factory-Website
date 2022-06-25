<?php
// SERVER URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
$fullURL = $protocol.'://'.$_SERVER['HTTP_HOST'];

// Image Path
$emailTemplateImageDir = $fullURL.'/kelvinfactory/emailSystem/images/';

// ForgotPasswordLink
$forgotPasswordLink = $fullURL.$changePasswordLink;

$forgetPasswordBody = "
	<!DOCTYPE html>
	<html lang='en' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
	<head>
	<title></title>
	<meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
	<meta content='width=device-width, initial-scale=1.0' name='viewport'/>
	<!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
	<style>
			* {
				box-sizing: border-box;
			}

			body {
				margin: 0;
				padding: 0;
			}

			a[x-apple-data-detectors] {
				color: inherit !important;
				text-decoration: inherit !important;
			}

			#MessageViewBody a {
				color: inherit;
				text-decoration: none;
			}

			p {
				line-height: inherit
			}

			.desktop_hide,
			.desktop_hide table {
				mso-hide: all;
				display: none;
				max-height: 0px;
				overflow: hidden;
			}

			@media (max-width:520px) {
				.desktop_hide table.icons-inner {
					display: inline-block !important;
				}

				.icons-inner {
					text-align: center;
				}

				.icons-inner td {
					margin: 0 auto;
				}

				.row-content {
					width: 100% !important;
				}

				.column .border,
				.mobile_hide {
					display: none;
				}

				table {
					table-layout: fixed !important;
				}

				.stack .column {
					width: 100%;
					display: block;
				}

				.mobile_hide {
					min-height: 0;
					max-height: 0;
					max-width: 0;
					overflow: hidden;
					font-size: 0px;
				}

				.desktop_hide,
				.desktop_hide table {
					display: table !important;
					max-height: none !important;
				}
			}
		</style>
	</head>
	<body style='background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
	<table border='0' cellpadding='0' cellspacing='0' class='nl-container' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;' width='100%'>
	<tbody>
	<tr>
	<td>
	<table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-1' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tbody>
	<tr>
	<td>
	<table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 500px;' width='500'>
	<tbody>
	<tr>
	<td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 35px; padding-bottom: 30px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
	<table border='0' cellpadding='10' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tr>
	<td>
	<div style='line-height:10px'><img src='".$emailTemplateImageDir."kelvinfactory-logo.png' style='display: block; height: auto; border: 0; width: 150px; max-width: 100%;' width='150'/></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	<table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-2' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f4f4f7;' width='100%'>
	<tbody>
	<tr>
	<td>
	<table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 500px;' width='500'>
	<tbody>
	<tr>
	<td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
	<table border='0' cellpadding='0' cellspacing='0' class='heading_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tr>
	<td style='padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:35px;text-align:center;width:100%;'>
	<h1 style='margin: 0; color: #555555; direction: ltr; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; font-size: 23px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>Its okay to forget your password</span></h1>
	</td>
	</tr>
	</table>
	<table border='0' cellpadding='10' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
	<tr>
	<td>
	<div style='color:#606060;direction:ltr;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:180%;text-align:left;'>
	<p style='margin: 0;'>Hi, Samuel Owolabi, to reset your password please click the button below</p>
	</div>
	</td>
	</tr>
	</table>
	<table border='0' cellpadding='0' cellspacing='0' class='button_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tr>
	<td style='text-align:left;padding-top:35px;padding-right:10px;padding-bottom:10px;padding-left:10px;'>
	<!--[if mso]><v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' style='height:46px;width:196px;v-text-anchor:middle;' arcsize='9%' strokeweight='1.5pt' strokecolor='#bc9249' fillcolor='#bc9249'><w:anchorlock/><v:textbox inset='0px,0px,0px,0px'><center style='color:#ffffff; font-family:Tahoma, Verdana, sans-serif; font-size:14px'><![endif]-->
	<a href='".$forgotPasswordLink."'><div style='text-decoration:none;display:inline-block;color:#ffffff;background-color:#bc9249;border-radius:4px;width:auto;border-top:1px solid #bc9249;font-weight:400;border-right:1px solid #bc9249;border-bottom:1px solid #bc9249;border-left:1px solid #bc9249;padding-top:5px;padding-bottom:5px;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;'><span style='padding-left:20px;padding-right:20px;font-size:14px;display:inline-block;letter-spacing:2px;'><span style='font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;'><span data-mce-style='font-size: 14px; line-height: 28px;' style='font-size: 14px; line-height: 28px;'>RESET PASSWORD</span></span></span></div></a>
	<!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
	</td>
	</tr>
	</table>
	<table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
	<tr>
	<td style='padding-top:35px;padding-right:10px;padding-bottom:10px;padding-left:10px;'>
	<div style='color:#606060;font-size:14px;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:150%;text-align:left;direction:ltr;letter-spacing:0px;'>
	<p style='margin: 0;'>If you’re having trouble clicking the Reset password button, copy and paste the URL below into your web browser.</p>
	</div>
	</td>
	</tr>
	</table>
	<table border='0' cellpadding='10' cellspacing='0' class='heading_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tr>
	<td>
	<h3 style='margin: 0; color: #bc9249; direction: ltr; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; font-size: 13px; font-weight: 700; letter-spacing: normal; line-height: 180%; text-align: left; margin-top: 0; margin-bottom: 0;'><a href='".$forgotPasswordLink."' rel='noopener' style='text-decoration: underline; color: #bc9249;' target='_blank'>".$forgotPasswordLink."</a></h3>
	</td>
	</tr>
	</table>
	<table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
	<tr>
	<td style='padding-left:20px;padding-right:20px;padding-top:55px;'>
	<div style='color:#000000;direction:ltr;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;'>
	<p style='margin: 0; margin-bottom: 16px;'>Kelvin Factory 2022. All Rights Reserved.</p>
	<p style='margin: 0; margin-bottom: 16px;'>676 South 14th street Newark New Jersey.</p>
	<p style='margin: 0; margin-bottom: 16px;'>booking@kelvinfactory.com</p>
	<p style='margin: 0; margin-bottom: 16px;'>+1 (908) 446-4273</p>
	<p style='margin: 0; margin-bottom: 16px;'> </p>
	<p style='margin: 0;'> </p>
	</div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	<table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-3' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tbody>
	<tr>
	<td>
	<table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 500px;' width='500'>
	<tbody>
	<tr>
	<td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
	<table border='0' cellpadding='0' cellspacing='0' class='icons_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tr>
	<td style='vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;'>
	<table cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
	<tr>
	<td style='vertical-align: middle; text-align: center;'>
	<!--[if vml]><table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
	<!--[if !vml]><!-->
	<table cellpadding='0' cellspacing='0' class='icons-inner' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;'>
	<!--<![endif]-->
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table><!-- End -->
	</body>
	</html>
";