$(document).ready(function () {
    var blocks = document.querySelectorAll(".dynamic-text");

    var num = 1;

    var timer = setInterval( function () {
        if (num < blocks.length) {
            blocks[num-1].classList.remove('active');
            blocks[num].classList.add('active');
            num++;
        } else {
            blocks[num-1].classList.remove('active');
            blocks[0].classList.add('active');
            num = 1;
        }
    }, 3000);

});
