<style>
  .lg{
    font-size: 2em;
  }
  .my-column {
    padding: 1px;
    margin: 1px;
}
</style>
<script>
  function changeSign(input) {
	if(input.value.substring(0, 1) == "-")
		input.value = input.value.substring(1, input.value.length)
	else
		input.value = "-" + input.value
    }
  function checkNum(str) {
	for (var i = 0; i < str.length; i++) {
		var ch = str.substring(i, i+1)
		if (ch < "0" || ch > "9") {
			if (ch != "/" && ch != "*" && ch != "+" && ch != "-" && ch != "."
				&& ch != "(" && ch!= ")") {
				alert("invalid entry!")
				return false
				}
			}
		}
		return true
}
</script>
<div class="container">
  <a href="<?php wd_url($wd_tyoe, $wd_app, 'start.php', ''); ?>"><h2>Calculator</h2></a>
  <div class="panel panel-primary" style="max-width:1100px; color: #000000;">
    <div class="panel-heading"><input type="text" id="display" class="form-control" placeholder="Cleared"></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-1 my-column"></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '7'"><b class="lg">7</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '8'"><b class="lg">8</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '9'"><b class="lg">9</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-danger btn-lg btn-block my-column" onclick="display.value = ''"><b class="lg">C</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-success btn-lg btn-block my-column" onclick="if (checkNum(display.value)) {display.value = eval(display.value);}"><b class="lg">=</b></button></div>
      </div> 
      <div class="row">
        <div class="col-xs-1 my-column"></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '4'"><b class="lg">4</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '5'"><b class="lg">5</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '6'"><b class="lg">6</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-warning btn-lg btn-block my-column" onclick="display.value += '*'"><b class="lg">X</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-warning btn-lg btn-block my-column" onclick="display.value += '/'"><b class="lg">/</b></button></div>
      </div> 
      <div class="row">
        <div class="col-xs-1 my-column"></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '1'"><b class="lg">1</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '2'"><b class="lg">2</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '3'"><b class="lg">3</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-warning btn-lg btn-block my-column" onclick="display.value += '+'"><b class="lg">+</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-warning btn-lg btn-block my-column" onclick="display.value += '-'"><b class="lg">-</b></button></div>
      </div> 
      <div class="row">
        <div class="col-xs-1 my-column"></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '0'"><b class="lg">0</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="display.value += '.'"><b class="lg">.</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-primary btn-lg btn-block my-column" onclick="changeSign(display);"><b class="lg">+/-</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-warning btn-lg btn-block my-column" onclick="display.value += '('"><b class="lg">(</b></button></div>
        <div class="col-xs-2 my-column"><button type="button" class="btn btn-warning btn-lg btn-block my-column" onclick="display.value += ')'"><b class="lg">)</b></button></div>
      </div> 
    </div>
  </div>
</div>