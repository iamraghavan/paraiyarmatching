<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <style id="" media="all">/* thai */
        .kanit-thin {
  font-family: "Kanit", sans-serif;
  font-weight: 100;
  font-style: normal;
}

.kanit-extralight {
  font-family: "Kanit", sans-serif;
  font-weight: 200;
  font-style: normal;
}

.kanit-light {
  font-family: "Kanit", sans-serif;
  font-weight: 300;
  font-style: normal;
}

.kanit-regular {
  font-family: "Kanit", sans-serif;
  font-weight: 400;
  font-style: normal;
}

.kanit-medium {
  font-family: "Kanit", sans-serif;
  font-weight: 500;
  font-style: normal;
}

.kanit-semibold {
  font-family: "Kanit", sans-serif;
  font-weight: 600;
  font-style: normal;
}

.kanit-bold {
  font-family: "Kanit", sans-serif;
  font-weight: 700;
  font-style: normal;
}

.kanit-extrabold {
  font-family: "Kanit", sans-serif;
  font-weight: 800;
  font-style: normal;
}

.kanit-black {
  font-family: "Kanit", sans-serif;
  font-weight: 900;
  font-style: normal;
}

.kanit-thin-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 100;
  font-style: italic;
}

.kanit-extralight-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 200;
  font-style: italic;
}

.kanit-light-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 300;
  font-style: italic;
}

.kanit-regular-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 400;
  font-style: italic;
}

.kanit-medium-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 500;
  font-style: italic;
}

.kanit-semibold-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 600;
  font-style: italic;
}

.kanit-bold-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 700;
  font-style: italic;
}

.kanit-extrabold-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 800;
  font-style: italic;
}

.kanit-black-italic {
  font-family: "Kanit", sans-serif;
  font-weight: 900;
  font-style: italic;
}

      </style>
      <style>
        .notfound h2,.notfound p{margin-top:0;margin-bottom:25px}.notfound .notfound-404 h1,.notfound a,.notfound h2,.notfound p{font-family:kanit,sans-serif;font-weight:200}*{-webkit-box-sizing:border-box;box-sizing:border-box}body{padding:0;margin:0}#notfound{position:relative;height:100vh}#notfound .notfound{position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.notfound{max-width:767px;width:100%;line-height:1.4;text-align:center;padding:15px}.notfound .notfound-404{position:relative;height:220px}.notfound .notfound-404 h1{position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);font-size:186px;margin:0;background:linear-gradient(130deg,#ffa34f,#ff6f68);color:transparent;-webkit-background-clip:text;background-clip:text;text-transform:uppercase}.notfound h2{font-size:33px;text-transform:uppercase;letter-spacing:3px}.notfound p{font-size:16px}.notfound a{color:#ff6f68;text-decoration:none;border-bottom:1px dashed #ff6f68;border-radius:2px}.notfound-social>a{display:inline-block;height:40px;line-height:40px;width:40px;font-size:14px;color:#ff6f68;border:1px solid #efefef;border-radius:50%;margin:3px;-webkit-transition:.2s;transition:.2s}.notfound-social>a:hover{color:#fff;background-color:#ff6f68;border-color:#ff6f68}@media only screen and (max-width:480px){.notfound .notfound-404{position:relative;height:168px}.notfound .notfound-404 h1{font-size:142px}.notfound h2{font-size:22px}}
      </style>
      <meta name="robots" content="noindex, follow">
   </head>
   <body>
      <div id="notfound">
         <div class="notfound">
            <div class="notfound-404">
               <h1>@yield('code')</h1>
            </div>
            <h2>Oops! @yield('message')</h2>
            <p>@yield('description')<a href="{{ route('home') }}">Return to homepage</a></p>

         </div>
      </div>
   </body>
</html>
