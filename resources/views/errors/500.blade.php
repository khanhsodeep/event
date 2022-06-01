

@section('title', __('Server Error'))

@section('title', __('Not Found'))
<style>
    @import url('https://fonts.googleapis.com/css?family=Dosis:300,400,500');

    @-moz-keyframes rocket-movement {
        100% {
            -moz-transform: translate(1200px, -600px);
        }
    }

    @-webkit-keyframes rocket-movement {
        100% {
            -webkit-transform: translate(1200px, -600px);
        }
    }

    @keyframes rocket-movement {
        100% {
            transform: translate(1200px, -600px);
        }
    }

    @-moz-keyframes spin-earth {
        100% {
            -moz-transform: rotate(-360deg);
            transition: transform 20s;
        }
    }

    @-webkit-keyframes spin-earth {
        100% {
            -webkit-transform: rotate(-360deg);
            transition: transform 20s;
        }
    }

    @keyframes spin-earth {
        100% {
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
            transition: transform 20s;
        }
    }

    @-moz-keyframes move-astronaut {
        100% {
            -moz-transform: translate(-160px, -160px);
        }
    }

    @-webkit-keyframes move-astronaut {
        100% {
            -webkit-transform: translate(-160px, -160px);
        }
    }

    @keyframes move-astronaut {
        100% {
            -webkit-transform: translate(-160px, -160px);
            transform: translate(-160px, -160px);
        }
    }

    @-moz-keyframes rotate-astronaut {
        100% {
            -moz-transform: rotate(-720deg);
        }
    }

    @-webkit-keyframes rotate-astronaut {
        100% {
            -webkit-transform: rotate(-720deg);
        }
    }

    @keyframes rotate-astronaut {
        100% {
            -webkit-transform: rotate(-720deg);
            transform: rotate(-720deg);
        }
    }

    @-moz-keyframes glow-star {
        40% {
            -moz-opacity: 0.3;
        }

        90%,
        100% {
            -moz-opacity: 1;
            -moz-transform: scale(1.2);
        }
    }

    @-webkit-keyframes glow-star {
        40% {
            -webkit-opacity: 0.3;
        }

        90%,
        100% {
            -webkit-opacity: 1;
            -webkit-transform: scale(1.2);
        }
    }

    @keyframes glow-star {
        40% {
            -webkit-opacity: 0.3;
            opacity: 0.3;
        }

        90%,
        100% {
            -webkit-opacity: 1;
            opacity: 1;
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            border-radius: 999999px;
        }
    }

    .spin-earth-on-hover {

        transition: ease 200s !important;
        transform: rotate(-3600deg) !important;
    }

    html,
    body {
        margin: 0;
        width: 100%;
        height: 100%;
        font-family: 'Dosis', sans-serif;
        font-weight: 300;
        -webkit-user-select: none;
        /* Safari 3.1+ */
        -moz-user-select: none;
        /* Firefox 2+ */
        -ms-user-select: none;
        /* IE 10+ */
        user-select: none;
        /* Standard syntax */
    }

    .bg-purple {
        background: url(http://salehriaz.com/404Page/img/bg_purple.png);
        background-repeat: repeat-x;
        background-size: cover;
        background-position: left top;
        height: 100%;
        overflow: hidden;

    }

    .custom-navbar {
        padding-top: 15px;
    }

    .brand-logo {
        margin-left: 25px;
        margin-top: 5px;
        display: inline-block;
    }

    .navbar-links {
        display: inline-block;
        float: right;
        margin-right: 15px;
        text-transform: uppercase;


    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        /*    overflow: hidden;*/
        display: flex;
        align-items: center;
    }

    li {
        float: left;
        padding: 0px 15px;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        text-decoration: none;
        letter-spacing: 2px;
        font-size: 12px;

        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        -ms-transition: all 0.3s ease-in;
        -o-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
    }

    li a:hover {
        color: #ffcb39;
    }

    .button {
        margin-top: 10px;
        min-width: 300px;
        min-height: 60px;
        font-family: 'Nunito', sans-serif;
        font-size: 22px;
        text-transform: uppercase;
        letter-spacing: 1.3px;
        font-weight: 700;
        color: #313133;
        background: #4FD1C5;
        background: linear-gradient(90deg, rgba(129, 230, 217, 1) 0%, rgba(79, 209, 197, 1) 100%);
        border: none;
        border-radius: 1000px;
        box-shadow: 12px 12px 24px rgba(79, 209, 197, .64);
        transition: all 0.3s ease-in-out 0s;
        cursor: pointer;
        outline: none;
        position: relative;
        padding: 10px;
        z-index: 100;
    }

    button::before {
        content: '';
        border-radius: 1000px;
        min-width: calc(300px + 12px);
        min-height: calc(60px + 12px);
        border: 6px solid #00FFCB;
        box-shadow: 0 0 60px rgba(0, 255, 203, .64);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all .3s ease-in-out 0s;
    }

    .button:hover,
    .button:focus {
        color: #313133;
        transform: translateY(-6px);
    }

    button::after {
        content: '';
        width: 30px;
        height: 30px;
        border-radius: 100%;
        border: 6px solid #00FFCB;
        position: absolute;
        z-index: -1;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation: ring 1.5s infinite;
    }

    button:hover::after,
    button:focus::after {
        animation: none;
        display: none;
    }

    @keyframes ring {
        0% {
            width: 30px;
            height: 30px;
            opacity: 1;
        }

        100% {
            width: 300px;
            height: 300px;
            opacity: 0;
        }
    }

    button:hover::before,
    button:focus::before {
        opacity: 1;
    }

    .central-body {
        /*    width: 100%;*/
        padding: 17% 5% 10% 5%;
        text-align: center;
    }

    .objects img {
        z-index: 90;
        pointer-events: none;
    }

    .object_rocket {
        z-index: 95;
        position: absolute;
        transform: translateX(-50px);
        top: 75%;
        pointer-events: none;
        animation: rocket-movement 20s linear infinite both running;
    }

    .object_earth {
        position: absolute;
        top: 20%;
        left: 15%;
        z-index: 90;
        /*    animation: spin-earth 100s infinite linear both;*/
    }

    .object_moon {
        position: absolute;
        top: 12%;
        left: 25%;
        /*
    transform: rotate(0deg);
    transition: transform ease-in 99999999999s;
*/
    }

    .earth-moon {}

    .object_astronaut {
        animation: rotate-astronaut 10s infinite linear both alternate;
    }

    .box_astronaut {
        z-index: 110 !important;
        position: absolute;
        top: 60%;
        right: 20%;
        will-change: transform;
        animation: move-astronaut 10s infinite linear both alternate;
    }

    .image-404 {
        position: relative;
        z-index: 100;
        pointer-events: none;
    }

    .stars {
        background: url(http://salehriaz.com/404Page/img/overlay_stars.svg);
        background-repeat: repeat;
        background-size: contain;
        background-position: left top;
    }

    .glowing_stars .star {
        position: absolute;
        border-radius: 100%;
        background-color: #fff;
        width: 3px;
        height: 3px;
        opacity: 0.3;
        will-change: opacity;
    }

    .glowing_stars .star:nth-child(1) {
        top: 80%;
        left: 25%;
        animation: glow-star 2s infinite ease-in-out alternate 1s;
    }

    .glowing_stars .star:nth-child(2) {
        top: 20%;
        left: 40%;
        animation: glow-star 2s infinite ease-in-out alternate 3s;
    }

    .glowing_stars .star:nth-child(3) {
        top: 25%;
        left: 25%;
        animation: glow-star 2s infinite ease-in-out alternate 5s;
    }

    .glowing_stars .star:nth-child(4) {
        top: 75%;
        left: 80%;
        animation: glow-star 2s infinite ease-in-out alternate 7s;
    }

    .glowing_stars .star:nth-child(5) {
        top: 90%;
        left: 50%;
        animation: glow-star 2s infinite ease-in-out alternate 9s;
    }

    @media only screen and (max-width: 600px) {
        .navbar-links {
            display: none;
        }

        .custom-navbar {
            text-align: center;
        }

        .brand-logo img {
            width: 120px;
        }

        .box_astronaut {
            top: 70%;
        }

        .central-body {
            padding-top: 25%;
        }
    }

    .sign {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50%;
        height: 50%;
        background-image: radial-gradient(ellipse 50% 35% at 50% 50%,
                #6b1839,
                transparent);
        transform: translate(-50%, -50%);
        letter-spacing: 2;
        left: 50%;
        top: 55%;
        font-family: "Clip";
        text-transform: uppercase;
        font-size: 6em;
        color: #ffe6ff;
        text-shadow: 0 0 0.6rem #ffe6ff, 0 0 1.5rem #ff65bd,
            -0.2rem 0.1rem 1rem #ff65bd, 0.2rem 0.1rem 1rem #ff65bd,
            0 -0.5rem 2rem #ff2483, 0 0.5rem 3rem #ff2483;
        animation: shine 2s forwards, flicker 3s infinite;
    }

    @keyframes blink {

        0%,
        22%,
        36%,
        75% {
            color: #ffe6ff;
            text-shadow: 0 0 0.6rem #ffe6ff, 0 0 1.5rem #ff65bd,
                -0.2rem 0.1rem 1rem #ff65bd, 0.2rem 0.1rem 1rem #ff65bd,
                0 -0.5rem 2rem #ff2483, 0 0.5rem 3rem #ff2483;
        }

        28%,
        33% {
            color: #ff65bd;
            text-shadow: none;
        }

        82%,
        97% {
            color: #ff2483;
            text-shadow: none;
        }
    }

    .flicker {
        animation: shine 2s forwards, blink 3s 2s infinite;
    }

    .fast-flicker {
        animation: shine 2s forwards, blink 10s 1s infinite;
    }

    @keyframes shine {
        0% {
            color: #6b1839;
            text-shadow: none;
        }

        100% {
            color: #ffe6ff;
            text-shadow: 0 0 0.6rem #ffe6ff, 0 0 1.5rem #ff65bd,
                -0.2rem 0.1rem 1rem #ff65bd, 0.2rem 0.1rem 1rem #ff65bd,
                0 -0.5rem 2rem #ff2483, 0 0.5rem 3rem #ff2483;
        }
    }

    @keyframes flicker {
        from {
            opacity: 1;
        }

        4% {
            opacity: 0.9;
        }

        6% {
            opacity: 0.85;
        }

        8% {
            opacity: 0.95;
        }

        10% {
            opacity: 0.9;
        }

        11% {
            opacity: 0.922;
        }

        12% {
            opacity: 0.9;
        }

        14% {
            opacity: 0.95;
        }

        16% {
            opacity: 0.98;
        }

        17% {
            opacity: 0.9;
        }

        19% {
            opacity: 0.93;
        }

        20% {
            opacity: 0.99;
        }

        24% {
            opacity: 1;
        }

        26% {
            opacity: 0.94;
        }

        28% {
            opacity: 0.98;
        }

        37% {
            opacity: 0.93;
        }

        38% {
            opacity: 0.5;
        }

        39% {
            opacity: 0.96;
        }

        42% {
            opacity: 1;
        }

        44% {
            opacity: 0.97;
        }

        46% {
            opacity: 0.94;
        }

        56% {
            opacity: 0.9;
        }

        58% {
            opacity: 0.9;
        }

        60% {
            opacity: 0.99;
        }

        68% {
            opacity: 1;
        }

        70% {
            opacity: 0.9;
        }

        72% {
            opacity: 0.95;
        }

        93% {
            opacity: 0.93;
        }

        95% {
            opacity: 0.95;
        }

        97% {
            opacity: 0.93;
        }

        to {
            opacity: 1;
        }
    }
</style>

<body class="bg-purple">

    <div class="stars">

        <div class="central-body">
            <div class="wrap">
                <a href="/home"><button class="button" href="/home">Quay lại nào!</button></a>
            </div>
            <div class="sign">
                <span class="fast-flicker">5</span>0<span class="flicker">0</span>-Oops!
            </div>

        </div>
        <div class="objects">
            <img class="object_rocket" src="http://salehriaz.com/404Page/img/rocket.svg" width="40px">
            <div class="earth-moon">
                <img class="object_earth" src="http://salehriaz.com/404Page/img/earth.svg" width="100px">
                <img class="object_moon" src="http://salehriaz.com/404Page/img/moon.svg" width="80px">
            </div>
            <div class="box_astronaut">
                <img class="object_astronaut" src="http://salehriaz.com/404Page/img/astronaut.svg" width="140px">
            </div>
        </div>
        <div class="glowing_stars">
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>

        </div>

    </div>

</body>