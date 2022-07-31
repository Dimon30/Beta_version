<?php/* 





** Output all items **
$all = sql_req("select * from images order by id DESC");
foreach($all as $row)
{
  ** Show only who needed **
  if ($row['visibility'] == 1)
  {
    $show_img = base64_encode($row['image']);
    echo "<img src='data:image/jpeg; base64, " . $show_img . "' alt='Oops..'>" . "<br>" .
        "<form action='index.php' method = 'post'>" .
        ** Hide button **
        "<input type='hidden' name='id' value='". $row['id'] . "'>" .
        "<input type='submit' name='todo' value='hide'>" . "    " .
        ** Delete button **
        "<input type='hidden' name='id' value='". $row['id'] . "'>" .
        "<input type='submit' name='todo' value='delete'>" .
        "</form>";
  }
}





























































































*/?>