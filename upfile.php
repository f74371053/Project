<script>


//這裡控制要檢查的項目，true表示要檢查，false表示不檢查
var isCheckImageType = true;  //是否檢查圖片副檔名
var isCheckImageWidth = true;  //是否檢查圖片寬度
var isCheckImageHeight = true;  //是否檢查圖片高度
var isCheckImageSize = true;  //是否檢查圖片檔案大小

var ImageSizeLimit = 100000;  //上傳上限，單位:byte
var ImageWidthLimit = 1200;  //圖片寬度上限
var ImageHeightLimit = 1000;  //圖片高度上限

function checkFile() {
	var f = document.FileForm;
	var re = /\.(jpg|gif)$/i;  //允許的圖片副檔名
	if (isCheckImageType && !re.test(f.file1.value)) {
		alert("只允許上傳JPG或GIF影像檔");
	} else {
		var img = new Image();
		img.onload = checkImage;
		img.src = f.file1.value;
	}
}
function checkImage() {
	if (isCheckImageWidth && this.width > ImageWidthLimit) {
		showMessage('寬度','px',this.width,ImageWidthLimit);
	} else if (isCheckImageHeight && this.height > ImageHeightLimit) {
		showMessage('高度','px',this.height,ImageHeightLimit);
	} else if (isCheckImageSize && this.fileSize > ImageSizeLimit) {
		showMessage('檔案大小','kb',this.fileSize/1000,ImageSizeLimit/1000);
	} else {
		document.FileForm.submit();
	}
}
function showMessage(kind,unit,real,limit) {
	var msg = "您所選擇的圖片kind為 real unit\n超過了上傳上限 limit unit\n不允許上傳！"
	alert(msg.replace(/kind/,kind).replace(/unit/g,unit).replace(/real/,real).replace(/limit/,limit));
}
</script>
