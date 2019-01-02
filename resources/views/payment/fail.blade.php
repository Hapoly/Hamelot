<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>رسید پرداخت</title>
</head>
<style>
    @charset "UTF-8";
    @font-face {
        font-family: "VazirMedium";
        font-style: normal;
        font-weight: 300;
        src: url({{url('fonts/Vazir-Medium-FD.ttf')}});
        /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
    }
    
    html,
    * {
        margin: 0;
        padding: 0;
    }
    
    body {
        font-family: 'VazirMedium' !important;
        direction: rtl;
    }
    
    main {
        height: 100vh;
    }
    
    section {
        position: absolute;
        margin: auto;
        min-height: 500px;
        height: auto;
        width: 70%;
        right: 0;
        left: 0;
        top: 15%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }
    
    section:hover {
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }
    
    .icon {
        /* background: red; */
        position: relative;
        padding: 20px;
        height: 140px;
        text-align: center;
    }
    
    .msg {
        /* background: yellow; */
        position: relative;
        padding: 20px;
        height: 40%;
        text-align: center;
        font-size: x-large;
        color: #424141;
    }
    
    .main {
        border-bottom: 1px solid #9E9E9E;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    
    .btn-group {
        /* background: blue; */
        position: relative;
        padding: 10px;
        text-align: center;
        margin-top: 30px;
    }
    
    img {
        width: 50%;
        height: 100%;
    }
    
    button {
        background: #6ac259;
        padding: 10px;
        border: none;
        border-radius: 5px;
        color: white;
        font-family: 'VazirMedium' !important;
        margin: 2px;
    }
    
    button a {
        text-decoration: none;
        color: white;
    }
    
    @media only screen and (max-width: 600px) {
        section {
            margin: auto;
            height: 300px !important;
            width: 90%;
        }
        .main {
            font-size: initial !important;
        }
        .rahgiri {
            font-size: large;
        }
        .msg {
            height: 34%;
        }
        .btn-group {
            margin-top: 0px;
        }
    }
</style>

<body>
    <main>
        <section>
            <div class="icon">
                <img src="{{url('imgs/close-button.svg')}}">
            </div>
            <div class="msg">
                <p class="main">پرداخت انجام نشد درصورت کسر وجه از حساب شما به صورت اتوماتیک ظرف 24 ساعت به حساب شما بازگشت داده خواهد شد.</p>
                <p class="rahgiri">
                    <span>کد رهگیری:</span>
                    <span class="number">1234566787</span>
                </p>
            </div>
            <div class="btn-group">
                <button><a href="https://telegram.me/DoctorSoalBot">بازگشت به بات</a></button>
                <button><a href="https://t.me/drsoal_supporter">ارتباط با پشتیبانی</a></button>
            </div>
        </section>
    </main>
</body>

</html>