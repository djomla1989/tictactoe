<?php
/**
 * Created by PhpStorm.
 * User: mladen.batakovic
 * Date: 14.5.17.
 * Time: 14.28
 */
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tic Tac Toe</title>
        <link rel="icon" type="image/png" href="public/img/16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="public/img/32.png" sizes="32x32">
        <link rel="stylesheet" type="text/css" href="public/css/style.css" />
        <script type="text/javascript" src="public/js/jquery.js"> </script>
        <script type="text/javascript" src="public/js/game.js"> </script>
    </head>
<body>
<!-- load page !-->
<!-- end load page !-->
    <section id="allgame">
        <div class="mes" style="display: none"></div>
        <section id="score"></section><!-- section score !-->
        <section id="game">
            <div id="players">
                <div id="player1"></div><!-- player one !-->
                <div id="player2"></div><!-- player two !-->
                <div id="middle">
                    <div id="p1"><b class="b1">O<b/></div><!-- div p1(player 1) !-->
                    <div id="p2"><b class="b2">X<b/></div><!-- div p2(player 2) !-->
                    <div id="line"></div><!-- line of middle !-->
                </div><!-- div middle !-->
            </div><!-- div players !-->

            <div id="box">

                <div id="0_0" class="boxs"></div>
                <div id="0_1" class="boxs"></div>
                <div id="0_2" class="boxs marginr0"></div>
                <div id="1_0" class="boxs"></div>
                <div id="1_1" class="boxs"></div>
                <div id="1_2" class="boxs marginr0"></div>
                <div id="2_0" class="boxs marginb0"></div>
                <div id="2_1" class="boxs marginb0"></div>
                <div id="2_2" class="boxs marginb0 marginr0"></div>

            </div> <!-- box(Box of the game) !-->
        </section><!--section game !-->
    </section><!-- Close all game !-->
</body>
</html>