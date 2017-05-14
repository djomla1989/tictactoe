$(document).ready(function(){

    var boxs      = $('.boxs');
    var initState = [['','',''],['','',''],['','','']];


    boxs.click(function(){

        if($(this).html() == ''){
            var divt = $(this);
            var id   = $(this).attr('id');
            var res  = id.split("_");

            var xPos = res[0];
            var yPos = res[1];

            if (initState[xPos][yPos] != "") {
                alert('Cheater!!!');
                return false;
            }
            else {
                initState[xPos][yPos] = 'X';
                $(divt).html('<b class="b1">X<b/>');
                $(divt).css("background","#FF9900");
            }
            checkWin(initState);
            $.post('app/Result.php',{'state' : initState},function(res){
                if (jQuery.isEmptyObject(res)) {
                    alert('Something is wrong with server');
                    return false;
                }
                else if (res[0] == '-1' && res[1] == '-1') {
                    alert('No winners');
                    cleanAllDivs();
                    return false;
                }
                else {
                    var nextMoveDiv = res[0] + '_' + res[1];
                    var letter      = res[2];
                    initState[res[0]][res[1]] = 'O';
                    $("#" + nextMoveDiv).html('<b class="b1">' + letter + '<b/>')
                    $("#" + nextMoveDiv).css("background", "#CCCCCC");
                    checkWin(initState);
                }

            },"json");
        }
    });

function checkWin(initState){
    var win = false;
    var who = '';

    var value0 = initState[0][0];
    var value1 = initState[0][1];
    var value2 = initState[0][2];
    var value3 = initState[1][0];
    var value4 = initState[1][1];
    var value5 = initState[1][2];
    var value6 = initState[2][0];
    var value7 = initState[2][1];
    var value8 = initState[2][2];
    //horizontal
    if(value0 != '' && value1 !='' && value2 !='' && value0 === value1 && value1 === value2 && value2 ===value1){
        win = true;
        who = value0;
    }
    else if(value3 != '' && value4 != '' && value5 != '' && value3 === value4 && value4 === value5 && value5 === value4){
        win = true;
        who = value3;
    }
    else if(value6 != '' && value7 != '' && value8 != '' && value6 === value7 && value7 === value8 && value8 === value6 ){
        win = true;
        who = value6;
    }
    //vertical
    else if(value0 != '' && value3 != '' && value6 != '' && value0 === value3 && value3 === value6 && value6 === value0 ){
        win = true;
        who = value0;
    }
    else if(value1 != '' && value4 != '' && value7 != '' && value1 === value4 && value4 === value7 && value7 === value1 ){
        win = true;
        who = value1;
    }
    else if(value2 != '' && value5 != '' && value8 != '' && value2 === value5 && value5 === value8 && value8 === value2 ){
        win = true;
        who = value2;
    }
    //diagonal
    else if(value0 != '' && value4 != '' && value8 != '' && value0 === value4 && value4 === value8 && value8 === value0){
        win = true;
        who = value0;
    }
    else if(value2 != '' && value4 != '' && value6 != '' && value2 === value4 && value4 === value6 && value6 === value2  ){
        win = true;
        who = value2;
    }
    else if( value1 != '' && value2 != '' && value3 != '' && value4 != '' && value5 != '' && value6 != '' && value7 != '' && value8 != ''){
        alert('No winners');
        cleanAllDivs();
    }

    if (win) {
        alert('Player "'+who+'" won!!!' );
        cleanAllDivs();
        return false;
    }

}


function cleanAllDivs(){
    $('.boxs').each(function(){
        $(this).html('');
        $(this).css("background","#E8E8E8");
    });
    initState = [['','',''],['','',''],['','','']];
}

});// End of read the ready function.
