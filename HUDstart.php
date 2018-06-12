<!--<Webdesk.me Making web aplications easy.>
    Copyright (C) <?php echo date("Y"); ?>  Adam W. Telford

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
    
    While using this site, you agree to have read and accepted our terms 
    of use, cookie and privacy policy. Copyright 2017 Adam W. Telford. 
    All Rights Reserved.
    
    A link to the terms of use, cookie and privacy policy, and licences
    can be found at the bottom right corner of the menu bar by clicking 
    the exlmation point once loged in, and in the menu of the login page.-->
<?php 
//ini_set("error_reporting", E_ALL);
file_put_contents($wd_adminFile . 'lastPage.txt', $_SERVER['QUERY_STRING']);
$folder = file_get_contents($wd_adminFile . 'oid.txt');
$temp = 'web/' . $folder . '/';
if ($handle = opendir($temp)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        unlink($temp . $entry);
                    }}}
?>