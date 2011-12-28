<?
function main()
{
session_start();
include_once("../includes/conn.php");
include_once("../includes/config.php");
include_once("function.php");

if($_REQUEST['act']=="fet")
{
	mysql_query("update news set app_flag=$_REQUEST[f] where news_id=$_REQUEST[n_id]") or die(mysql_error());
	print '<script>window.location="cpostednews.php";</script>';
}
else
if($_REQUEST['act']=="del")
{
	mysql_query("delete from news where news_id=$_REQUEST[n_id]") or die(mysql_error());
	mysql_query("delete from comments where news_id=$_REQUEST[n_id]") or die(mysql_error());
	mysql_query("delete from linkview where news_id=$_REQUEST[n_id]") or die(mysql_error());
	mysql_query("delete from vote where news_id=$_REQUEST[n_id]") or die(mysql_error());
	print '<script>window.location="cpostednews.php";</script>';
}

//print mktime(2,0,0,10,2,2006);
?>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="../calendar/calendar-win2k-cold-1.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="../calendar/calendar.js"></script>
  <script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>
  <script type="text/javascript" src="../calendar/calendar-setup.js"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="22">
	<form name="frmfilter" action="" method="post">
	    <table width="70%" border="0" align="center" cellpadding="0" cellspacing="2" class="bor">
          <tr align="center"> 
            <td height="22" colspan="3" bgcolor="#336699" class="white"><strong>Filter 
              Results</strong></td>
          </tr>
          <tr> 
            <td width="42%" height="22" align="right">Start Date</td>
            <td width="3%" align="center">:</td>
            <td width="55%"> <input type="text" name="sdate" value="<?=$_REQUEST[sdate]?>" class="formi" id="f_date_c" readonly="1"> 
              <img src="../calendar/img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='blue';" onmouseout="this.style.background=''" /> 
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%m-%d-%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script> </td>
          </tr>
          <tr> 
            <td height="22" align="right">End Date</td>
            <td align="center">:</td>
            <td> <input type="text" name="edate" value="<?=$_REQUEST[edate]?>" class="formi" id="f_date_c1" readonly="1"> 
              <img src="../calendar/img.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='blue';" onmouseout="this.style.background=''" /> 
              <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%m-%d-%Y",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script> </td>
          </tr>
          <tr>
            <td height="22" align="right">Show Link</td>
            <td align="center">:</td>
            <td>
			<select name="app_flag" class="formi">
            	<option value="">All</option>
				<option value="0" <? if($_REQUEST['app_flag']==0) print "selected";?>>Deactivated Link</option>
				<option value="1" <? if($_REQUEST['app_flag']==1) print "selected";?>>Activated Link</option>
			</select>
			</td>
          </tr>
          <tr> 
            <td height="22" align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td><input name="filter" type="submit" class="buttonsubmit" id="filter" value="Filter"></td>
          </tr>
        </table>
	  </form>
	  </td>
  </tr>
  <tr> 
    <td height="22">&nbsp;</td>
  </tr>
  <tr> 
    <td height="22" align="center" bgcolor="#336699" class="white">News Listings 
      for Classified Ad</td>
  </tr>
  <tr> 
    <td height="22"> <table class="text" cellpadding="5" cellspacing="1" width="100%">
        <?
		$sdate=$_REQUEST['sdate'];
		$edate=$_REQUEST['edate'];
		$app_flag=$_REQUEST['app_flag'];
		
		$query="select * from news where news_id!=0 and classified='yes'";
		
		///////// search ////////
		if($_REQUEST['sdate']!="")
			{
				$dt_arr=split("-",$_REQUEST['sdate']);
				$dt=mktime(0,0,0,$dt_arr[0],$dt_arr[1],$dt_arr[2]);
				$query.=" and dt>=$dt";
			}
		
		if($_REQUEST['edate']!="")
			{
				$dt_arr=split("-",$_REQUEST['edate']);
				$dt=mktime(0,0,0,$dt_arr[0],$dt_arr[1],$dt_arr[2]);
				$query.=" and dt<=$dt";
			}
		
		if($_REQUEST['app_flag']!="")
			{
				$query.=" and app_flag=$_REQUEST[app_flag]";
			}
		////////////////////////
		
		$query.=" order by dt DESC";
		//print $query;
				
		$result1=mysql_query($query) or die(mysql_error());
				
		$rows_limit=15;
		$total_rows=mysql_num_rows($result1);
		($_REQUEST['pagenum']=="") ? $pagenum=0 : $pagenum=$_REQUEST['pagenum'];
		$show_rows=0;
		$query.=" LIMIT $pagenum,$rows_limit";
				  
		$page_next=$pagenum+$rows_limit;
		$page_prev=$page_next-2*$rows_limit;
		$res=mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($res)>0)
		{
		while($row=mysql_fetch_array($res))
		{
		$show_rows++;
		?>
        <tr> 
          <td align="center" width="100"><a class="links2" href="linkview.php?id=<?=$row[news_id]?>" target="_blank"> 
            <? if($row['source_id']!=0) GetSource($row['source_id']); else print '<img src="../cr_image.php?str='.$row['source_other'].'" border="0" width=90 height=60>';?>
            </a></td>
          <td align="center" width="37" class="textbold"> 
            <? GetTopic($row['topic_id']);?>
          </td>
          <td width="628" align="left" class="text"> Date: <? print "<span class=test>".date("l dS M, Y",$row['dt'])."</span><br>";?> 
            Posted By: <? print "<span class=test>".GetUname($row['u_id'])."</span><br>";?> 
            <? print stripslashes($row['title']);?> </td>
          <td align="center" width="153">
		  <a href="editlink.php?id=<?=$row[news_id]?>" class="blue">[Edit]</a>
		  <a href="cpostednews.php?act=del&n_id=<?=$row[news_id]?>" class="blue" onClick="return confirm('Are you sure to delete?');"><font color="red">Delete</font></a> 
            <div align="center"> 
              <? if($row['app_flag']==1) { ?>
              <a href="cpostednews.php?act=fet&f=0&n_id=<?=$row[news_id]?>" class="blue"><font color="#FF0000">[Make 
              Deactivate]</font></a> 
              <? } else if($row['app_flag']==0) { ?>
              <a href="cpostednews.php?act=fet&f=1&n_id=<?=$row[news_id]?>" class="blue"><font color="#006633">[Make 
              Activate]</font></a> 
              <? } ?>
            </div></td>
        </tr>
        <tr align="center"> 
          <td height="25" colspan="4">
			<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="bor">
              <tr align="center"> 
                <td width="13%" height="22" class="head1"><strong>Cost</strong></td>
                <td width="27%" class="head1"><strong>Title</strong></td>
                <td width="39%" class="head1"><strong>Content</strong></td>
              </tr>
              <?
		$query1="select * from classified_cost where id=$row[ccid]";
		$res1=mysql_query($query1) or die(mysql_error());
		if(mysql_num_rows($res1)>0)
		{
		while($row1=mysql_fetch_array($res1))
		{
		?>
              <tr align="center"> 
                <td height="20">$ <? print $row1['cost'];?></td>
                <td><? print $row1['title'];?></td>
                <td><? print stripslashes($row1['txt']);?></td>
              </tr>
              <?
		}
		}
		?>
            </table>
		  </td>
        </tr>
        <?
		} ///end of while
		?>
        <tr> 
          <td colspan="4" height="25" class="test" align="center"> 
            <?
		if($page_prev>=0)
		{
		?>
            <span style="padding-right:50px">&laquo;<a href="cpostednews.php?pagenum=<?=$page_prev?>&sdate=<?=$sdate?>&edate=<?=$edate?>&app_flag=<?=$app_flag?>" class="blue">previous 
            page</a></span> 
            <?
		}
		?>
            listings&nbsp;<? print($pagenum+1); ?>&nbsp;to&nbsp;<? print($pagenum+$show_rows); ?>&nbsp;of&nbsp;
            <?=$total_rows?>
            <?
		if($total_rows-$pagenum>$rows_limit)
		{
		?>
            <span style="padding-left:50px"><a href="cpostednews.php?pagenum=<?=$page_next?>&sdate=<?=$sdate?>&edate=<?=$edate?>&app_flag=<?=$app_flag?>" class="blue">next 
            page</a> &raquo;</span> 
            <?
		}
		?>
          </td>
        </tr>
        <?
		} ///end of if
		else
		{
		?>
        <tr align="center"> 
          <td height="50" colspan="4" class="error">No News Found</td>
        </tr>
        <?
		}
		?>
      </table></td>
  </tr>
</table>
<?
}
include_once("template.php");
?>