<?php
// SERVER URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
$fullURL = $protocol.'://'.$_SERVER['HTTP_HOST'];

// Image Path
//$emailTemplateImageDir = $fullURL.'/kelvinfactory/emailSystem/otp-template/images/';
$emailTemplateImageDir = 'https://kelvin-factory.netlify.app/emailSystem/otp-template/images/';

$otpBody = " 
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
                                          <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                             <tr>
                                                <td style='width:100%;padding-right:0px;padding-left:0px;'>
                                                   <div align='center' style='line-height:10px'><img src='".$emailTemplateImageDir."kelvinfactory-logo.png' style='display: block; height: auto; border: 0; width: 100px; max-width: 100%;' width='100'/></div>
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
                                                <td style='text-align:center;width:100%;padding-top:50px;'>
                                                   <h1 style='margin: 0; color: #555555; direction: ltr; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; font-size: 23px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>Hey ".$firstName.",</span></h1>
                                                </td>
                                             </tr>
                                          </table>
                                          <table border='0' cellpadding='0' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                             <tr>
                                                <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px;'>
                                                   <div style='color:#000000;direction:ltr;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:180%;text-align:center;'>
                                                      <p style='margin: 0;'>Thanks for creating a membership account with us. We hope you will fully enjoy the fantastic services reserved for you.</p>
                                                   </div>
                                                </td>
                                             </tr>
                                          </table>
                                          <table border='0' cellpadding='0' cellspacing='0' class='heading_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                             <tr>
                                                <td style='text-align:center;width:100%;padding-top:35px;'>
                                                   <h1 style='margin: 0; color: #555555; direction: ltr; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; font-size: 23px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>Copy the OTP Below</span></h1>
                                                </td>
                                             </tr>
                                          </table>
                                          <table border='0' cellpadding='0' cellspacing='0' class='heading_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                             <tr>
                                                <td style='padding-bottom:30px;padding-left:30px;padding-right:30px;padding-top:45px;text-align:center;width:100%;'>
                                                   <h1 style='margin: 0; color: #000000; direction: ltr; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; font-size: 40px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;'><span class='tinyMce-placeholder'>".$otpCode."</span></h1>
                                                </td>
                                             </tr>
                                          </table>
                                          <table border='0' cellpadding='10' cellspacing='0' class='paragraph_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                             <tr>
                                                <td>
                                                   <div style='color:#000000;direction:ltr;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;'>
                                                      <p style='margin: 0; margin-bottom: 16px;'>Kelvin Factory 2022. All Rights Reserved.</p>
                                                      <p style='margin: 0; margin-bottom: 16px;'>676 South 14th street Newark New Jersey.</p>
                                                      <p style='margin: 0; margin-bottom: 16px;'>booking@kelvinfactory.com</p>
                                                      <p style='margin: 0; margin-bottom: 16px;'>+1 (908) 446-4273</p>
                                                      <p style='margin: 0; margin-bottom: 16px;'> </p>
                                                      <p style='margin: 0;'> </p>
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
                                                            <!--[if vml]>
                                                            <table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                               <![endif]-->
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
                  </table>
               <!-- End -->
      </body>
   </html>
   ";