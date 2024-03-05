
<!-- here is my code -->
<!DOCTYPE html>
<html
  lang="en"
  xmlns="http://www.w3.org/1999/xhtml"
  xmlns:v="urn:schemas-microsoft-com:vml"
  xmlns:o="urn:schemas-microsoft-com:office:office"
>
  <head>
    <meta charset="utf-8" />
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width" />
    <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting" />
    <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>your task {{$title}} Mark As Completed :) </title>
    <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&family=Roboto:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- CSS Reset : BEGIN -->
    <style>
      html,
      body {
        margin: 0 auto !important;
        padding: 0 !important;
        height: 100% !important;
        width: 100% !important;
        background: #f1f1f1;
      }

      /* What it does: Stops email clients resizing small text. */
      * {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      /* What it does: Centers email on Android 4.4 */
      div[style*="margin: 16px 0"] {
        margin: 0 !important;
      }

      /* What it does: Stops Outlook from adding extra spacing to tables. */
      table,
      td {
        mso-table-lspace: 0pt !important;
        mso-table-rspace: 0pt !important;
      }

      /* What it does: Fixes webkit padding issue. */
      table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
        margin: 0 auto !important;
      }

      /* What it does: Uses a better rendering method when resizing images in IE. */
      img {
        -ms-interpolation-mode: bicubic;
      }

      /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
      a {
        text-decoration: none;
      }

      /* What it does: A work-around for email clients meddling in triggered links. */
      *[x-apple-data-detectors],  /* iOS */
.unstyle-auto-detected-links *,
.aBn {
        border-bottom: 0 !important;
        cursor: default !important;
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
      }

      /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
      .a6S {
        display: none !important;
        opacity: 0.01 !important;
      }

      /* What it does: Prevents Gmail from changing the text color in conversation threads. */
      .im {
        color: inherit !important;
      }

      /* If the above doesn't work, add a .g-img class to any image in question. */
      img.g-img + div {
        display: none !important;
      }

      /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
      /* Create one of these media queries for each additional viewport size you'd like to fix */

      /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
      @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
        u ~ div .email-container {
          min-width: 320px !important;
        }
      }
      /* iPhone 6, 6S, 7, 8, and X */
      @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
        u ~ div .email-container {
          min-width: 375px !important;
        }
      }
      /* iPhone 6+, 7+, and 8+ */
      @media only screen and (min-device-width: 414px) {
        u ~ div .email-container {
          min-width: 414px !important;
        }
      }
    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>
      .bg_white {
        background: #fcfcfc;
      }
      .bg_dark {
        background: #e3f3fa;
      }
      .email-section {
        padding: 1.5em;
      }

      .email-sections {
        padding: 0 2.5em;
      }

      /*BUTTON*/
      .btn {
        padding: 10px 15px;
      }
      .btn.btn-primary {
        border-radius: 30px;
        background: #f3a333;
        color: #ffffff;
      }

      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        color: #000000;
        margin-top: 0;
      }

      body {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-size: 15px;
        line-height: 1.8;
        color: rgba(0, 0, 0, 0.4);
      }

      a {
        color: #ffffff;
      }

      .enroll-now {
        background-color: #f68b29;
        max-width: 25rem;
        margin: 0 auto !important;
        font-size: 18px;
        padding: 7px 20px;
        color:#fff !important;
        border-radius: 9px;
        color:#fff !important;
      }

      /*LOGO*/

      .logo h1 {
        margin: 0;
      }
      .logo h1 a {
        font-weight: 700;
        text-transform: uppercase;
      }

      /*HERO*/

      .hero .text {
        color: rgba(255, 255, 255, 0.8);
      }
      .hero .text h2 {
        color: #ffffff;
        font-size: 30px;
        margin-bottom: 0;
      }

      .heading-section-white {
        color: rgba(255, 255, 255, 1);
      }
      .heading-section-white h2 {
        font-size: 28px;
        line-height: 1;
        padding-bottom: 0;
      }

      .heading-section-white h2 {
        color: #ffffff;
      }
      .heading-section-white .subheading {
        margin-bottom: 0;
        display: inline-block;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #ffffff;
        font-weight: 500;
      }

      .icon {
        text-align: center;
      }

      /*SERVICES*/
      .text-services {
        padding: 10px 10px 0;
        text-align: center;
      }
      .text-services h3 {
        font-size: 20px;
      }

      /*BLOG*/
      .text-services .meta {
        text-transform: uppercase;
        font-size: 14px;
      }

      /*COUNTER*/
      .counter-text {
        text-align: center;
      }

      @media screen and (max-width: 500px) {
        .icon {
          text-align: left;
        }

        .text-services {
          padding-left: 0;
          padding-right: 20px;
          text-align: left;
        }

        .hero {
          height: 129px;
        }
      }
    </style>
  </head>

  <body
    width="600"
    style="
      margin: 0;
      padding: 0 !important;
      mso-line-height-rule: exactly;
      background-color: ##d8d8d8;
    "
  >
  <td>
    <tr style="
      height:1rem;
    ">
    </tr>
  </td>
    <center style="width: 100%; background-color: #f1f1f1">
      <div
        style="
          display: none;
          font-size: 1px;
          max-height: 0px;
          max-width: 0px;
          opacity: 0;
          overflow: hidden;
          mso-hide: all;
          font-family: sans-serif;
        "
      >
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
      </div>
      <div style="width: 600px; margin: 0 auto" class="email-container">
        <!-- BEGIN BODY -->
        <table
          align="center"
          role="presentation"
          cellspacing="0"
          cellpadding="0"
          border="0"
          width="600"
          style="margin: auto"
        >
          <tr>
            <td
              class="bg_white logo"
              style="padding: 0.5em 2.5em; text-align: center"
            >
              <h1>
                <a href="#"
                  ><img
                    src="https://skills.ixambee.com/v5/images/mailer_2/ixambee_new_logo.png"
                    height="70"
                    width="140"
                /></a>
              </h1>
            </td>
          </tr>
          <!-- end tr -->

          <tr>
            <td class="bg_white">
              <div
                class="heading-section"
                style="text-align: center; padding: 0 30px"
              >
                <h2 style="font-size: 20px">Complete Task:</h2>
              
                <p
                  style="
                    font-size: 16px;
                    line-height: 1.4;
                    color: #272727;
                    margin-top: 1px;
                  "
                >
                {{$title}}
                </p>
              </div>
            </td>
          </tr>

          <tr>
            <td
              valign="middle"
              style="
                background-color: #fcfcfc;
                text-align: center;
                padding: 1rem 0;
              "
              class="hero"
            >
              <img
                src="https://static.ixambee.com/v5/assets/images/task.png"
                alt=""
              />
            </td>
          </tr>
          <!-- end tr -->

          <tr>
            <td class="bg_white">
              <div
                class="heading-section"
                style="text-align: center; padding: 0 30px"
              >
                <p
                  style="
                    font-size: 22px;
                    color: #050b87;
                    margin-top: 1px;
                    margin-bottom: 3px;
                  "
                >
                  Due Date: {{$due_date}}
                </p>
              </div>
            </td>
          </tr>

          <tr>
            <td class="bg_white">
              <div
                class="heading-section"
                style="text-align: center; padding: 0 30px"
              >
                <h2 style="font-size: 20px">Task Description:</h2>
              </div>
            </td>
          </tr>

          <tr>
            <td class="bg_white">
              <table
                role="presentation"
                cellspacing="0"
                cellpadding="0"
                border="0"
                width="100%"
              >
                <tr>
                  <td class="bg_dark email-section" style="text-align:left">
                    <div class="heading-section" style="color: #5b6164">
                      <p style="text-align: left; line-height: 1.4">
                      <?php echo  htmlspecialchars_decode($description); ?>
                      </p>
                    </div>
                  </td>
                </tr>
                <!-- end: tr -->

                <tr>
                  <td
                    class="bg_white logo"
                    style="
                      padding: 2em 2.5em;
                      text-align: center;
                      background-color: #fcfcfc;
                    "
                  >
                  <a href="<?php echo base_url() . '/task-view/' . $task_id; ?>" class="enroll-now">Click here to view task</a>
                    </td>
                </tr>
                <!-- end tr -->
              </table>
            </td>
          </tr>
          <!-- end: tr -->
        </table>
      </div>
    </center>
    <td>
    <tr style="
      height:1rem;
    ">
    </tr>
  </td>
  </body>
</html>


