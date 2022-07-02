<?php
// SERVER URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
$fullURL = $protocol.'://'.$_SERVER['HTTP_HOST'];

// Image Path
//$emailTemplateImageDir = $fullURL.'/kelvinfactory/emailSystem/booking-details-template/images/kelvinfactory-logo.png';
$emailTemplateImageDir = 'https://kelvin-factory.netlify.app/emailSystem/booking-details-template/images/';


$bookingDateAndTimeLoop = "";
foreach ($bookingEmailArray['bookingDateAndTime'] as $value) {
	$bookingDateAndTimeLoop .= "
		<table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-3' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;' width='100%'>
			<tbody>
			<tr>
				<td>
					<table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 680px;' width='680'>
						<tbody>
						<tr>
							<td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
								<table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
									<tr>
									<td style='padding-bottom:10px;'>
										<div align='center'>
											<table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
												<tr>
												<td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #DFDFDF;'><span></span></td>
												</tr>
											</table>
										</div>
									</td>
									</tr>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
									<tr>
									<td style='padding-bottom:5px;padding-left:35px;padding-right:20px;padding-top:10px;'>
										<div style='font-family: Tahoma, Verdana, sans-serif'>
											<div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: 'Lato', Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px; color: #3a4848; line-height: 1.5;'>
											<p style='margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 24px;'><span style='font-size:16px;color:#000000;'>".getDate(strtotime($value[0]))['weekday'].', '.getDate(strtotime($value[0]))['month'].' '.getDate(strtotime($value[0]))['mday'].' '.getDate(strtotime($value[0]))['year']."</span></p>
											<p style='margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 21px;'><span style='font-size:14px;'>".$value[1]." to ".$value[2]."</span></p>
											<p style='margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 18px;'></p>
										</div>
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
	";
}


$bookingExtraPackages = "";
$extraPackageTotalPrice = 0;
foreach ($bookingEmailArray['extraPackages'] as $value) {
   $bookingExtraPackages .= "
      <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
         <tr>
            <td style='padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;'>
               <div style='color:#000000;font-size:14px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;'>
               <p style='margin: 0;'>".$value["name"]." @".$value["price"]."</p>
               </div>
            </td>
         </tr>
      </table>
   ";

   $extraPackageTotalPrice += intval($value["price"]);
}


$bookingDetailsBody = "
<!DOCTYPE html>
<html lang='en' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
   <head>
      <title></title>
      <meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
      <meta content='width=device-width, initial-scale=1.0' name='viewport'/>
      <!--[if mso]>
      <xml>
         <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            <o:AllowPNG/>
         </o:OfficeDocumentSettings>
      </xml>
      <![endif]-->
      <!--[if !mso]><!-->
      <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'/>
      <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>
      <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'/>
      <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'/>
      <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'/>
      <!--<![endif]-->
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
         @media (max-width:700px) {
         .desktop_hide table.icons-inner {
         display: inline-block !important;
         }
         .icons-inner {
         text-align: center;
         }
         .icons-inner td {
         margin: 0 auto;
         }
         .image_block img.big,
         .row-content {
         width: 100% !important;
         }
         .mobile_hide {
         display: none;
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-1' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #dcfd51;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-position: center top; color: #000000; background-color: #dcfd51; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='width:100%;padding-right:0px;padding-left:0px;padding-top:60px;'>
                                                <div align='center' style='line-height:10px'><img src='" . $emailTemplateImageDir . "kelvinfactory-logo.png' style='display: block; height: auto; border: 0; width: 110px; max-width: 100%;' width='110'/></div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:5px;padding-left:20px;padding-right:20px;padding-top:20px;'>
                                                <div style='font-family: sans-serif'>
                                                   <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: Oswald, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;'>
                                                      <p style='margin: 0; font-size: 14px; text-align: center;'><span style='font-size:18px;'><strong>" . $bookingEmailArray['studioMembershipType'] . ". ".$bookingEmailArray['studioMembershipHours']." hour studio time.</strong></span></p>
                                                      <p style='margin: 0; font-size: 14px; text-align: center;'><span style='font-size:16px;'><strong>Price - $" . $bookingEmailArray['studioMembershipPrice'] . ". Extra Package Price - $".$extraPackageTotalPrice.". Total - $".(intval($bookingEmailArray['studioMembershipPrice']) + $extraPackageTotalPrice)."</strong></span></p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:35px;padding-left:25px;padding-right:25px;padding-top:20px;'>
                                                <div style='font-family: Tahoma, Verdana, sans-serif'>
                                                   <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: 'Lato', Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px; color: #555555; line-height: 1.5;'>
                                                   <p style='margin: 0; font-size: 13px; text-align: center; mso-line-height-alt: 19.5px;'><span style='font-size:13px;'><span style=''>Dear " . $bookingEmailArray['fullName'] . ", </span><span style=''>your subscription to <strong>" . $bookingEmailArray['studioMembershipType'] . "</strong> is successful.</span></span></p>
                                                   <p style='margin: 0; font-size: 13px; text-align: center; mso-line-height-alt: 18px;'></p>
                                                </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='width:100%;padding-right:0px;padding-left:0px;'>
                                                <div align='center' style='line-height:10px'><img alt='Alternate text' class='big' src='" . $emailTemplateImageDir . "top.png' style='display: block; height: auto; border: 0; width: 680px; max-width: 100%;' title='Alternate text' width='680'/></div>
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-2' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #dcfd51;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-position: center top; color: #000000; background-color: #ffffff; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 25px; padding-right: 25px; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:30px;padding-left:10px;padding-right:10px;padding-top:30px;'>
                                                <div style='font-family: sans-serif'>
                                                   <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: Oswald, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;'>
                                                      <p style='margin: 0; font-size: 14px;'><span style='font-size:18px;'><strong><span style='color:#000000;'>Scheduled Date & Time</span></strong></span></p>
                                                   </div>
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
			   ".$bookingDateAndTimeLoop."
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-6' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-position: center top; color: #000000; background-color: #ffffff; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 25px; padding-right: 25px; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:45px;'>
                                                <div style='font-family: sans-serif'>
                                                   <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: Oswald, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;'>
                                                      <p style='margin: 0; font-size: 14px;'><span style='font-size:18px;'><strong><span style='color:#000000;'>Contact Information</span></strong></span></p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-right:10px;padding-left:10px;padding-top:20px;'>
                                                <div style='color:#6a6a6a;font-size:14px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;'>
                                                <p style='margin: 0;'>Name</p>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;'>
                                                <div style='color:#000000;font-size:14px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;'>
                                                <p style='margin: 0;'>" . $bookingEmailArray['fullName'] . "</p>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='10' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td>
                                                <div align='center'>
                                                   <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                      <tr>
                                                         <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;'><span></span></td>
                                                      </tr>
                                                   </table>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-right:10px;padding-left:10px;'>
                                                <div style='color:#6a6a6a;font-size:14px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;'>
                                                <p style='margin: 0;'>Email Address</p>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;'>
                                                <div style='color:#000000;font-size:14px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;'>
                                                <p style='margin: 0;'>" . $bookingEmailArray['email'] . "</p>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='10' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td>
                                                <div align='center'>
                                                   <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                      <tr>
                                                         <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;'><span></span></td>
                                                      </tr>
                                                   </table>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-right:10px;padding-left:10px;'>
                                                <div style='color:#6a6a6a;font-size:14px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;'>
                                                <p style='margin: 0;'>Phone Number</p>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-top:5px;padding-right:10px;padding-bottom:30px;padding-left:10px;'>
                                                <div style='color:#000000;font-size:14px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:left;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;'>
                                                <p style='margin: 0;'>" . $bookingEmailArray['phoneNumber'] . "</p>
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-6' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;' width='100%'>
               <tbody>
                  <tr>
                     <td>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-position: center top; color: #000000; background-color: #ffffff; width: 680px;' width='680'>
                           <tbody>
                              <tr>
                                 <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 25px; padding-right: 25px; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                       <tr>
                                          <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:45px;'>
                                             <div style='font-family: sans-serif'>
                                                <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: Oswald, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;'>
                                                   <p style='margin: 0; font-size: 14px;'><span style='font-size:18px;'><strong><span style='color:#000000;'>Extra Packages</span></strong></span></p>
                                                </div>
                                             </div>
                                          </td>
                                       </tr>
                                    </table>
                                    ".$bookingExtraPackages."
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-7' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 35px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='width:100%;padding-right:0px;padding-left:0px;padding-bottom:20px;'>
                                                <div align='center' style='line-height:10px'><img alt='Alternate text' class='big' src='" . $emailTemplateImageDir . "bottom.png' style='display: block; height: auto; border: 0; width: 680px; max-width: 100%;' title='Alternate text' width='680'/></div>
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-8' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #171717; color: #000000; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 15px; padding-right: 15px; padding-top: 45px; padding-bottom: 30px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;'>
                                                <div style='font-family: sans-serif'>
                                                   <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: Oswald, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #dcfd51; line-height: 1.2;'>
                                                      <p style='margin: 0; font-size: 14px; text-align: center;'><span style='font-size:22px;color:#dcfd51;'>View more on your profile</span></p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;'>
                                                <div style='font-family: Tahoma, Verdana, sans-serif'>
                                                   <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: 'Lato', Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px; color: #b8b8b8; line-height: 1.5;'>
                                                   <p style='margin: 0; font-size: 13px; text-align: center; mso-line-height-alt: 19.5px;'><span style='font-size:13px;color:#b1b1b1;'>Be updated about your membership details and track the booking date and time</span></p>
                                                   <p style='margin: 0; font-size: 13px; text-align: center; mso-line-height-alt: 19.5px;'><span style='font-size:13px;color:#b1b1b1;'>you set, on the profile 😊 created for you.</span></p>
                                                </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='button_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:10px;text-align:center;'>
                                                <div align='center'>
                                                   <!--[if mso]>
                                                   <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://www.example.com/' style='height:53px;width:167px;v-text-anchor:middle;' arcsize='19%' stroke='false' fillcolor='#292929'>
                                                      <w:anchorlock/>
                                                      <v:textbox inset='0px,5px,0px,0px'>
                                                         <center style='color:#ffffff; font-family:Tahoma, Verdana, sans-serif; font-size:14px'>
                                                            <![endif]--><a href='http://www.example.com/' style='text-decoration:none;display:inline-block;color:#ffffff;background-color:#292929;border-radius:10px;width:auto;border-top:0px solid #FFFFFF;font-weight:400;border-right:0px solid #FFFFFF;border-bottom:0px solid #FFFFFF;border-left:0px solid #FFFFFF;padding-top:15px;padding-bottom:10px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;' target='_blank'><span style='padding-left:45px;padding-right:45px;font-size:14px;display:inline-block;letter-spacing:normal;'><span style='line-height: 24px; word-break: break-word;'><span data-mce-style='font-size: 14px; line-height: 28px;' style='font-size: 14px; line-height: 28px;'>View Details</span></span></span></a>
                                                            <!--[if mso]>
                                                         </center>
                                                      </v:textbox>
                                                   </v:roundrect>
                                                   <![endif]-->
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-9' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <div class='spacer_block' style='height:50px;line-height:50px;font-size:1px;'></div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-10' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-top:50px;padding-right:25px;padding-bottom:10px;padding-left:25px;'>
                                                <div style='color:#000000;font-size:16px;font-family:Oswald, Arial, Helvetica Neue, Helvetica, sans-serif;font-weight:700;line-height:120%;text-align:center;direction:ltr;letter-spacing:0px;mso-line-height-alt:19.2px;'>
                                                   <p style='margin: 0;'><strong>Thank you for booking at Kelvin Factory. </strong></p>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td style='padding-top:10px;padding-right:25px;padding-bottom:50px;padding-left:25px;'>
                                                <div style='color:#000000;font-size:12px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;font-weight:400;line-height:120%;text-align:center;direction:ltr;letter-spacing:0px;mso-line-height-alt:14.399999999999999px;'>
                                                <p style='margin: 0; text-align: center;'>Treat yourself to an enjoying and heartfelt experience at our studio.</p>
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-11' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f3f3f3; color: #000000; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='social_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:60px;text-align:center;'>
                                                <table align='center' border='0' cellpadding='0' cellspacing='0' class='social-table' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='230px'>
                                                   <tr>
                                                      <td style='padding:0 7px 0 7px;'><a href='https://kelvinfactory.com' target='_blank'><img alt='Web Site' height='32' src='" . $emailTemplateImageDir . "website2x.png' style='display: block; height: auto; border: 0;' title='Web Site' width='32'/></a></td>
                                                      <td style='padding:0 7px 0 7px;'><a href='https://www.instagram.com/kelvinfactory/' target='_blank'><img alt='Instagram' height='32' src='" . $emailTemplateImageDir . "instagram2x.png' style='display: block; height: auto; border: 0;' title='Instagram' width='32'/></a></td>
                                                      <td style='padding:0 7px 0 7px;'><a href='#' target='_blank'><img alt='Twitter' height='32' src='" . $emailTemplateImageDir . "twitter2x.png' style='display: block; height: auto; border: 0;' title='Twitter' width='32'/></a></td>
                                                      <td style='padding:0 7px 0 7px;'><a href='#' target='_blank'><img alt='Facebook' height='32' src='" . $emailTemplateImageDir . "facebook2x.png' style='display: block; height: auto; border: 0;' title='Facebook' width='32'/></a></td>
                                                      <td style='padding:0 7px 0 7px;'><a href='#' target='_blank'><img alt='YouTube' height='32' src='" . $emailTemplateImageDir . "youtube2x.png' style='display: block; height: auto; border: 0;' title='YouTube' width='32'/></a></td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='heading_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='width:100%;text-align:center;padding-top:10px;padding-right:30px;padding-bottom:10px;padding-left:30px;'>
                                                <h3 style='margin: 0; color: #555555; font-size: 16px; font-family: Oswald, Arial, Helvetica Neue, Helvetica, sans-serif; line-height: 120%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>You can also book photoshoot appointment at KelvinShotz</span></h3>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='0' cellspacing='0' class='button_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='text-align:center;padding-top:10px;padding-right:10px;padding-bottom:40px;padding-left:10px;'>
                                                <div align='center'>
                                                   <!--[if mso]>
                                                   <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='https://kelvinshotzz.com' style='height:42px;width:148px;v-text-anchor:middle;' arcsize='10%' stroke='false' fillcolor='#191919'>
                                                      <w:anchorlock/>
                                                      <v:textbox inset='0px,0px,0px,0px'>
                                                         <center style='color:#ffffff; font-family:Tahoma, Verdana, sans-serif; font-size:15px'>
                                                            <![endif]--><a href='https://kelvinshotzz.com' style='text-decoration:none;display:inline-block;color:#ffffff;background-color:#191919;border-radius:4px;width:auto;border-top:1px solid #191919;font-weight:400;border-right:1px solid #191919;border-bottom:1px solid #191919;border-left:1px solid #191919;padding-top:5px;padding-bottom:5px;font-family:'Lato', Tahoma, Verdana, Segoe, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;' target='_blank'><span style='padding-left:40px;padding-right:40px;font-size:15px;display:inline-block;letter-spacing:normal;'><span style='font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;'><span data-mce-style='font-size: 15px; line-height: 30px;' style='font-size: 15px; line-height: 30px;'>Book Now</span></span></span></a>
                                                            <!--[if mso]>
                                                         </center>
                                                      </v:textbox>
                                                   </v:roundrect>
                                                   <![endif]-->
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-12' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 30px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:45px;'>
                                                <div align='center'>
                                                   <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                      <tr>
                                                         <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #E0E0E0;'><span></span></td>
                                                      </tr>
                                                   </table>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border='0' cellpadding='10' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                          <tr>
                                             <td>
                                                <div style='font-family: Tahoma, Verdana, sans-serif'>
                                                   <div class='txtTinyMce-wrapper' style='font-size: 12px; font-family: 'Lato', Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px; color: #a6a4a2; line-height: 1.5;'>
                                                   <p style='margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 18px;'><span style='font-size:12px;'>This message was sent to <a href='mailto:" . $bookingEmailArray['email'] . "' style='text-decoration: none; color: #a6a4a2;' title='email@example.com'>" . $bookingEmailArray['email'] . "</a></span><span style='font-size:12px;'><u><a href='" . $bookingEmailArray['email'] . "' rel='noopener' style='text-decoration: none; color: #a6a4a2;' target='_blank'></a></u></span></p>
                                                </div>
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
               <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-13' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                  <tbody>
                     <tr>
                        <td>
                           <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;' width='680'>
                              <tbody>
                                 <tr>
                                    <td class='column column-1' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                       <table border='0' cellpadding='0' cellspacing='0' class='icons_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                          <tr>
                                             <td style='vertical-align: middle; padding-bottom: 5px; padding-top: 5px; color: #9d9d9d; font-family: inherit; font-size: 15px; text-align: center;'>
                                                <table cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                   <tr>
                                                      <td style='vertical-align: middle; text-align: center;'>
                                                         <!--[if vml]>
                                                         <table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                            <![endif]-->
                                                            <!--[if !vml]><!-->
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
               </table>
        <!-- End -->
   </body>
</html>
";