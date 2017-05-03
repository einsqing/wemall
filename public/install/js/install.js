function no() {
    alert('感谢您对WeMall的支持！');
    window.close();
}
function showmsg(msg, tyle) {
    var html = '<p class="' + tyle + '">' + msg + '</p>';
    $('.m-log').append(html);
}
function insok(adminUrl) {
    var html = '\
	<a href="' + adminUrl + '" class="submit">进入后台</a>\
	';
    $('.m-foot').html(html);
}