<SCRIPT LANGUAGE="JavaScript">
function addChar(input, character) {
	if(input.value == null || input.value == "0")
		input.value = character
	else
		input.value += character
}

function cos(form) {
	form.display.value = Math.cos(form.display.value);
}

function sin(form) {
	form.display.value = Math.sin(form.display.value);
}

function tan(form) {
	form.display.value = Math.tan(form.display.value);
}

function sqrt(form) {
	form.display.value = Math.sqrt(form.display.value);
}

function ln(form) {
	form.display.value = Math.log(form.display.value);
}

function exp(form) {
	form.display.value = Math.exp(form.display.value);
}

function deleteChar(input) {
	input.value = input.value.substring(0, input.value.length - 1)
}

function changeSign(input) {
	if(input.value.substring(0, 1) == "-")
		input.value = input.value.substring(1, input.value.length)
	else
		input.value = "-" + input.value
}

function compute(form) {
	form.display.value = eval(form.display.value)
}

function square(form) {
	form.display.value = eval(form.display.value) * eval(form.display.value)
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
</SCRIPT>

<FORM NAME="sci-calc">
<TABLE CELLSPACING="0" CELLPADDING="1">
<TR>
<TD COLSPAN="5" ALIGN="center"><INPUT NAME="display" VALUE="0" SIZE="28" MAXLENGTH="25"></TD>
</TR>
<TR>
<TD ALIGN="center"><INPUT TYPE="button" VALUE=" exp " ONCLICK="if (checkNum(this.form.display.value)) { exp(this.form) }"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  7  " ONCLICK="addChar(this.form.display, '7')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  8  " ONCLICK="addChar(this.form.display, '8')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  9  " ONCLICK="addChar(this.form.display, '9')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="   /   " ONCLICK="addChar(this.form.display, '/')"></TD>
</TR>
<TR>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="   ln   " ONCLICK="if (checkNum(this.form.display.value)) { ln(this.form) }"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  4  " ONCLICK="addChar(this.form.display, '4')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  5  " ONCLICK="addChar(this.form.display, '5')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  6  " ONCLICK="addChar(this.form.display, '6')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="   *   " ONCLICK="addChar(this.form.display, '*')"></TD>
</TR>
<TR>
<TD ALIGN="center"><INPUT TYPE="button" VALUE=" sqrt " ONCLICK="if (checkNum(this.form.display.value)) { sqrt(this.form) }"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  1  " ONCLICK="addChar(this.form.display, '1')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  2  " ONCLICK="addChar(this.form.display, '2')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  3  " ONCLICK="addChar(this.form.display, '3')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="   -   " ONCLICK="addChar(this.form.display, '-')"></TD>
</TR>
<TR>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  sq  " ONCLICK="if (checkNum(this.form.display.value)) { square(this.form) }"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="  0  " ONCLICK="addChar(this.form.display, '0')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="   .  " ONCLICK="addChar(this.form.display, '.')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE=" +/- " ONCLICK="changeSign(this.form.display)"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="   +  " ONCLICK="addChar(this.form.display, '+')"></TD>
</TR>
<TR>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="    (    " ONCLICK="addChar(this.form.display, '(')"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="cos" ONCLICK="if (checkNum(this.form.display.value)) { cos(this.form) }"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE=" sin" ONCLICK="if (checkNum(this.form.display.value)) { sin(this.form) }"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE=" tan" ONCLICK="if (checkNum(this.form.display.value)) { tan(this.form) }"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="   )   " ONCLICK="addChar(this.form.display, ')')"></TD>
</TR>
<TR>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="clear" ONCLICK="this.form.display.value = 0 "></TD>
<TD ALIGN="center" COLSPAN="3"><INPUT TYPE="button" VALUE="backspace" ONCLICK="deleteChar(this.form.display)"></TD>
<TD ALIGN="center"><INPUT TYPE="button" VALUE="enter" NAME="enter" ONCLICK="if (checkNum(this.form.display.value)) { compute(this.form) }"></TD>
</TR>
</TABLE>
</FORM>

<p><font face="arial" size="-2">This free script provided by</font><br>
<font face="arial, helvetica" size="-2"><a href="http://javascriptkit.com">JavaScript
Kit</a></font></p>






<SCRIPT LANGUAGE="JavaScript">
<!--

//Bread crumb script - Kevin Lynn Brown
//Duplicate directory names bug fix by JavaScriptKit.com
//Visit JavaScript Kit (http://javascriptkit.com) for script

var path = "";
var href = document.location.href;
var s = href.split("/");
for (var i=2;i<(s.length-1);i++) {
path+="<A HREF=\""+href.substring(0,href.indexOf("/"+s[i])+s[i].length+1)+"/\">"+s[i]+"</A> / ";
}
i=s.length-1;
path+="<A HREF=\""+href.substring(0,href.indexOf(s[i])+s[i].length)+"\">"+s[i]+"</A>";
var url = window.location.protocol + "//" + path;
document.writeln(url);
//-->
</script>

<p align="left">This free script provided by <a href="http://javascriptkit.com">JavaScript Kit</a></p>