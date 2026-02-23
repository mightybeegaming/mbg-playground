<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MBG Discord</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="MBG Playground official Discord invitation.">
        <meta property="og:title" content="MBG Discord">
		<meta property="og:description" content="MBG Playground official Discord invitation.">
		<meta property="og:url" content="<?=URL_DISCORD?>">
		<meta property="og:image" content="<?=URL_DISCORDBANNER?>">
		<meta property="og:type" content="website">
		<link rel="canonical" href="<?=URL_DISCORD?>">
        <link rel="icon" href="<?=URL_MBGPLAYGROUNDLOGO?>" type="image/png">
        <link rel="stylesheet" href="<?=URL_CSSDISCORD?>">
        <style>
            footer {
				margin-top: 20px;
				text-align: center;
				padding: 15px;
				font-size: 0.9em;
				color: #888;
			}
            a {
				color: #00aeae;
			}
            a:link, a:visited, a:active {
				text-decoration: none;
			}
			footer a:hover {
				text-decoration: underline;
			}
            div.footer {
                background-color: #202225;
                border-radius: 20px;
                box-shadow: inset 0 0 0 3000px rgba(40, 43, 48, 1);
            }
        </style>
    </head>
    <body>
        <main class="main">
            <div class="background">
                <div class="inner inner-1"></div>
                <div class="inner inner-2"></div>
                <div class="inner inner-3"></div>
                <div class="inner inner-4"></div>
                <div class="inner inner-5"></div>
                <div class="inner inner-6"></div>
                <div class="inner inner-7"></div>
                <div class="inner inner-8"></div>
                <div class="inner inner-9"></div>
                <div class="inner inner-10"></div>
                <div class="inner inner-11"></div>
                <div class="inner inner-12"></div>
                <div class="inner inner-13"></div>
            </div>
            <div class="overlay">
                <div id="inviteContainer">
                    <div class="logoContainer">
                        <img class="logo" src="<?=URL_MBGPLAYGROUNDLOGO?>" alt="Discord logo">
                        <h1 class="text">MBG<br>Playground</h1>
                    </div>
                    <div class="acceptContainer">
                        <div class="divForm">
                            <h1>YOU'VE BEEN INVITED TO JOIN</h1>
                            <div class="serverInfo">
                                <h2>
                                <span class="server">MBG Playground</span><br>
                                <span class="by">by </span>
                                <span class="name">MBG</span>
                                </h2>
                            </div>
                            <a href="https://discord.gg/FkhPhkJ7JB"><button class="acceptBtn">Accept Invite</button></a>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <footer>
                        <?php include PATH_LICENSING?>
                    </footer>
                </div>
            </div>
        </main>
		<?php include PATH_GOOGLETAG?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?=URL_JSDISCORD?>"></script>
    </body>
</html>