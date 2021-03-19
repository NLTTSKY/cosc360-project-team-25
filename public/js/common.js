/**
 * 弹出消息框
 */
function show_msg(title, content) {
	$("#msg-title").html(title);
	$("#msg-content").html(content);
	$('#msg-modal').modal('show');
}
/**
 * 关闭消息提示框
 */
function disMsg() {
	$('#msg-modal').modal('hide');

}
/**
 * 延时关闭消息提示框
 */
function disMsgDelay(time) {
	setTimeout(disMsg, time);
}

/**
 * 使用进度条过渡初始数据加载时间
 */
document.onreadystatechange = function() {
	var state = document.readyState;
	if (state == "complete") {
		$(".loading").fadeOut("slow");
	}
}