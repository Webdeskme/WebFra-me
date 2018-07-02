<style type="text/css">
.hide{
	display: none;
}
.webdesk_form-control{
	
}
</style>
<script>
function checkImage(imageSrc, good, bad, context) {
  var img = new Image();
  img.onload = good(imageSrc, context); 
  img.onerror = bad(context);
  img.src = imageSrc;
}
</script>